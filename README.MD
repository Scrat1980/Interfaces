Тестовое задание PHP Backend developer
================

**Установка:**
~~~
curl -s http://getcomposer.org/installer | php
php composer.phar install
~~~

Основное задание
================

IPayment – интерфейс платежа.
IStorage – интерфейс хранилища платежей.

Нужно реализовать интерфейсы IPayment и IStorage.
Стиль кода должен соответствовать стандарту PSR-2.

Подготовить две реализации IStorage:
* MongoDB (3.4 или выше)
* Redis (2.8 или выше)

Реализация IStorage должна обновлять только измененные данные IPayment.

Для проверки задания нужно пройти Unit тесты.

**Запуск тестов:**
~~~
php ./vendor/phpunit/phpunit/phpunit --configuration phpunit.xml
~~~

Обратите внимание, интерфейс IPayment требует фабричный метод instance, но не накладывает ограничений на реализацию конструктора имплементирующего класса.

Дополнительные задания
================

Unit тесты
============
Дополнительным плюсом будут собственные Unit тесты.

Payment Handler
============
Дополнительным плюсом будет реализация интерфейса IHandler.

Из внешнего сервиса к нам в приложение последовательно приходят события о платежах.

В качестве результата в реализацию IStorage должны попадать платежи. Получение событий из внешнего сервиса происходит через точку входа `web/handler.php`.

**Проверка handler:**
~~~
php -S localhost:8000 web/handler.php

php send_events.php 'localhost:8000'
~~~