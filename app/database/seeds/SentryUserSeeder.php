<?php

class SentryUserSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->delete();

		Sentry::getUserProvider()->create(array(
	        'email'    => 'admin@admin.com',
	        'username' => 'admin',
	        'password' => 'simplelance',
	        'activated' => 1,
			'first_name' => 'Admin',
			'last_name' => 'User',
			'phone' => '+1 (432) 432-4324',
			'country' => 'USA',
			'post_code' => '45524',
			'state' => 'NY',
			'address2' => 'Brooklyn',
			'address' => '123 Any Street'
	    ));

	    Sentry::getUserProvider()->create(array(
	        'email'    => 'user@user.com',
	        'username' => 'user',
	        'password' => 'simplelance',
	        'activated' => 1,
			'first_name' => 'Customer',
			'last_name' => 'User',
			'phone' => '+1 (432) 432-4324',
			'country' => 'USA',
			'post_code' => '45524',
			'state' => 'NY',
			'address2' => 'Brooklyn',
			'address' => '123 Any Street'
	    ));
	}

}