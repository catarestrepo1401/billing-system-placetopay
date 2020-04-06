<?php

use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $invoice = Factory(App\Models\Invoice::class)->create([
            'document_number' => '12345',
            'document_type' => 'bill_of_sale',
            'expired_at' => '2020-05-06 02:36:00',
            'delivery_at' => '2020-04-06 02:36:00',
            'subtotal' => '20000',
            'net' => '40000',
            'discount_rate' => '10',
            'discount' => '36000',
            'tax_rate' => '19',
            'tax' => '42840',
            'total' => '42840',
        ]);

        $invoice = Factory(App\Models\Invoice::class)->create([
            'document_number' => '98765',
            'document_type' => 'bill_of_sale',
            'expired_at' => '2020-05-06 02:36:00',
            'delivery_at' => '2020-04-06 02:36:00',
            'subtotal' => '10000',
            'net' => '20000',
            'discount_rate' => '10',
            'discount' => '18000',
            'tax_rate' => '19',
            'tax' => '21240',
            'total' => '21240',
        ]);

        $invoice = Factory(App\Models\Invoice::class)->create([
            'document_number' => '96385',
            'document_type' => 'bill_of_sale',
            'expired_at' => '2020-05-06 02:36:00',
            'delivery_at' => '2020-04-06 02:36:00',
            'subtotal' => '30000',
            'net' => '60000',
            'discount_rate' => '10',
            'discount' => '54000',
            'tax_rate' => '19',
            'tax' => '64260',
            'total' => '64260',
        ]);

        $invoice = Factory(App\Models\Invoice::class)->create([
            'document_number' => '74185',
            'document_type' => 'bill_of_sale',
            'expired_at' => '2020-05-06 02:36:00',
            'delivery_at' => '2020-04-06 02:36:00',
            'subtotal' => '250000',
            'net' => '500000',
            'discount_rate' => '10',
            'discount' => '450000',
            'tax_rate' => '19',
            'tax' => '535500',
            'total' => '535500',
        ]);

        $invoice = Factory(App\Models\Invoice::class)->create([
            'document_number' => '85296',
            'document_type' => 'bill_of_sale',
            'expired_at' => '2020-03-06 02:36:00',
            'delivery_at' => '2020-02-06 02:36:00',
            'subtotal' => '986000',
            'net' => '986000',
            'discount_rate' => '10',
            'discount' => '887400',
            'tax_rate' => '19',
            'tax' => '1056006',
            'total' => '1056006',
        ]);


        //factory(\App\Models\Invoice::class, 10)->create();
    }
}
