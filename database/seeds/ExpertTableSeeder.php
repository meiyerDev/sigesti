<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Person;
use App\Expert;

class ExpertTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$user   = User::where('name', 'Tecnico')->first();
    	$person = Person::where('identity', '10512730')->first();

        $expert = new Expert();

        $expert->person_id = $person->id;
        $expert->user_id   = $user->id;

        $expert->save();
    }
}
