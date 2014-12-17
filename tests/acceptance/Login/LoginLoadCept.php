<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that login page loads');
$I->amOnPage('/login.php');
$I->see('Please Sign In', 'h3');
