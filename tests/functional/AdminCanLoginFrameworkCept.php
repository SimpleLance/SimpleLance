<?php
$I = new FunctionalTester($scenario);
$I->wantTo('ensure an admin can log in');
$I->amOnAction('Auth\AuthController@getLogin');
$I->fillField('email', 'admin@admin.com');
$I->fillField('password', 'simplelance');
$I->click('body > div > div > div > div > div.panel-body > form > div:nth-child(5) > div > button');
$I->seeRecord('users', array('email' => 'admin@admin.com'));
$I->see('Hello admin!');
