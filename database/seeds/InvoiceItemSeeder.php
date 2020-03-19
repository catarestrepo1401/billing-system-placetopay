<?php

use Illuminate\Database\Seeder;

class InvoiceItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\InvoiceItem::class, 50)->create();
    }
}
