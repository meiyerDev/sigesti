<?php

use Illuminate\Database\Seeder;
use App\Person;

class PersonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $person = new Person();

        $person->identity   = '10512730';
        $person->first_name = 'Maiva';
        $person->last_name  = 'Valderrama';
        $person->phone      = '04147497797';

        $person->save();
    }
}
