<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that an admin can login');
TestCommonAdmin::logMeIn($I);
$I->amOnPage('/dashboard');
$I->see('Admin Dashboard');
