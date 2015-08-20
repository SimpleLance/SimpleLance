<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the project show works');
TestCommonAdmin::logMeIn($I);
$I->amOnPage('/projects/1');
$I->see('Project', 'h4');
$I->see('Title', 'strong');
$I->see('Description', 'strong');
$I->see('Status', 'strong');
$I->see('Owner', 'strong');
$I->see('Project created', 'em');
$I->see('Last Updated', 'em');
$I->see('Edit Project', 'button');
$I->dontSee('whoops');
