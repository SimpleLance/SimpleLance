<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the 404 page works');
$I->haveEnabledFilters();
$I->amOnPage('/some/bad/url/that/will/never/exist');
$I->seePageNotFound();
$I->dontSee('whoops');
