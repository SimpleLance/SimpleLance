<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the invoices show works');
TestCommonAdmin::logMeIn($I);
$I->amOnPage('/invoices/2');
$I->see('Invoice', 'h2');
$I->see('Due Date', 'strong');
$I->see('Status', 'strong');
$I->see('Billed To', 'strong');
$I->see('Created Date', 'strong');
$I->see('Edit Invoice', 'button');
$I->dontSee('whoops');
