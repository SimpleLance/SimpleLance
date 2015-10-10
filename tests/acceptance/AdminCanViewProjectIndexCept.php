<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('admin can view project index');
$I->amOnPage('/auth/login');
$I->fillField('//*[@id="email"]', 'admin@admin.com');
$I->fillField('//*[@id="password"]', 'simplelance');
$I->click('/html/body/div/div/div/div/div[2]/form/div[4]/div/button');
$I->click('//*[@id="side-menu"]/li[5]/a');
$I->click('//*[@id="side-menu"]/li[5]/ul/li[1]/a');
$I->see('Current Projects', '//*[@id="page-wrapper"]/h1');
$I->see('Sample Project', '//*[@id="page-wrapper"]/table/tbody/tr[1]/td[1]/a');
