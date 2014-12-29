<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the invoices show works');
TestCommonAdmin::logMeIn($I);
$I->amOnPage('/invoices/1');
$I->see('Invoice', 'h4');
$I->see('Title', 'strong');
$I->see('Due Date', 'strong');
$I->see('Status', 'strong');
$I->see('Owner', 'strong');
$I->see('Invoice created', 'em');
$I->see('Last Updated', 'em');
$I->see('Edit Invoice', 'button');
$I->dontSee('whoops');
