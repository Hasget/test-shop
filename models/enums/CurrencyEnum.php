<?php

namespace app\models\enums;

class CurrencyEnum
{
    const RUB = 'rub';
    const USD = 'usd';
    const EURO = 'euro';

    public static $list = [
        self::RUB => 'Рубли',
        self::USD => 'Доллары',
        self::EURO => 'Евро'
    ];
}