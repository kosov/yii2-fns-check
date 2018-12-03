<?php

namespace yii\fnscheck\models;

use yii\fnscheck\FnsCheckModel;

/**
 * Class Signup
 *
 * Модель данных запроса регистрации пользователя.
 *
 * @package yii\fnscheck\models
 * @author kosov <akosov@yandex.ru>
 */
class Signup extends FnsCheckModel
{
    /**
     * Email пользователя.
     *
     * @var string
     */
    public $email;

    /**
     * Имя пользователя.
     *
     * @var string
     */
    public $name;

    /**
     * Телефон пользователя.
     *
     * @var string
     */
    public $phone;
}
