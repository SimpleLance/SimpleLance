<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure an admin can log in');
$I->amOnPage('/auth/login');
$I->fillField('//*[@id="email"]', 'admin@admin.com');
$I->fillField('//*[@id="password"]', 'simplelance');
$I->click('/html/body/div/div/div/div/div[2]/form/div[4]/div/button');
$I->see('Something NOT on the page!', '//*[@id="page-wrapper"]/h1');
