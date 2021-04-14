<?php

namespace app\models\enums;

class PromoTypeEnum
{
    const PERCENT = 'percent';
    const MONEY = 'money';

    public static $list = [
        self::PERCENT => 'Проценты',
        self::MONEY => 'Деньги'
    ];
}