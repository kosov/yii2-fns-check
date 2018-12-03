<?php

namespace yii\fnscheck\models;

use yii\fnscheck\FnsCheckModel;

/**
 * Class Restore
 *
 * Модель данных запроса восстановления пароля пользователя.
 *
 * @package yii\fnscheck\models
 * @author kosov <akosov@yandex.ru>
 */
class Restore extends FnsCheckModel
{
    /**
     * Телефон пользователя.
     *
     * @var string
     */
    public $phone;
}
