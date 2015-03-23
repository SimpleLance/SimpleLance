<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the statuses index works');
TestCommonAdmin::logMeIn($I);
$I->amOnPage('/statuses');
$I->see('Title', 'th');
$I->dontSee('whoops');
