<?php

namespace kosov\yii\fnscheck\models;

use kosov\yii\fnscheck\FnsCheckModel;

/**
 * Class CheckDetail
 *
 * Модель данных запроса на получение детальной информации по чеку.
 *
 * @package kosov\yii\fnscheck\models
 * @author kosov <akosov@yandex.ru>
 */
class CheckDetail extends FnsCheckModel
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
}
