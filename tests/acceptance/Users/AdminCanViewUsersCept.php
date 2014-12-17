<?php
$I = new AcceptanceTester($scenario);
$I->am('an admin');
$I->wantTo('ensure an admin can view users');
// We need to login as a user
TestCommonsAdmin::logMeIn($I);
$I->amOnPage('/');
$I->click('User Management');
$I->click('View Users');
$I->amOnPage('/users');
$I->see('admin@simplelance.com');
$I->see('customer@simplelance.com');
