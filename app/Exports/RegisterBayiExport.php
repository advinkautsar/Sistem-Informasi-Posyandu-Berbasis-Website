<?php

namespace App\Exports;

use App\Models\Desa_kelurahan;
use App\Models\Kecamatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Files\LocalTemporaryFile;
use Maatwebsite\Excel\Excel;
use Illuminate\Support\Facades\DB;
use App\Models\Orangtua;


class RegisterBayiExport implements WithEvents
{
    var $id;
    var $request;
    public function __construct($id, $request)
    {
        $this->id = $id;
        $this->request = $request;
    }
    public function registerEvents(): array
    {

        return [
            BeforeWriting::class => function (BeforeWriting $event) {
                $templateFile = new LocalTemporaryFile(public_path('template-excel-laporan/FORMAT-2.xlsx'));
                $event->writer->reopen($templateFile, Excel::XLSX);
                $sheet = $event->writer->getSheetByIndex(0);

                $this->populateSheet($sheet);

                $event->writer->getSheetByIndex(0)->export($event->getConcernable());
                return $event->getWriter()->getSheetByIndex(0);
            },
        ];
    }

    private function populateSheet($sheet)
    {

        $data = DB::table('posyandu')->find($this->id);
        $desa = Desa_kelurahan::where('id', $data->desa_kelurahan_id)->first();

        $kecamatan =Kecamatan::where('id',$desa->kecamatan_id)->first();
      


        $filter = $this->request;

        $ortu = Orangtua::where('posyandu_id', $this->id)->with(
            ['anaks.penimbangans'
            => function ($q) use ($filter) {
                $q->select("*", DB::raw('YEAR(created_at) year, MONTH(created_at) bulan'));
                $q->orwherebetween('created_at', [$filter->tanggal . ' 00:00:00', $filter->tanggal2 . ' 23:59:59'])->get();
            }]
        )->get();

        $sheet->setCellValue('V4', $data->nama_posyandu);
        $sheet->setCellValue('V5', $desa->nama);
        $sheet->setCellValue('V6', $kecamatan->nama_kecamatan);
        $sheet->setCellValue('V7',  $kecamatan->kabupaten);
        $urutan = 1;
        $no = 14;
        foreach ($ortu as $Orangtua) {
            $nama_ayah = $Orangtua->nama_ayah;
            $nama_ibu = $Orangtua->nama_ibu;
            if (!$Orangtua->anaks->isEmpty()) {
                foreach ($Orangtua->anaks as $anak) {
                    $umuranak = $this->cekumur($anak->tanggal_lahir);
                    if ($umuranak > 0 && $umuranak <= 24) {
                        $sheet->setCellValue('A' . $no, $urutan);
                        $sheet->setCellValue('B' . $no, $anak->nama_anak);
                        $sheet->setCellValue('C' . $no, $anak->tanggal_lahir);
                        $sheet->setCellValue('D' . $no, $anak->berat_lahir);

                        $sheet->setCellValue('E' . $no, $nama_ayah);
                        $sheet->setCellValue('F' . $no, $nama_ibu);
                        if (!$anak->penimbangans->isEmpty()) {
                            foreach ($anak->penimbangans as $penimbangan) {
                                $sheet->setCellValue($this->selectField($penimbangan->bulan) . $no, $penimbangan->berat_badan);
                                // $sheet->setCellValue('D' . $no, $penimbangan->berat_badan);
                            }
                        }
                        if (!$anak->pemeriksaans->isEmpty()) {
                            //kliru
                            // foreach ($anak->pemeriksaans as $pemeriksaan) {
                            // //    if($pemeriksaan->imunisasi_id_1 =!37||$pemeriksaan->imunisasi_id_2 =!37||$pemeriksaan->imunisasi_id_3 =!37){
                            //     $dtp = $pemeriksaan->where('nik_anak',$anak->nik_anak)->where('imunisasi_id_1' ,4)->orWhere('imunisasi_id_1',4)->orWhere('imunisasi_id_1',4)->get();
                            //     foreach($dtp as $dt){
                                      
                            //         $sheet->setCellValue('Z' . $no,  $dtp[0]->tanggal_pemeriksaan ?? '-');
                            //         $sheet->setCellValue('AA' . $no, $dtp[1]->tanggal_pemeriksaan    ?? '-');
                            //         $sheet->setCellValue('AB' . $no, $dtp[2]->tanggal_pemeriksaan    ?? '-');
                                  
                            //     }    
                            // }
                            $pemeriksaan = $anak->pemeriksaans->last();

                            // if ($pemeriksaan->Fe_1 == 'Ya') {
                            //     $sheet->setCellValue('T' . $no, $pemeriksaan->tanggal_pemeriksaan);
                            // }
                            // if ($pemeriksaan->Fe_2 == 'Ya') {
                            //     $sheet->setCellValue('U' . $no, $pemeriksaan->tanggal_pemeriksaan);
                            // }
                            // if ($pemeriksaan->vitA_biru == 'Ya') {
                            //     $sheet->setCellValue('V' . $no, $pemeriksaan->tanggal_pemeriksaan);
                            // }
                            // if ($pemeriksaan->vitA_merah == 'Ya') {
                            //     $sheet->setCellValue('W' . $no, $pemeriksaan->tanggal_pemeriksaan);
                            // }
                            if ($pemeriksaan->oralit == 'Ya') {
                                $sheet->setCellValue('X' . $no, $pemeriksaan->tanggal_pemeriksaan);
                            }
                            // $sheet->setCellValue('W' . $no, $pemeriksaan->PMT);
                            $sheet->setCellValue('X' . $no, $pemeriksaan->oralit);
                            if ($pemeriksaan->Fe_1 == 'Ya' && $pemeriksaan->Fe_2 == "Ya") {
                                $sheet->setCellValue('T' . $no, $pemeriksaan->tanggal_pemeriksaan);
                                $sheet->setCellValue('U' . $no, $pemeriksaan->tanggal_pemeriksaan);
                            }else{
                                $sheet->setCellValue('T' . $no, '-');
                                $sheet->setCellValue('U' . $no, '-');

                            }

                            if ($pemeriksaan->vitA_merah == 'Ya' && $pemeriksaan->vitA_biru == "Ya") {
                                $sheet->setCellValue('V' . $no, $pemeriksaan->tanggal_pemeriksaan);
                                $sheet->setCellValue('W' . $no, $pemeriksaan->tanggal_pemeriksaan);
                            }else{
                                $sheet->setCellValue('V' . $no, '-');
                                $sheet->setCellValue('W' . $no, '-');

                            }
                            // $sheet->setCellValue('X' . $no, $pemeriksaan->oralit);
                        }
                        $no++;
                        $urutan++;
                    }
                }
            }
        }
    }

    public function selectField($month)
    {
        switch ($month) {
            case 1:
                return 'H';
                break;
            case 2:
                return 'I';
                break;
            case 3:
                return 'J';
                break;
            case 4:
                return 'K';
                break;
            case 5:
                return 'L';
                break;
            case 6:
                return 'M';
                break;
            case 7:
                return 'N';
                break;
            case 8:
                return 'O';
                break;
            case 9:
                return 'P';
                break;
            case 10:
                return 'Q';
                break;
            case 11:
                return 'R';
                break;
            case 12:
                return 'S';
                break;
            default:
                return 'H';
                break;
        }
    }

    public function cekumur($tanggal_lahir)
    {
        $bulan =  \Carbon\Carbon::parse($tanggal_lahir)->diff(\Carbon\Carbon::now())->format('%m');
        $tahun =  \Carbon\Carbon::parse($tanggal_lahir)->diff(\Carbon\Carbon::now())->format('%y');
        return $tahun * 12 + $bulan;
    }
}
