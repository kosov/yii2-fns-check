<?php

namespace kosov\yii\fnscheck\models;

use kosov\yii\fnscheck\FnsCheckModel;

/**
 * Class Restore
 *
 * Модель данных запроса восстановления пароля пользователя.
 *
 * @package kosov\yii\fnscheck\models
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
