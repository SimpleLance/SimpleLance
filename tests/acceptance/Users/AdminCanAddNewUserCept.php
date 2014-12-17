<?php
$I = new AcceptanceTester($scenario);
$I->am('an admin');
$I->wantTo('ensure an admin can add new user');
// We need to login as a user
TestCommonsAdmin::logMeIn($I);
$I->amOnPage('/');
$I->click('User Management');
$I->click('Add User');
$I->amOnPage('/users/register.php');
$I->fillField('first_name', 'Test');
$I->fillField('last_name', 'User');
$I->fillField('email', 'test@simplelance.com');
$I->fillField('password', 'testUser1234');
$I->fillField('password_repeat', 'testUser1234');
$I->fillField('address_1', '123 Bogus Street');
$I->fillField('city', 'Al Ain');
$I->fillField('country', 'United Arab Emirates');
$I->click('Save');
$I->seeInDatabase('users', array('first_name' => 'Test', 'last_name' => 'User', 'email' => 'test@simplelance.com'));
$I->amOnPage('/users');