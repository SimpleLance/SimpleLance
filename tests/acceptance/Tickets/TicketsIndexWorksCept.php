<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the tickets index works');
$I->amOnPage('/tickets');
$I->see('Title', 'th');
$I->see('Description', 'th');
$I->see('Priority', 'th');
$I->see('Owner', 'th');
$I->dontSee('whoops');
