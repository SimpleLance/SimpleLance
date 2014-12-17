<?php
$I = new AcceptanceTester($scenario);
$I->am('a user');
$I->wantTo('ensure user can login');
// We need to login as a user
TestCommonsUser::logMeIn($I);
$I->amOnPage('/');
$I->see('SimpleLance DEV', 'a');
$I->see('Under Construction', 'h1');
$I->seeLink('User Profile');
$I->seeLink('Projects');
$I->seeLink('Support Tickets');
$I->seeLink('Invoices');
