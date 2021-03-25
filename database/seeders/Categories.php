<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class Categories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('categories')->insert([
            [
                'name' => 'House Hold',
                'icon_name'=>'home-variant',
            ],

             [
                'name' => 'Pets',
                'icon_name'=>'cat',
            ],

             [
                'name' => 'Personal Care',
                'icon_name'=>'head-heart',
            ],

             [
                'name' => 'Unique',
                'icon_name'=>'star-circle',
            ],

             [
                'name' => 'All',
                'icon_name'=>'filter-variant',
            ],

             [
                'name' => 'Vehicles',
                'icon_name'=>'car',
            ],

             [
                'name' => 'Services',
                'icon_name'=>'hammer-wrench',
            ],

             [
                'name' => 'Arts',
                'icon_name'=>'music',
            ],
             [
                'name' => 'Electronics',
                'icon_name'=>'tablet-cellphone',
            ],
            
            [
                'name' => 'Near Me',
                'icon_name'=>'near-me',
            ],
             [
                'name' => 'Food',
                'icon_name'=>'food',
            ],
             [
                'name' => 'Properties',
                'icon_name'=>'island',
            ],
             [
                'name' => 'Fashion',
                'icon_name'=>'tshirt-crew',
            ],



        ]);

    }
}
        

    

