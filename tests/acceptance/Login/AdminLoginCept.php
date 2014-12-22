<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that an admin can login');
TestCommonAdmin::logMeIn($I);
$I->see('Hello admin!');
