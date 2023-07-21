<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $currencyRecords = [
            ['id'=>1,'currency_name'=>'US Dolla','exchange_code'=>'USD'],
            ['id'=>2,'currency_name'=>'Euro','exchange_code'=>'EUR'],
            ['id'=>3,'currency_name'=>'Kwanza','exchange_code'=>'AOA'],
            ['id'=>4,'currency_name'=>'Taka','exchange_code'=>'BDT'],
            ['id'=>5,'currency_name'=>'Indian Rupee','exchange_code'=>'INR'],
            ['id'=>6,'currency_name'=>'Congolese Franc','exchange_code'=>'CDF'],
            ['id'=>7,'currency_name'=>'Kuna','exchange_code'=>'HRK'],
            ['id'=>8,'currency_name'=>'Lari','exchange_code'=>'GEL'],
            ['id'=>9,'currency_name'=>'Rand','exchange_code'=>'ZAR'],
            ['id'=>10,'currency_name'=>'Qatari Rial','exchange_code'=>'QAR']
        ];
        Currency::insert($currencyRecords);
    }
}
