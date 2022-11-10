<?php

namespace App\Imports;

use App\Models\Leads;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LeadsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Leads([
            'name'     => $row['name'],
            'mobile'    => $row['mobile'], 
            'budget'    => $row['budget'],
            'details'    => $row['details'],
            'category_id'    => $row['category_id'],
            'event_date'    => date('Y-m-d',strtotime($row['event_date'])),
            'city'    => $row['city'],
            'view_count'    =>  '0',
            'status'    =>  '1',
            'approved_status'   =>  '0',
            'apply_tags' => '0'
            
        ]);
    }
}
