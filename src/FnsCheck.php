<?php

namespace kosov\yii\fnscheck;

use kosov\yii\fnscheck\models\CheckDetail;
use kosov\yii\fnscheck\models\CheckExist;
use kosov\yii\fnscheck\models\Restore;
use kosov\yii\fnscheck\models\Signup;
use kosov\fnscheck\FnsCheckApi;
use kosov\fnscheck\FnsCheckAuth;
use kosov\fnscheck\FnsCheckHelper;
use Http\Client\HttpClient;
use yii\base\Component;
use yii\base\InvalidConfigException;

/**
 * Class FnsCheck
 *
 * Компонент для работы с онлайн-чеками.
 *
 * @package kosov\yii\fnscheck
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
     *
     * @throws InvalidConfigException Если указан некорректный HTTP-клиент
     */
    public function init()
    {
        if (!is_null($this->httpClient)) {
            if (class_exists($this->httpClient)) {
                $this->httpClient = new $this->httpClient();
            }

            if (!$this->httpClient instanceof HttpClient) {
                throw new InvalidConfigException('Invalid HTTP client.');
            }
        }

        $this->api  = new FnsCheckApi($this->httpClient);
        $this->auth = new FnsCheckAuth($this->username, $this->password);
    }

    /**
     * Выполняет запрос на регистрацию нового пользователя.
     *
     * @param Signup $signup Модель данных запроса регистрации пользователя
     *
     * @return \kosov\fnscheck\response\SignupResponse
     *
     * @throws \kosov\fnscheck\FnsCheckApiException
     */
    public function signup(Signup $signup)
    {
        return $this->api->signup($signup->getAttributes());
    }

    /**
     * Выполняет запрос на авторизацию пользователя.
     *
     * @return \kosov\fnscheck\response\LoginResponse
     *
     * @throws \kosov\fnscheck\FnsCheckApiException
     */
    public function login()
    {
        return $this->api->login([], $this->auth);
    }

    /**
     * Выполняет запрос на восстановление пароля пользователя.
     *
     * @param Restore $restore Модель данных запроса восстановления пароля пользователя
     *
     * @return \kosov\fnscheck\response\RestoreResponse
     *
     * @throws \kosov\fnscheck\FnsCheckApiException
     */
    public function restore(Restore $restore)
    {
        return $this->api->restore($restore->getAttributes());
    }

    /**
     * Выполняет запрос на получение детальной информации по чеку.
     *
     * @param CheckDetail $checkDetail Модель данных запроса на получение детальной информации по чеку
     *
     * @return \kosov\fnscheck\response\CheckDetailResponse
     *
     * @throws \kosov\fnscheck\FnsCheckApiException
     */
    public function getCheckDetail(CheckDetail $checkDetail)
    {
        return $this->api->checkDetail($checkDetail->getAttributes(), $this->auth);
    }

    /**
     * Выполняет запрос на проверку существования чека.
     *
     * @param CheckExist $checkExist Модель данных запроса проверки существования чека
     *
     * @return \kosov\fnscheck\response\CheckExistResponse
     *
     * @throws \kosov\fnscheck\FnsCheckApiException
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
