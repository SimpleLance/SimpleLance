<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the invoice edit works');
TestCommonAdmin::logMeIn($I);
$I->amOnPage('/invoices/2');
$I->click('//*[@id="edit-2"]');
$I->amOnPage('/invoices/2/edit');
$I->see('Edit Invoice', 'h4');
$I->fillField('due', '2004-06-07');
$I->selectOption('owner_id', 'admin');
$I->selectOption('status_id', 'Open');
$I->click('#update');
$I->see('Invoices', 'h1');
$I->dontSee('whoops');
