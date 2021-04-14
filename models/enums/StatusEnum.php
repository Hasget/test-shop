<?php

namespace app\models\enums;

class StatusEnum
{
    const DRAFT = 'draft';
    const ACTIVE = 'active';

    public static $list = [
        self::DRAFT => 'Черновик',
        self::ACTIVE => 'Активный'
    ];
}