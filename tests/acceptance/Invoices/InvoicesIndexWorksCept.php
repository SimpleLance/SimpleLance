<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the invoices index works');
TestCommonAdmin::logMeIn($I);
$I->amOnPage('/invoices');
$I->see('Due Date', 'th');
$I->see('Status', 'th');
$I->see('Owner', 'th');
$I->see('Amount', 'th');
$I->dontSee('whoops');
