<?php

namespace App\Imports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\ToModel;

class InvoicesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Invoice([
            'document_number' => $row[0],
            'document_type'   => $row[1],
            'expired_at'      => $row[2],
            'delivery_at'     => $row[3],
            'subtotal'        => $row[4],
            'discount_rate'   => $row[5],
            'discount'        => $row[6],
            'net'             => $row[7],
            'tax_rate'        => $row[8],
            'tax'             => $row[9],
            'total'           => $row[10],
            'user_id'         => $row[11],
            'customer_id'     => $row[12],
            'created_at'      => $row[13],
            'updated_at'      => $row[14],
        ]);
    }
}
