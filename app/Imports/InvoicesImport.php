<?php

namespace App\Imports;

use App\Models\Invoice;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class InvoicesImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $invoice = Invoice::where('document_number', $row[0])->first();

            if (!$invoice) {
                $newInvoice = new Invoice();

                $newInvoice->fillable([
                    'document_number',
                    'document_type',
                    'expired_at',
                    'delivery_at',
                    'subtotal',
                    'discount_rate',
                    'discount',
                    'net',
                    'tax_rate',
                    'tax',
                    'total',
                    'created_at',
                    'updated_at',
                ]);

                $newInvoice->fill([
                    'document_number' => $row[0],
                    'document_type' => $row[1],
                    'expired_at' => Date::excelToDateTimeObject($row[2]),
                    'delivery_at' => Date::excelToDateTimeObject($row[3]),
                    'subtotal' => $row[4],
                    'discount_rate' => $row[5],
                    'discount' => $row[6],
                    'net' => $row[7],
                    'tax_rate' => $row[8],
                    'tax' => $row[9],
                    'total' => $row[10],
                    'created_at' => Date::excelToDateTimeObject($row[13]),
                    'updated_at' => Date::excelToDateTimeObject($row[14]),
                ]);

                $newInvoice->user()->associate($row[11]);
                $newInvoice->customer()->associate($row[12]);

                $newInvoice->save();
            }
        }
    }
}
