<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the ticket delete works');
$I->amOnPage('/tickets/1');
$I->click('#delete-1');
$I->amOnPage('/tickets');
$I->dontSee('whoops');
