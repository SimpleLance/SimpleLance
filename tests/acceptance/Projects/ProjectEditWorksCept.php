<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the project edit works');
TestCommonAdmin::logMeIn($I);
$I->amOnPage('/projects/1');
$I->click('#edit-1');
$I->amOnPage('/projects/1/edit');
$I->see('Edit Project', 'h4');
$I->fillField('title', 'Test Project Updated');
$I->fillField('description', 'Test Project Description Updated');
$I->click('Submit Changes', '.btn');
$I->amOnPage('/projects');
$I->see('Test Project Updated', 'td');
$I->dontSee('whoops');
