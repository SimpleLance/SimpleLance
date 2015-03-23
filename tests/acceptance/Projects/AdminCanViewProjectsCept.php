<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that an admin can view a list of projects');
TestCommonAdmin::logMeIn($I);
$I->click('Project Tracker');
$I->click('View Projects');
$I->see('Sample Project');
