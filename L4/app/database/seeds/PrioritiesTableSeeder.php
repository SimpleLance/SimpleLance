<?php

class PrioritiesTableSeeder extends Seeder {

	public function run()
	{
		Priority::create([
			'title' => 'Low'
		]);
		Priority::create([
			'title' => 'Medium'
		]);
		Priority::create([
			'title' => 'High'
		]);
		Priority::create([
			'title' => 'Urgent'
		]);
		Priority::create([
			'title' => 'Critical'
		]);
	}

}