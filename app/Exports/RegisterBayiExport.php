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
use Carbon\Carbon;


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

        $tanggal1 = $filter->tanggal == null ? Carbon::now()->startOfYear()->format('Y-m-d') : $filter->tanggal;	
        $tanggal2 = $filter->tanggal2 == null ? Carbon::now()->endOfYear()->format('Y-m-d') : $filter->tanggal2;

        $ortu = Orangtua::where('posyandu_id', $this->id)->with(
            ['anaks.penimbangans'
            => function ($q) use ($tanggal1,$tanggal2) {
                $q->select("*", DB::raw('YEAR(created_at) year, MONTH(created_at) bulan'));
                $q->wherebetween('created_at', [$tanggal1 . ' 00:00:00', $tanggal2 . ' 23:59:59'])->get();
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

                            $zz = ['Z', 'AA', 'AB'];
                            $zd = ['AC', 'AD', 'AE','AF'];
                            $zc = ['AH', 'AI','AJ'];
                            $zn = 0;
                            $ze=0;
                            $zf=0;
                            foreach($anak->pemeriksaans as $dpt){
                                if(
                                substr($dpt->imunisasi1->jenis_imunisasi,0,3) == "DPT" || 
                                substr($dpt->imunisasi2->jenis_imunisasi,0,3)  == "DPT" || 
                                substr($dpt->imunisasi3->jenis_imunisasi,0,3) == "DPT" ){
                                $sheet->setCellValue($zz[$zn] . $no, $dpt->tanggal_pemeriksaan);
                                $zn++;
                                }

                                if(
                                    substr($dpt->imunisasi1->jenis_imunisasi,0,5) == "Polio" || 
                                    substr($dpt->imunisasi2->jenis_imunisasi,0,5)  == "Polio" || 
                                    substr($dpt->imunisasi3->jenis_imunisasi,0,5) == "Polio" ){
                                    $sheet->setCellValue($zd[$ze] . $no, $dpt->tanggal_pemeriksaan);
                                    $ze++;
                                }

                                if(
                                    substr($dpt->imunisasi1->jenis_imunisasi,0,3) == "DPT" || 
                                    substr($dpt->imunisasi2->jenis_imunisasi,0,3)  == "DPT" || 
                                    substr($dpt->imunisasi3->jenis_imunisasi,0,3) == "DPT" ){
                                    $sheet->setCellValue($zc[$zf] . $no, $dpt->tanggal_pemeriksaan);
                                    $zf++;
                                }

                                if(
                                    substr($dpt->imunisasi1->jenis_imunisasi,0,3) == "BCG" || 
                                    substr($dpt->imunisasi2->jenis_imunisasi,0,3)  == "BCG" || 
                                    substr($dpt->imunisasi3->jenis_imunisasi,0,3) == "BCG" ){
                                    $sheet->setCellValue('Y' . $no, $dpt->tanggal_pemeriksaan);
                                }

                                if(
                                    substr($dpt->imunisasi1->jenis_imunisasi,0,6) == "Campak" || 
                                    substr($dpt->imunisasi2->jenis_imunisasi,0,6)  == "Campak" || 
                                    substr($dpt->imunisasi3->jenis_imunisasi,0,6) == "Campak" ){
                                    $sheet->setCellValue('AG' . $no, $dpt->tanggal_pemeriksaan);
                                }


                            }
                            $pemeriksaan = $anak->pemeriksaans->last();

                            if ($pemeriksaan->oralit == 'Ya') {
                                $sheet->setCellValue('X' . $no, $pemeriksaan->tanggal_pemeriksaan);
                            }else{
                                $sheet->setCellValue('X' . $no, '-');
                            }
                            // $sheet->setCellValue('W' . $no, $pemeriksaan->PMT);
                            // $sheet->setCellValue('X' . $no, $pemeriksaan->oralit);
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
