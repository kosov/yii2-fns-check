# yii2-fns-check
Расширение для фреймворка Yii2, позволяющее работать с [PHP клиентом](https://github.com/kosov/fns-check) API ФНС для онлайн-чеков.

Описание доступных методов API находится можно посмотреть в [README](https://github.com/kosov/fns-check/blob/master/README.md) соответствующей библиотеки.


Установка
---------

Предпочтительный способ устаноки расшрения через [composer](http://getcomposer.org/download/). Для работы расширения необходимо установить набор пакетов, реализующих стандарт [PSR-7](https://www.php-fig.org/psr/psr-7/), например:

```
composer require php-http/curl-client guzzlehttp/psr7 php-http/message
```

Подробнее можно почитать [здесь](http://docs.php-http.org/en/latest/httplug/users.html). Далее запустите

```
composer require --prefer-dist kosov/yii2-fns-check:"~1.0.0"
```

в директории своего проекта или добавьте

```json
"kosov/yii2-fns-check": "~1.0.0"
```

в секцию `require` файла `composer.json` вашего проекта.


Конфигурация
------------

Для использования расширения сконфигурируйте компонент в конфигурации приложения:

```php
return [
    //....
    'components' => [
        'fnsCheck' => [
            'class' => 'kosov\yii\fnscheck\FnsCheck',
            'username' => '+7XXXXXXXXXX', // Логин пользователя
            'password' => 'XXXXXX', // Пароль пользователя
        ],
    ]
];
```

Пример использования
--------------------

```php
/**
 * Страница вывода детальной информации по чеку.
 */
public function actionDetail()
{
    Yii::$app->getResponse()->format = Response::FORMAT_JSON;

    // Данные с QR-кода t=20181109T194700&s=222.58&fn=XXXXXXXXXXXXXXXX&i=XXXXX&fp=XXXXXXXXX&n=1
    $checkData = Yii::$app->fnsCheck->fromQrCode(Yii::$app->getRequest()->getQueryString());
        
    try {
        // Получение детальной информации по реквизитам чека
        $response = Yii::$app->fnsCheck->getCheckDetail(new CheckDetail($checkData));
        
        return Json::decode($response->getContents());
    } catch (FnsCheckApiException $exception) {
        return Json::encode(['error' => $exception->getMessage()]);
    }
}
```
