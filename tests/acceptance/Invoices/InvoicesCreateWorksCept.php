<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the invoice create works');
TestCommonAdmin::logMeIn($I);
$I->amOnPage('/invoices/create');
$I->see('Create New Invoice', 'h4');
$I->fillField('due', '2005-06-07');
$I->click('Create', '.btn');
$I->see('Invoice #', 'h2');
$I->see('Billed To', 'strong');
$I->click('Send Invoice', '.btn');
$I->see('2005-06-07');
$I->dontSee('whoops');
