<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class InvoicesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			$status = Status::orderByRaw("RAND()")->first();
			$user = User::orderByRaw("RAND()")->first();
			Invoice::create([
				'due' => $faker->date(),
				'status_id' => $status->id,
				'amount' => $faker->randomFloat($nbMaxDecimals = 2),
				'owner_id' => $user->id
			]);
		}
	}

}