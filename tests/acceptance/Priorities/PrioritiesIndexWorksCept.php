<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the priorities index works');
TestCommonAdmin::logMeIn($I);
$I->amOnPage('/priorities');
$I->see('Title', 'th');
$I->dontSee('whoops');
