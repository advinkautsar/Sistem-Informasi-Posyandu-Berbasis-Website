<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Files\LocalTemporaryFile;
use Maatwebsite\Excel\Excel;
use Illuminate\Support\Facades\DB;
use App\Models\Orangtua;


class RegisterBalitaExport implements WithEvents
{
    //export per posyandu
    var $id;
    var $request;
    public function __construct($id,$request)
    {
        $this->id = $id;
        $this->request = $request;
    }
    public function registerEvents(): array
    {

        return [
            BeforeWriting::class => function (BeforeWriting $event) {
                $templateFile = new LocalTemporaryFile(public_path('template-excel-laporan/FORMAT 3 - REGISTER BALITA.xlsx'));
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
        $filter= $this->request;

        $ortu = Orangtua::where('posyandu_id', $this->id)->with(
            ['anaks.penimbangans'
            => function ($q) use($filter) {
                $q->select("*", DB::raw('YEAR(created_at) year, MONTH(created_at) bulan'));
                $q->wherebetween('created_at',[$filter->tanggal.' 00:00:00',$filter->tanggal2.' 23:59:59'])->get();
            }]
        )->get();

        $sheet->setCellValue('M4', $data->nama_posyandu);
        $sheet->setCellValue('M5', $data->alamat);
        $urutan=1;
        $no=14;
        foreach ($ortu as $Orangtua) {
            $nama_ayah = $Orangtua->nama_ayah;
            $nama_ibu = $Orangtua->nama_ibu;
            if (!$Orangtua->anaks->isEmpty()) {
                foreach($Orangtua->anaks as $anak){
                    $umuranak = $this->cekumur($anak->tanggal_lahir);
                    if($umuranak > 24 && $umuranak<= 60 ){
                    $sheet->setCellValue('A'.$no, $urutan);
                    $sheet->setCellValue('B'.$no, $anak->nama_anak);
                    $sheet->setCellValue('C'.$no, $anak->tanggal_lahir);
                    $sheet->setCellValue('D'.$no,$nama_ayah );
                    $sheet->setCellValue('E'.$no,$nama_ibu );
                    if(!$anak->penimbangans->isEmpty()){
                        foreach($anak->penimbangans as $penimbangan){
                            $sheet->setCellValue($this->selectField($penimbangan->bulan).$no, $penimbangan->berat_badan);
                        }
                    }
                    if(!$anak->pemeriksaans->isEmpty()){
                        $pemeriksaan = $anak->pemeriksaans->last();
                        $sheet->setCellValue('W'.$no, $pemeriksaan->PMT);
                        $sheet->setCellValue('X'.$no, $pemeriksaan->oralit);
                        if($pemeriksaan->Fe_1 == 'Ya' && $pemeriksaan->Fe_2 == "Ya" ){
                            $sheet->setCellValue('S'.$no, 'V');
                            $sheet->setCellValue('T'.$no, 'V');
                        }

                        if($pemeriksaan->vitA_merah == 'Ya' && $pemeriksaan->vitA_biru == "Ya" ){
                            $sheet->setCellValue('U'.$no, 'V');
                            $sheet->setCellValue('V'.$no, 'V');
                        }
                        $sheet->setCellValue('X'.$no, $pemeriksaan->oralit);
                        $sheet->setCellValue('W'.$no, $pemeriksaan->PMT);
                        
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
               return 'G';
                break;
            case 2:
                return 'H';
                 break;
            case 3:
                return 'I';
                 break;
            case 4:
                return 'J';
                 break;
            case 5:
                return 'K';
                 break;
            case 6:
                return 'L';
                 break;
            case 7:
                return 'M';
                 break;
            case 8:
                return 'N';
                 break;
            case 9:
                return 'O';
                 break;
            case 10:
                return 'P';
                 break;
            case 11:
                return 'Q';
                 break;
            case 12:
                return 'R';
                 break;
            default:
                return 'G';
                break;
        }
    }

    public function cekumur($tanggal_lahir)
    {
        $bulan =  \Carbon\Carbon::parse($tanggal_lahir)->diff(\Carbon\Carbon::now())->format('%m');
        $tahun =  \Carbon\Carbon::parse($tanggal_lahir)->diff(\Carbon\Carbon::now())->format('%y');
        return $tahun*12+$bulan;
    }
}
