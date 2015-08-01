<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the invoice create works');
TestCommonAdmin::logMeIn($I);
$I->amOnPage('/invoices/create');
$I->see('Create New Invoice', 'h4');
$I->fillField('due', '2005-06-07');
$I->selectOption('form select[name=owner_id]', 'admin');
$I->click('#create');
$I->seeElement('//*[@id="page-wrapper"]/h1');
$I->dontSee('whoops');
