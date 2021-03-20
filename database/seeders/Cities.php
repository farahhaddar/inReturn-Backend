<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Cities extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            [
                'name' => 'Baalbek ',
            ],
            [
                'name' => 'Hermel',
            ],
            [
                'name' => 'Beirut',
            ],

            [
                'name' => 'Rashaya ',
            ],
            [
                'name' => 'Western Beqaa ',
            ],
            [
                'name' => 'Zahle',
            ],
            [
                'name' => 'Aley ',
            ],
            [
                'name' => 'Baabda ',
            ],
            [
                'name' => 'Byblos ',
            ],
            [
                'name' => 'Chouf',
            ],
            [
                'name' => 'Keserwan ',
            ],
            [
                'name' => 'Matn ',
            ],
            [
                'name' => 'Bint Jbeil ',
            ],
            [
                'name' => 'Hasbaya ',
            ],
            [
                'name' => 'Marjeyoun ',
            ], 
            [
                'name' => 'Nabatieh',
            ],
            [
                'name' => 'Batroun ',
            ], 
            [
                'name' => 'Bsharri ',
            ],

            [
                'name' => 'Koura',
            ],
            [
                'name' => 'Miniyeh-Danniyeh District',
            ],
            [
                'name' => 'Tripoli ',
            ],
            [
                'name' => 'Zgharta ',
            ],
            [
                'name' => 'Sidon ',
            ],
            [
                'name' => 'Jezzine  ',
            ],
            [
                'name' => 'Tyre',
            ],

        ]);

    }
}
