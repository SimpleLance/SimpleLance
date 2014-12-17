<?php
class TestCommonsUser
{
    public static $username = 'customer@simplelance.com';
    public static $password = 'customer123';

    public static function logMeIn($I)
    {
        $I->amOnPage('/login.php');
        $I->fillField('email', self::$username);
        $I->fillField('password', self::$password);
        $I->click('Login');
    }
}