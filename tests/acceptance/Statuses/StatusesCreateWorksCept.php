<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the statuses create works');
TestCommonAdmin::logMeIn($I);
$I->amOnPage('/statuses');
$I->click('#new');
$I->amOnPage('/statuses/create');
$I->see('Create New Status', 'h4');
$I->fillField('title', 'Test Status');
$I->click('Create', '.create');
$I->amOnPage('/statuses');
$I->see('Test Status', 'td');
$I->dontSee('whoops');
