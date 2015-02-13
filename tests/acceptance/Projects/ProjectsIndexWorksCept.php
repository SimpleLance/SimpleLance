<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the projects index works');
TestCommonAdmin::logMeIn($I);
$I->amOnPage('/projects');
$I->see('Title', 'th');
$I->see('Updated At', 'th');
$I->see('Priority', 'th');
$I->see('Owner', 'th');
$I->dontSee('whoops');
