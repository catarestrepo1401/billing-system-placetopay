<?php

namespace App\Exports;

use App\Models\Invoice;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

// y ahora?
class InvoicesExport implements FromQuery, ShouldQueue
{
    use Exportable;
    /**
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function query()
    {
        return Invoice::query();
    }
}
