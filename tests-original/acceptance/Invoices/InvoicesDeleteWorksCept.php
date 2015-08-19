<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the invoice delete works');
TestCommonAdmin::logMeIn($I);
$I->amOnPage('/invoices/2');
$I->click('#delete-2');
$I->amOnPage('/invoices');
$I->dontSee('whoops');
