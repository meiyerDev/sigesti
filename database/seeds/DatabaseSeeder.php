<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		/// La creación de datos de roles debe ejecutarse primero
		$this->call(RoleTableSeeder::class);
		// Los usuarios necesitarán los roles previamente generados
		$this->call(UserTableSeeder::class);
		// La creacion de la persona debe ejecutarse primero
		$this->call(PersonTableSeeder::class);
		// Los expertos necesitaran la persona previamente generada
		$this->call(ExpertTableSeeder::class);
	}
}
