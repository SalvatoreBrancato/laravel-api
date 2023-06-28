<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Type;
class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'FrontEnd', 
            'Backend', 
            'FullStack', 
            'Design'
        ];

        foreach($types as $elem){
            $new_type = new Type();
            $new_type->name = $elem;
            $new_type->save();
        }
    }
}
