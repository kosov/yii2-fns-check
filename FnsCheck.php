<?php

namespace yii\fnscheck;

use yii\fnscheck\models\CheckDetail;
use yii\fnscheck\models\CheckExist;
use yii\fnscheck\models\Restore;
use yii\fnscheck\models\Signup;
use FnsCheck\FnsCheckApi;
use FnsCheck\FnsCheckAuth;
use FnsCheck\FnsCheckHelper;
use Http\Client\HttpClient;
use yii\base\Component;
use yii\base\Exception;

/**
 * Class FnsCheck
 *
 * Компонент для работы с онлайн-чеками.
 *
 * @package yii\fnscheck
 * @author kosov <akosov@yandex.ru>
 */
class FnsCheck extends Component
{
    /**
     * Логин пользователя (телефон в формате +7XXXXXXXXXX).
     *
     * @var string
     */
    public $username;

    /**
     * Пароль пользователя (отправляется при регистрации в SMS).
     *
     * @var string
     */
    public $password;

    /**
     * Объект HTTP клиента для работы с API.
     *
     * @var string|HttpClient
     */
    public $httpClient;

    /**
     * Объект выполнения запросов к API ФНС.
     *
     * @var FnsCheckApi
     */
    private $api;

    /**
     * Объект аутентификации пользователя.
     *
     * @var FnsCheckAuth
     */
    private $auth;

    /**
     * Инициализация компонента.
     */
    public function init()
    {
        parent::init();

        if (!is_null($this->httpClient)) {
            if (class_exists($this->httpClient)) {
                $this->httpClient = new $this->httpClient();
            }

            if (!$this->httpClient instanceof HttpClient) {
                throw new Exception('Invalid HTTP client.');
            }
        }

        $this->api  = new FnsCheckApi($this->httpClient);
        $this->auth = new FnsCheckAuth($this->username, $this->password);
    }

    /**
     * @param Signup $signup Модель данных запроса регистрации пользователя
     *
     * @return \FnsCheck\response\SignupResponse
     */
    public function signup(Signup $signup)
    {
        return $this->api->signup($signup->getAttributes());
    }

    /**
     * @return \FnsCheck\response\LoginResponse
     */
    public function login()
    {
        return $this->api->login([], $this->auth);
    }

    /**
     * @param Restore $restore Модель данных запроса восстановления пароля пользователя
     *
     * @return \FnsCheck\response\RestoreResponse
     */
    public function restore(Restore $restore)
    {
        return $this->api->restore($restore->getAttributes());
    }

    /**
     * @param CheckDetail $checkDetail Модель данных запроса на получение детальной информации по чеку
     *
     * @return \FnsCheck\response\CheckDetailResponse
     */
    public function getCheckDetail(CheckDetail $checkDetail)
    {
        return $this->api->checkDetail($checkDetail->getAttributes(), $this->auth);
    }

    /**
     * @param CheckExist $checkExist Модель данных запроса проверки существования чека
     *
     * @return \FnsCheck\response\CheckExistResponse
     */
    public function getCheckExist(CheckExist $checkExist)
    {
        return $this->api->checkExist($checkExist->getAttributes(), $this->auth);
    }

    /**
     * Конвертирует данные, полученные из QR-кода, в массив данных для запроса к API.
     *
     * @param string $qrCodeString Данные QR-кода
     *
     * @return array Массив данных для запроса к API
     */
    public function fromQrCode($qrCodeString)
    {
        return FnsCheckHelper::fromQRCode($qrCodeString);
    }
}
