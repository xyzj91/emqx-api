# EMQ X HTTP API Hyperf版

EMQ X 管理组件资源开放接口 Hyperf版,组件基于https://github.com/kainonly/emqx-management-api.git修改而来

## 安装

```shell
composer require xyzj91/emqx-api
```

## 快速开始

创建客户端

```php
$emqx = \EMQX\API\EMQXClient::create(
    'http://localhost:8081/api/v4/',
    '<your appid>',
    '<your appsecret>'
);

$response = $emqx->endpoints();
if ($response->isError()) {
    echo $response->getMsg();
    return;
}

var_dump($response->result());
```

或者自定义 `\GuzzleHttp\Client`

```php
$client = new \GuzzleHttp\Client([
    'base_uri' => 'http://localhost:8081/api/v4/',
    'auth' => ['<your appid>', '<your appsecret>'],
    'timeout' => 30.0,
    'debug' => false,
    'verify' => false,
    'version' => 1.1
]);

$emqx = new \EMQX\API\EMQXClient($client);

$response = $emqx->endpoints();
if ($response->isError()) {
    echo $response->getMsg();
    return;
}

var_dump($response->result());
```

发布消息

```php
$option = new \EMQX\API\Common\MqttPublishOption(
    ['notification'],
    'hello'
);
$option->setEncoding('plain');
$option->setQos(0);
$option->setRetain(false);
$response = $emqx->mqtt()->publish($option);

if ($response->isError()) {
    echo $response->getMsg();
    return;
}
var_dump($response->result());
```

SDK 遵循官网文档开发，https://docs.emqx.cn/broker/latest/advanced/http-api.html




