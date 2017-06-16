# tuling-sdk

图灵 SDK 

## 安装

```php
composer require hanson/tuling-sdk
```

## 文档

官方文档：http://doc.tuling123.com/openapi2/263611

普通用法：

```php
use Hanson\Tuling\Tuling;


$tuling = new Tuling($key, $secret);

$result = $tuling->text('广州天气')->request();
```

设置用户ID：

```php
use Hanson\Tuling\Tuling;


$tuling = new Tuling($key, $secret);

$result = $tuling->text('广州天气')->user($id)->request();
```

设置位置：

```php
use Hanson\Tuling\Tuling;


$tuling = new Tuling($key, $secret);

$result = $tuling->text('天气')->location(['city' => '广州'])->user($id)->request();
```

默认为输出文字信息，若需要输出图灵原生返回的数组，可把 `->request()` 改为 `->request(true)`