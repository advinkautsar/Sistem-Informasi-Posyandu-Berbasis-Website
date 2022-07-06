<?php

namespace App\Exports;

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
    public function __construct($id,$request)
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
                    if($umuranak > 0 && $umuranak<= 24 ){
                    $sheet->setCellValue('A'.$no, $urutan);
                    $sheet->setCellValue('B'.$no, $anak->nama_anak);
                    $sheet->setCellValue('C'.$no, $anak->tanggal_lahir);
                   
                    $sheet->setCellValue('E'.$no,$nama_ayah );
                    $sheet->setCellValue('F'.$no,$nama_ibu );
                    if(!$anak->penimbangans->isEmpty()){
                        foreach($anak->penimbangans as $penimbangan){
                            $sheet->setCellValue($this->selectField($penimbangan->bulan).$no, $penimbangan->berat_badan);
                            $sheet->setCellValue('D'.$no, $penimbangan->berat_badan);
                        }
                    }
                    if(!$anak->pemeriksaans->isEmpty()){
                        $pemeriksaan = $anak->pemeriksaans->last();
                    
                        $sheet->setCellValue('W'.$no, $pemeriksaan->PMT);
                        $sheet->setCellValue('X'.$no, $pemeriksaan->oralit);
                        if($pemeriksaan->Fe_1 == 'Ya' && $pemeriksaan->Fe_2 == "Ya" ){
                            $sheet->setCellValue('T'.$no, 'V');
                            $sheet->setCellValue('U'.$no, 'V');
                        }

                        if($pemeriksaan->vitA_merah == 'Ya' && $pemeriksaan->vitA_biru == "Ya" ){
                            $sheet->setCellValue('V'.$no, 'V');
                            $sheet->setCellValue('W'.$no, 'V');
                        }
                        $sheet->setCellValue('X'.$no, $pemeriksaan->oralit);

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
        return $tahun*12+$bulan;
    }
}
