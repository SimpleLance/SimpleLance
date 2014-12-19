<?php
$I = new AcceptanceTester($scenario);
$I->am('an admin');
$I->wantTo('ensure an admin can view projects');
// We need to login as a user
TestCommonsAdmin::logMeIn($I);
$I->amOnPage('/');
$I->click('Project Tracker');
$I->click('View Projects');
$I->amOnPage('/projects');
$I->see('Name');
$I->see('Created On');
$I->see('Owner');
$I->see('Status');
$I->see('View');
