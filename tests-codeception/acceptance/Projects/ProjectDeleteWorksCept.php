<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the project delete works');
TestCommonAdmin::logMeIn($I);
$I->amOnPage('/projects/1');
$I->click('#delete-1');
$I->amOnPage('/projects');
$I->dontSee('whoops');
