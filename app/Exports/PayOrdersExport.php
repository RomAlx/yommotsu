<?php

namespace App\Exports;

use App\Models\PayOrder;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PayOrdersExport implements FromCollection, WithHeadings, WithStyles, WithColumnFormatting, WithMapping
{
    protected $collection;

    public function __construct($collection)
    {
        $this->collection = $collection;
    }

    public function collection()
    {
        return $this->collection->makeHidden(['message_id', 'updated_at']);
    }

    public function columnFormats(): array
    {
        return [
            'H' => NumberFormat::FORMAT_DATE_DATETIME,
        ];
    }

    public function map($payOrderExport): array
    {
        if(!is_null($payOrderExport->bank)) {
            
            $bank = json_decode($payOrderExport->bank)->bank;
            $name = json_decode($payOrderExport->bank)->name;
        } else {
            $bank = 'no info';
            $name = 'no info';
        }
        return [
            $payOrderExport->id,
            $payOrderExport->project_name,
            $payOrderExport->order_id,
            $payOrderExport->amount,
            $bank,
            $name,
            $payOrderExport->status,
            Date::dateTimeToExcel($payOrderExport->created_at),
        ];
    }


    public function headings(): array {
        return ['ID', 'Название проекта', 'ID заказа', 'Сумма', 'Банк', 'Владелец', 'Статус', 'Дата создания'];
    }

    public function styles(Worksheet $sheet)
    {
        // Установить центрирование содержимого
        $sheet->getStyle('A1:H1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A2:H'.$sheet->getHighestRow())->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Задать ширину столбцов
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(30);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(20);
        $sheet->getColumnDimension('G')->setWidth(15);
        $sheet->getColumnDimension('H')->setWidth(20);

        // Установить красный фон и белый текст для заголовков
        $sheet->getStyle('A1:H1')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('FF0000'); // красный

        $sheet->getStyle('A1:H1')
            ->getFont()
            ->getColor()
            ->setARGB(Color::COLOR_WHITE); // белый
    }
}
