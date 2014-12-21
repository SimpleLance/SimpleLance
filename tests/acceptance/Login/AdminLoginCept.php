<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that an admin can login');
$I->amOnPage('/');
$I->click('Log In');
$I->fillField('email', 'admin@admin.com');
$I->fillField('password', 'simplelance');
$I->click('Sign In');
$I->see('Hello admin!');
