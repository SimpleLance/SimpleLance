<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the priorities create works');
TestCommonAdmin::logMeIn($I);
$I->amOnPage('/priorities');
$I->click('#new');
$I->amOnPage('/priorities/create');
$I->see('Create New Priority', 'h4');
$I->fillField('title', 'Test Priority');
$I->click('Create', '.create');
$I->amOnPage('/priorities');
$I->see('Test Priority', 'td');
$I->dontSee('whoops');
