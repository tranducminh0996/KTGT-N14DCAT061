<?php

namespace App\Exports;

use App\Models\Athletic;
use App\Models\Tournament;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AthleticExport implements FromCollection, WithStyles, WithHeadings, ShouldAutoSize, WithEvents
{
    use RegistersEventListeners;

    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        $data = Athletic::getTournamentWithAthletic($this->id);
        return $data['athletics'];
    }

    public function styles(Worksheet $sheet)
    {
        // TODO: Implement styles() method.
        $sheet->mergeCells('A1:G1');
        foreach (range(1, 1000) as $number) {
            $sheet->getStyle('A' . $number)->getAlignment()->applyFromArray(
                array('horizontal' => 'center')
            );
            $sheet->getStyle('B' . $number)->getAlignment()->applyFromArray(
                array('horizontal' => 'center')
            );
            $sheet->getStyle('C' . $number)->getAlignment()->applyFromArray(
                array('horizontal' => 'center')
            );
            $sheet->getStyle('D' . $number)->getAlignment()->applyFromArray(
                array('horizontal' => 'center')
            );
            $sheet->getStyle('E' . $number)->getAlignment()->applyFromArray(
                array('horizontal' => 'center')
            );
            $sheet->getStyle('F' . $number)->getAlignment()->applyFromArray(
                array('horizontal' => 'center')
            );
            $sheet->getStyle('G' . $number)->getAlignment()->applyFromArray(
                array('horizontal' => 'center')
            );
        }

        return [
            1 => ['font' => ['bold' => true]],
            2 => ['font' => ['bold' => true]],
        ];
    }

    public function headings(): array
    {
        $tournament = Tournament::getById($this->id);
        // TODO: Implement headings() method.
        return [
            ['Thông tin giải đấu' . $tournament->name],
            [
                'Code',
                'First Name',
                'Last Name',
                'Tổng tiền thưởng',
                'Thứ Hạng',
                'Thứ Tự',
                'CUT'
            ]

        ];
    }

    public function registerEvents(): array
    {
        // TODO: Implement registerEvents() method.
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A1:W1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }

}
