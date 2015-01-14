<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that a user can login');
TestCommonUser::logMeIn($I);
$I->see('User Dashboard');
