<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the invoice create works');
TestCommonAdmin::logMeIn($I);
$I->amOnPage('/invoices/create');
$I->see('Create New Invoice', 'h4');
$I->fillField('due', '2005-06-07');
$I->selectOption('owner_id', 'admin');
$I->selectOption('status_id', 'Open');
$I->click('#create');
$I->see('Invoices', 'h1');
$I->dontSee('whoops');
