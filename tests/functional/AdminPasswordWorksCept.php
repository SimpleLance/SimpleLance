<?php
$I = new FunctionalTester($scenario);
$I->wantTo('ensure an admin can log in');
$I->amOnPage('/auth/login');
$I->fillField('email', 'admin@admin.com');
$I->fillField('password', '3l33tH4x0r4dm1N');
$I->click('body > div > div > div > div > div.panel-body > form > div:nth-child(5) > div > button');
$I->seeFormErrorMessage('email', 'These credentials do not match our records.');
$I->dontSee('Hello admin!');
