<?php
$I = new AcceptanceTester($scenario);
$I->am('an admin');
$I->wantTo('ensure an admin can log out');
// We need to login as a user
TestCommonsAdmin::logMeIn($I);
$I->amOnPage('/');
$I->click('.dropdown-toggle');
$I->click('Logout');
$I->see('Please Sign In');
