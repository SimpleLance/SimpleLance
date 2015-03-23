<?php
class TestCommonUser
{
    public static $username = 'user@user.com';
    public static $password = 'simplelance';
    public static function logMeIn($I)
    {
        $I->amOnPage('/');
        $I->click('Log In');
        $I->fillField('email', self::$username);
        $I->fillField('password', self::$password);
        $I->click('Sign In');
    }
}