<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('SentryGroupSeeder');
		$this->call('SentryUserSeeder');
		$this->call('SentryUserGroupSeeder');
		$this->call('PrioritiesTableSeeder');
		$this->call('StatusesTableSeeder');
		$this->call('ProjectsTableSeeder');
		$this->call('TicketsTableSeeder');
		$this->call('InvoicesTableSeeder');
	}

}
