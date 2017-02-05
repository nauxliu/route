<?php namespace CutePHP\Route;

use CutePHP\Route\Route;

/**
 * Route类的管理容器
 */
class Router{
    private $routes = array();

    /**
     * 按照传入的规则从添加的路由中找到匹配路由
     * @param  String $uri    要匹配的URL
     * @param  String $method 匹配的HTTP方法
     * @return \CutePHP\Route\Route or false
     */
    public function match($uri, $method){

        foreach($this->routes as $route){
            if($route->match($uri, $method)){ //调用每个对象Route查询是非匹配
                return $route;
            }
        }
        //没有找到匹配的路由
        return false;
    }

    /**
     * 添加新的路由匹配
     * @param $uri
     * @param $storage
     * @param null $name
     * @param null $methods
     * @return Route
     */
    public function add($uri, $storage, $name = null, $methods = null){
        $route = new Route($uri, $storage, $methods);
        if($name !== null){
            $this->routes[$name] = $route;
        }else{
            $this->routes[] = $route;
        }
        return $route;
    }

    /**
     * 通过路由名字获取路由对象
     * @return \CutePHP\Route\Route or false
     */
    public function name($name){
        return isset($this->routes[$name]) ? $this->routes[$name] : false;
    }

    /**
     * 添加get参数路由
     * 
     * @param  String $uri     路由匹配的URI
     * @param  [Mix] [Mix] $storage 你要存入的任意类型
     * @param  String $name    路由名
     * @return \CutePHP\Route\Route     添加的Route对象
     */
    public function get($uri, $storage, $name = null){
        return $this->add($uri, $storage, $name, 'GET');
    }

    /**
     * 添加head参数路由
     * 
     * @param  String $uri     路由匹配的URI
     * @param  [Mix] $storage 你要存入的任意类型
     * @param  String $name    路由名
     * @return \CutePHP\Route\Route     添加的Route对象
     */
    public function head($uri, $storage, $name = null){
        return $this->add($uri, $storage, $name, 'HEAD');
    }

    /**
     * 添加post参数路由
     * 
     * @param  String $uri     路由匹配的URI
     * @param  [Mix] $storage 你要存入的任意类型
     * @param  String $name    路由名
     * @return \CutePHP\Route\Route     添加的Route对象
     */
    public function post($uri, $storage, $name = null){
        return $this->add($uri, $storage, $name, 'POST');
    }

    /**
     * 添加delete参数路由
     * 
     * @param  String $uri     路由匹配的URI
     * @param  [Mix] $storage 你要存入的任意类型
     * @param  String $name    路由名
     * @return \CutePHP\Route\Route     添加的Route对象
     */
    public function delete($uri, $storage, $name = null){
        return $this->add($uri, $storage, $name, 'DELETE');
    }

    /**
     * 添加put参数路由
     * 
     * @param  String $uri     路由匹配的URI
     * @param  [Mix] $storage 你要存入的任意类型
     * @param  String $name    路由名
     * @return \CutePHP\Route\Route     添加的Route对象
     */
    public function put($uri, $storage, $name = null){
        return $this->add($uri, $storage, $name, 'PUT');
    }

    /**
     * 添加pathch参数路由
     * 
     * @param  String $uri     路由匹配的URI
     * @param  [Mix] $storage 你要存入的任意类型
     * @param  String $name    路由名
     * @return \CutePHP\Route\Route     添加的Route对象
     */
    public function pathch($uri, $storage, $name = null){
        return $this->add($uri, $storage, $name, 'PATCH');
    }
}
