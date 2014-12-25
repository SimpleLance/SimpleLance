<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TicketsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Ticket::create([
				'title' => $faker->sentence(),
				'description' => $faker->sentence(),
				'priority_id' => '1',
				'owner_id' => '1'
			]);
		}
	}

}