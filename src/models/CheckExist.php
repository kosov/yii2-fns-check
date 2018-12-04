<?php

namespace kosov\yii\fnscheck\models;

use kosov\yii\fnscheck\FnsCheckModel;

/**
 * Class CheckExist
 *
 * Модель данных запроса проверки существования чека.
 *
 * @package kosov\yii\fnscheck\models
 * @author kosov <akosov@yandex.ru>
 */
class CheckExist extends FnsCheckModel
{
    /**
     * Фискальный номер.
     *
     * @var string
     */
    public $fiscalNumber;

    /**
     * Фискальный признак документа.
     *
     * @var string
     */
    public $fiscalSign;

    /**
     * Фискальный документ.
     *
     * @var string
     */
    public $fiscalDocument;

    /**
     * Дата создания чека.
     *
     * @var string
     */
    public $date;

    /**
     * Сумма чека в копейках.
     *
     * @var int
     */
    public $sum;

    /**
     * Тип операции "приход/расход".
     * "Приход" = 1
     * "Расход" = 0
     *
     * @var int
     */
    public $operation;
}
