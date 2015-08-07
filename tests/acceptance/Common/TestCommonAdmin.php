<?php
class TestCommonAdmin
{
    public static $username = 'admin@admin.com';
    public static $password = 'simplelance';
    public static function logMeIn($I)
    {
        $I->amOnPage('/auth/login');
        $I->fillField('/html/body/div/div/div/div/div[2]/form/div[1]/div/input', self::$username);
        $I->fillField('/html/body/div/div/div/div/div[2]/form/div[2]/div/input', self::$password);
        $I->click('/html/body/div/div/div/div/div[2]/form/div[4]/div/button');
    }
}
