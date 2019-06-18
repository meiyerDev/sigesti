<?php

use Illuminate\Database\Seeder;
use App\Department;

class DepartmentDefault extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Department::create([
    		'department'=>'Dirección de Informática',
    		'firstname_director'=>'Nombre del Director',
    		'lastname_director'=>'Apellido del Director',
    		'phone'=>'04124564565',
    	]);
    }
}
