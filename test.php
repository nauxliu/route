<?php
include __DIR__.'/vendor/autoload.php';

class RouteTest extends PHPUnit_Framework_TestCase{

    /**
     * 测试单个参数节点路由参数匹配
     */
    public function testOneParam(){
        $route = new \CutePHP\Route\Router();
        $route->get('/user/:id/edit','test');
        $res = $route->match('/user/1/edit','GET');

        $param = $res->getParams();
        $this->assertEquals($param['id'], 1);

    }

    /**
     * 测试多个参数节点路由参数匹配
     */
    public function testultiParams(){
        $route = new \CutePHP\Route\Router();
        $route->get('/user/:name/:id','test');
        $res = $route->match('/user/testname/2','GET');

        $params = $res->getParams();

        $this->assertEquals($params['name'], 'testname');
        $this->assertEquals($params['id'], 2);
    }

    /**
     * 测试可选参数
     */
    public function testOptionalParameters(){
        $route = new \CutePHP\Route\Router();
        $route->get('/user/:name/:password?','test');

        //未传入可选参数的情况
        $res = $route->match('/user/username','GET');
        $params = $res->getParams();
        $this->assertEquals($params['name'], 'username');
        $this->assertArrayNotHasKey('password',$params);

        //传入了可选参数请求
        $res = $route->match('/user/username/mypassword','GET');
        $params = $res->getParams();
        $this->assertEquals($params['name'], 'username');
        $this->assertEquals($params['password'],'mypassword');
    }

    /**
     * 测试HTTP方法的验证
     */
    public function testHttpMethod(){
        $route = new \CutePHP\Route\Router();
        $route->get('/test','test');
        $same_method = $route->match('/test','get');
        $different_method = $route->match('/test','post');
        $head_request = $route->match('/test','head'); //get路由会允许匹配head请求

        $this->assertNotEmpty($same_method);
        $this->assertEmpty($different_method);
        $this->assertNotEmpty($head_request);
    }

    /**
     * 测试存储在路由中的信息能取出来
     */
    public function testStorage(){
        $route = new \CutePHP\Route\Router();

        $route->get('/test',function(){
            return '123';
        });

        $res = $route->match('/test','get');
        $callback = $res->getStorage();
        $this->assertEquals($callback(), '123');
    }
}