<?php namespace CutePHP\Route;

use CutePHP\Route\Route;

/**
 * Route类的管理容器
 */
class Router{
    private $routes = array();

    public function match($uri, $method){
        foreach($this->routes as $route){
            if($route->match($uri, $method)){
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

    public function get($uri, $storage, $name = null){
        return $this->add($uri, $storage, $name, 'GET');
    }

    public function head($uri, $storage, $name = null){
        return $this->add($uri, $storage, $name, 'HEAD');
    }

    public function post($uri, $storage, $name = null){
        return $this->add($uri, $storage, $name, 'POST');
    }

    public function delete($uri, $storage, $name = null){
        return $this->add($uri, $storage, $name, 'DELETE');
    }

    public function put($uri, $storage, $name = null){
        return $this->add($uri, $storage, $name, 'PUT');
    }

    public function pathch($uri, $storage, $name = null){
        return $this->add($uri, $storage, $name, 'PATCH');
    }
}
