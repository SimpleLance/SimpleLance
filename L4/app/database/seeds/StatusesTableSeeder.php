<?php

class StatusesTableSeeder extends Seeder {

	public function run()
	{
		Status::create([
			'title' => 'Open'
		]);
		Status::create([
			'title' => 'In Progress'
		]);
		Status::create([
			'title' => 'On Hold'
		]);
		Status::create([
			'title' => 'Closed'
		]);
	}

}