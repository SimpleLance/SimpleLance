<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that someone can reply to a ticket');
TestCommonAdmin::logMeIn($I);
$I->amOnPage('/tickets/1');
$I->fillField('content', 'This is a test reply');
$I->click('//*[@id="page-wrapper"]/div[2]/div[2]/form/input[2]');
$I->amOnPage('/tickets/1');
$I->see('Reply by', 'em');
$I->see('This is a test reply');
$I->dontSee('whoops');
