<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the tickets show works');
TestCommonAdmin::logMeIn($I);
$I->amOnPage('/tickets/1');
$I->see('Support Ticket', 'h4');
$I->see('Subject', 'strong');
$I->see('Ticket opened by', 'em');
$I->see('Priority', 'strong');
$I->see('Owner', 'strong');
$I->see('Ticket created', 'strong');
$I->see('Last Updated', 'strong');
$I->see('Edit Ticket', 'button');
$I->dontSee('whoops');
