<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the invoice create works');
TestCommonAdmin::logMeIn($I);
$I->amOnPage('/invoices/create');
$I->see('Create New Invoice', 'h4');
$I->fillField('title', 'Test Invoice');
$I->fillField('due', '2004-06-07');
$I->click('Create', '.btn');
$I->amOnPage('/invoices');
$I->see('Test Invoice', 'td');
$I->dontSee('whoops');
