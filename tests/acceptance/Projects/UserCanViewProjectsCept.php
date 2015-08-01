<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that a user can view a list of their projects');
TestCommonUser::logMeIn($I);
$I->click('Projects');
$I->see('Sample Project', 'tr');
$I->see('user', 'tr');
