<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BudgetCategory;

class BudgetCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'  =>  'Venue',
                'icon'  =>  '<i class="weddingdir_location_heart"></i>',
            ],
            [
                'name'  =>  'Videographer',
                'icon'  =>  '<i class="weddingdir_videographer"></i>',
            ],
            [
                'name'  =>  'Invitations',
                'icon'  =>  '<i class="weddingdir_heart_envelope"></i>',
            ],
            [
                'name'  =>  'Favors and Gifts',
                'icon'  =>  '<i class="weddingdir_love_gift"></i>',
            ],
            [
                'name'  =>  'Cake',
                'icon'  =>  '<i class="weddingdir_cake_floor"></i>',
            ],
            [
                'name'  =>  'Dress and Attire',
                'icon'  =>  '<i class="weddingdir_fashion"></i>',
            ],
            [
                'name'  =>  'Band',
                'icon'  =>  '<i class="weddingdir_guitar"></i>',
            ],
            [
                'name'  =>  'Jewelry',
                'icon'  =>  '<i class="weddingdir_ring_double"></i>',
            ],
            [
                'name'  =>  'Rentals',
                'icon'  =>  '<i class="weddingdir_tent"></i>',
            ],
            [
                'name'  =>  'Transportation',
                'icon'  =>  '<i class="weddingdir_bus"></i>',
            ],
            [
                'name'  =>  'Other',
                'icon'  =>  '<i class="fa fa-life-ring"></i>',
            ],

        ];

        foreach($data as $value){
            BudgetCategory::create($value);
        }
    }
}
