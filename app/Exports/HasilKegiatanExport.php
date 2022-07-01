<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Files\LocalTemporaryFile;
use Maatwebsite\Excel\Excel;
use Illuminate\Support\Facades\DB;


class HasilKegiatanExport implements  WithEvents
{
    var $id=0;
    public function __construct($id)
    {
        $this->id = $id;
    }
    public function registerEvents(): array
    {

        return [
            BeforeWriting::class => function(BeforeWriting $event) {
                $templateFile = new LocalTemporaryFile(public_path('template-excel-laporan/DATA HASIL KEGIATAN POSYANDU.xlsx'));
                $event->writer->reopen($templateFile, Excel::XLSX);
                $sheet = $event->writer->getSheetByIndex(0);

                $this->populateSheet($sheet);
                
                $event->writer->getSheetByIndex(0)->export($event->getConcernable());
                return $event->getWriter()->getSheetByIndex(0);
            },
        ];
    }

    private function populateSheet($sheet){
        
        $data = DB::table('posyandu')->find($this->id);

            $sheet->setCellValue('P3', $data->nama_posyandu);
            $sheet->setCellValue('P4', $data->alamat);

            for($i=0; $i<50; $i++){
                $sheet->setCellValue('A'.($i+19), $i);
            }



    }

}
