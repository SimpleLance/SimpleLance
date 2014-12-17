<?php
$I = new AcceptanceTester($scenario);
$I->am('an admin');
$I->wantTo('ensure an admin can login');
// We need to login as a user
TestCommonsAdmin::logMeIn($I);
$I->amOnPage('/');
$I->see('SimpleLance DEV', 'a');
$I->see('Under Construction', 'h1');
$I->seeLink('User Management');
$I->click('User Management');
$I->seeLink('View Users');
$I->seeLink('Add User');
$I->seeLink('Project Tracker');
$I->click('Project Tracker');
$I->seeLink('View Projects');
$I->seeLink('Add Project');
$I->seeLink('Support Tickets');
$I->click('Support Tickets');
$I->seeLink('View Tickets');
$I->seeLink('Add Ticket');
$I->seeLink('Invoices');
$I->click('Invoices');
$I->seeLink('View Invoices');
$I->seeLink('Create Invoice');
