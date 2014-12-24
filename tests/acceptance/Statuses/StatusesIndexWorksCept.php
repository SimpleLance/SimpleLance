<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the statuses index works');
$I->amOnPage('/statuses');
$I->see('Title', 'th');
$I->dontSee('whoops');
