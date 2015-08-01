<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the 404 page works');
$I->amOnPage('/some/bad/url/that/will/never/exist');
$I->see('404 - Page Not Found');
$I->dontSee('whoops');
