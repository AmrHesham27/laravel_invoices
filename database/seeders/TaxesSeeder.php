<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tax;

class TaxesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $Taxes = [
        [
            'Type' => 'T1',
            'Percentage' => 14,
            'Amount' => 0,
        ],
        [
            'Type' => 'T2',
            'Percentage' => 12,
            'Amount' => 0,
        ],
        [
            'Type' => 'T3',
            'Percentage' => 0,
            'Amount' => 3000,
        ],
        [
            'Type' => 'T4',
            'Percentage' => 5,
            'Amount' => 0,
        ],
        [
            'Type' => 'T5',
            'Percentage' => 14,
            'Amount' => 0,
        ],
        [
            'Type' => 'T6',
            'Percentage' => 0,
            'Amount' => 6000,
        ],
        [
            'Type' => 'T7',
            'Percentage' => 10,
            'Amount' => 0,
        ],
        [
            'Type' => 'T8',
            'Percentage' => 14,
            'Amount' => 0,
        ],
        [
            'Type' => 'T9',
            'Percentage' => 12,
            'Amount' => 0,
        ],
        [
            'Type' => 'T10',
            'Percentage' => 10,
            'Amount' => 0,
        ],
        [
            'Type' => 'T11',
            'Percentage' => 14,
            'Amount' => 0,
        ],
        [
            'Type' => 'T12',
            'Percentage' => 12,
            'Amount' => 0,
        ],
        [
            'Type' => 'T13',
            'Percentage' => 10,
            'Amount' => 0,
        ],
        [
            'Type' => 'T14',
            'Percentage' => 14,
            'Amount' => 0,
        ],
        [
            'Type' => 'T15',
            'Percentage' => 12,
            'Amount' => 0,
        ],
        [
            'Type' => 'T16',
            'Percentage' => 10,
            'Amount' => 0,
        ],
        [
            'Type' => 'T17',
            'Percentage' => 10,
            'Amount' => 0,
        ],
        [
            'Type' => 'T18',
            'Percentage' => 14,
            'Amount' => 0,
        ],
        [
            'Type' => 'T19',
            'Percentage' => 12,
            'Amount' => 0,
        ],
        [
            'Type' => 'T20',
            'Percentage' => 10,
            'Amount' => 0,
        ],
    ];
    public function run()
    {
        foreach($this->Taxes as $tax){
            Tax::create($tax);
        }
    }
}
