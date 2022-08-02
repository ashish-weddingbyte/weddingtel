<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\RelationGroup;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Bride Friend'],
            ['name' => 'Groom Friend'],
            ['name' => 'Bride Co-worker'],
            ['name' => 'Groom Co-worker'],
            ['name' => 'Mutual Friend'],
            ['name' => 'Couple'],
            ['name' => 'Bride Family Friend'],
            ['name' => 'Groom Family Friend'],
            ['name' => 'Bride Family'],
            ['name' => 'Groom Family'],
        ];

        foreach($data as $value){
            RelationGroup::create($value);
        }
        
    }
}
