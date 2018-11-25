<?php

namespace yii\fnscheck;

use yii\base\BaseObject;

/**
 * Class FnsCheckModel
 *
 * Класс базовой модели.
 *
 * @package yii\fnscheck
 * @author kosov <akosov@yandex.ru>
 */
abstract class FnsCheckModel extends BaseObject
{
    /**
     * Конструктор модели.
     * Выполняет безопасную конфигурацию атрибутов модели.
     *
     * @param array $config Массив атрибутов модели
     */
    public function __construct(array $config = [])
    {
        $config = array_filter($config, function ($property) {
            return $this->hasProperty($property);
        }, ARRAY_FILTER_USE_KEY);

        parent::__construct($config);
    }

    /**
     * Возвращает атрибуты модели в виде массива.
     *
     * @return array Массив атрибутов модели
     */
    public function getAttributes()
    {
        return (array) $this;
    }
}
