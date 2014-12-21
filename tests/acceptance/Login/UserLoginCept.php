<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that a user can login');
$I->amOnPage('/');
$I->click('Log In');
$I->fillField('email', 'user@user.com');
$I->fillField('password', 'simplelance');
$I->click('Sign In');
$I->see('Hello');
