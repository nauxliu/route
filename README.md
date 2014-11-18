#安装
在你的composer.json中添加
```json
"require": {
    "cutephp/route": "dev-master"
},
```

#使用

####添加基本路由
调用和HTTP方法同名的函数名来添加路由，第一个参数为接受的URI，第二个参数为任意类型。匹配成功后可通过`getStorage()`方法原样取出。

```php
use CutePHP\Route\Router;

$router = new Router;
//添加一个接受Get请求的路由
$router->get('/test', 'test');
//添加一个接受Post请求的路由
$router->post('/test', 'test');
//添加一个接受Delete请求的路由
$router->delete('/test', 'test');
//添加一个接受Put请求的路由
$router->put('/test', 'test');
//添加一个接受Head请求的路由
$router->head('/test', 'test');
//添加一个接受Patch请求的路由
$router->patch('/test', 'test');
```

>注意：GET路由会同意匹配HEAD请求。

####获得匹配的路由

```php
use CutePHP\Route\Router;

$router = new Router;

$router->get('/about', '这是/about路由');
$router->get('/articles', '这是/articles路由');

//第一个参数为URI，第二个参数为HTTP方法。返回匹配的Route对象
$route = $router->match('/about','get');

//取出添加时第二个参数存储的值
echo $route->getStorage();
```

会看到结果为`这是/about路由`的输出


####添加同时支持多种HTTP方法的路由
通过调用`via`方法传入多个http方法名

```php
$router->add('/test',function(){
    return 123;
})->via('get','post');
```
####有名字的路由
```php
$router->get('/test', 123, 'MyName');
$res = $route->name('MyName');

$res->getUri(); // '/test'
$res->getStorage(); // 123
$res->getMethods(); // array( 0 => 'GET')
```

####添加可以接受参数的路由
路由参数节点使用`:`做前缀标识

```php
$router->get('/test/:id',function(){
    return 123;
});

$res = $router->match('/test/2','get');
$params = $res->getParams();
var_dump($params);
```
输出结果为

```
array(1) {
  ["id"]=>
  string(1) "2"
}
```
####添加可选参数的路由

```php
$router->get('/users/:id?',function(){
    return 123;
});
```
这时`/users`或`/users/1`都可匹配到此路由。如果匹配`/users/1`,`getParams()`还可获得`id`对应`1`的数组。

