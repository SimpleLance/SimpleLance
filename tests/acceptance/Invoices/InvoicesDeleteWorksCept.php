<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the invoice delete works');
TestCommonAdmin::logMeIn($I);
$I->amOnPage('/invoices/1');
$I->click('#delete-1');
$I->amOnPage('/invoices');
$I->dontSee('whoops');
