<?php
$I = new AcceptanceTester($scenario);
$I->am('an admin');
$I->wantTo('ensure an admin can view own profile');
// We need to login as a user
TestCommonsAdmin::logMeIn($I);
$I->amOnPage('/');
$I->click('.dropdown-toggle');
$I->click('User Profile');
$I->see('Email Address:');
$I->see('admin@simplelance.com');
$I->see('User Type:');
$I->see('Admin');
