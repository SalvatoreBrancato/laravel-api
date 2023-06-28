<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Technology;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technology = [
            'HTML', 
            'CSS', 
            'JavaScript', 
            'VUE',
            'PHP',
            'Laravel'
        ];

        foreach($technology as $elem){
            $new_type = new Technology();
            $new_type->name = $elem;
            $new_type->save();
        }
    }
}
