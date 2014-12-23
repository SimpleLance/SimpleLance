<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the priorities delete works');
$I->amOnPage('/priorities');
$I->click('#delete-1');
$I->amOnPage('/priorities');
$I->dontSee('Low', 'td');
$I->dontSee('whoops');
