<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;

class CategorySeeder extends Seeder
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
                'category_name' =>  'Makeup Artist',
                'category_url'  =>  'makeup-artist',   
            ],
            [
                'category_name' =>  'Wedding Venue',
                'category_url'  =>  'wedding-venue',
                'icon'  =>  '<i class="weddingdir_location_heart"></i>',
            ],
            [
                'category_name'  =>  'Wedding Photographer',
                'category_url'  =>  'wedding-photographer',  
                'icon'  =>  '<i class="weddingdir_videographer"></i>',
            ],
            [
                'category_name'  =>  'Bridal Designer',
                'category_url'  =>  'bridal-designer',  
                'icon'  =>  '<i class="weddingdir_fashion"></i>',
            ],
            [
                'category_name'  =>  'Choreographer',
                'category_url'  =>  'choreographer',  
                'icon'  =>  '<i class="weddingdir_music"></i>'
            ],
            [
                'category_name'  =>  'Mehndi Artist',
                'category_url'  =>  'mehndi-artist',  
            ],
            [
                'category_name'  =>  'Wedding Planner',
                'category_url'  =>  'wedding-planner',  
            ],
            [
                'category_name'  =>  'Wedding Invitation',
                'category_url'  =>  'wedding-invitation',  
                'icon'  =>  '<i class="weddingdir_heart_envelope"></i>',
            ],
            
            
        ];

        foreach($data as $value){
            Category::create($value);
        } 
    }
}
