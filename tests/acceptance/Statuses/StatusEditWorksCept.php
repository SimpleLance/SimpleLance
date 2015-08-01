<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the statuses edit works');
TestCommonAdmin::logMeIn($I);
$I->amOnPage('/statuses');
$I->click('#edit-1');
$I->amOnPage('/statuses/1/edit');
$I->see('Edit Status', 'h4');
$I->fillField('title', 'Test Status Updated');
$I->click('Submit Changes');
$I->amOnPage('/statuses');
$I->see('Test Status Updated', 'td');
$I->dontSee('whoops');
