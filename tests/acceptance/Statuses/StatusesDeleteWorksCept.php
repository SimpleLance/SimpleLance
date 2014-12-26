<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the statuses delete works');
TestCommonAdmin::logMeIn($I);
$I->amOnPage('/statuses');
$I->click('#delete-1');
$I->amOnPage('/statuses');
$I->dontSee('Open', 'td');
$I->dontSee('whoops');
