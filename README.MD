Компонент OpenGraph для YII2
==
Компонент добавляет OpenGraph разметку.

Установка
--

* Распаковываем файлы в `vendor/websultan/`.
* В файл `vendor/composer/autoload_psr4.php` добавляем:
```php
    'websultan\\opengraph\\' => array($vendorDir . '/websultan/opengraph'),
```
* В `vendor/yiisoft/extensions.php` добавляем:
```php
'websultan/opengraph' => 
  array (
    'name' => 'websultan/opengraph',
    'version' => '1',
    'alias' => 
    array (
      '@websultan/opengraph' => $vendorDir . '/websultan/opengraph',
    ),
  ),
```
* Добавьте новый компонент в секцию `components` конфигурационного файла приложения:

```php
'components' => [
    'opengraph' => [
        'class' => 'websultan\opengraph\Opengraph',
    ],
    // ...
],
```

> В файле `your-app-config.php` должна быть конфигурация приложения

Использование
--
```php
Yii::$app->opengraph->setMeta([ 
    'title' => $product->name, 
    'description' => $product->description, 
    'image' => $socialMetaImage
]);

```