<?php
class TestCommonsAdmin
{
    public static $username = 'admin@simplelance.com';
    public static $password = 'admin123';

    public static function logMeIn($I)
    {
        $I->amOnPage('/login.php');
        $I->fillField('email', self::$username);
        $I->fillField('password', self::$password);
        $I->click('Login');
    }
}