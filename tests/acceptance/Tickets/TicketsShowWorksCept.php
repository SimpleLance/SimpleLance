<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the tickets show works');
TestCommonAdmin::logMeIn($I);
$I->amOnPage('/tickets/1');
$I->see('Support Ticket', 'h4');
$I->see('Title', 'strong');
$I->see('Description', 'strong');
$I->see('Priority', 'strong');
$I->see('Owner', 'strong');
$I->see('Ticket created', 'em');
$I->see('Last Updated', 'em');
$I->see('Edit Ticket', 'button');
$I->dontSee('whoops');
