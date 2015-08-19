<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the invoice create works');
TestCommonAdmin::logMeIn($I);
$I->amOnPage('/projects/create');
$I->see('Create New Project', 'h4');
$I->fillField('title', 'New Test Project');
$I->fillField('description', 'New Test Project Description');
$I->click('#create');
$I->see('Projects', 'h1');
$I->dontSee('whoops');
