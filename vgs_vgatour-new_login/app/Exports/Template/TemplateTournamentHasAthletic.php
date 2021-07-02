<?php

namespace App\Exports\Template;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TemplateTournamentHasAthletic implements FromArray, WithStyles, WithHeadingRow, ShouldAutoSize
{
    public function array(): array
    {
        return [];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:F1');
        foreach (range(1, 500) as $number) {
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
        }
    }

    public function headings(): array
    {
        return [
            ['Thông tin giải đấu'],
            [
                'Code',
                'First Name',
                'Last Name',
                'Tổng tiền thưởng',
                'Thứ Hạng',
                'Thứ Tự'
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
