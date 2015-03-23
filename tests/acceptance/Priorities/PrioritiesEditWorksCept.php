<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the priorities edit works');
TestCommonAdmin::logMeIn($I);
$I->amOnPage('/priorities');
$I->click('#edit-1');
$I->amOnPage('/priorities/1/edit');
$I->see('Edit Priority', 'h4');
$I->fillField('title', 'Test Priority Updated');
$I->click('Submit Changes', '.btn');
$I->amOnPage('/priorities');
$I->see('Test Priority Updated', 'td');
$I->dontSee('whoops');
