<?php
$I = new FunctionalTester($scenario);
$I->wantTo('ensure an admin can log in');
$I->amOnPage('/auth/login');
$I->fillField('email', 'admin@admin.com');
$I->fillField('password', 'simplelance');
$I->click('body > div > div > div > div > div.panel-body > form > div:nth-child(5) > div > button');
$I->see('Hello admin!');
