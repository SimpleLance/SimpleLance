<?php
class TestCommonAdmin
{
    public static $username = 'admin@admin.com';
    public static $password = 'simplelance';
    public static function logMeIn($I)
    {
        $I->amOnPage('/auth/login');
        $I->fillField(['name' => 'email'], self::$username);
        $I->fillField(['name' => 'password'], self::$password);
        $I->click('/html/body/div/div/div/div/div[2]/form/div[4]/div/button');
    }
}
