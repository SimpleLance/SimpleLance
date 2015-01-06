<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the ticket edit works');
TestCommonAdmin::logMeIn($I);
$I->amOnPage('/tickets/1');
$I->click('#edit-1');
$I->amOnPage('/tickets/1/edit');
$I->see('Edit Support Ticket', 'h4');
$I->click('Submit Changes', '.btn');
$I->amOnPage('/tickets');
$I->dontSee('whoops');