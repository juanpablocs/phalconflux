<?php
// tunning by juanpablocs21@gmail.com
use Phalcon\DI;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Router\Group as RouterGroup;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Http\Response;
use Phalcon\Http\Request;
use Phalcon\Db\Adapter\Pdo\Mysql as Database;
use Phalcon\Mvc\Model\Manager as ModelsManager;
use Phalcon\Mvc\Application as BaseApplication;
use Phalcon\Mvc\Model\Metadata\Memory as MemoryMetaData;

class Application extends BaseApplication
{
    var $config;
    var $routes;

    public function __construct($config)
    {
        $this->config = $config;
    }
    public function setRoutes($routes)
    {
        $this->routes = $routes;
    }
    public function prepareRoutes()
    {
        $router = new Router(false);
        $router->removeExtraSlashes(true);
        
        foreach ($this->routes as $k=>$r) 
        {
            $router->add($k, $r);
        }

        $router->notFound(array(
            'namespace' => $this->routes['error404']['namespace'],
            "action"     => $this->routes['error404']['action']
        ));

        return $router;
    }
    protected function prepareNameSpaces()
    {
        $n = array();
        foreach($this->routes as $nn)
        {
            $n[$nn['namespace']] = $nn['namespace_dir'];
        }
        return $n;
    }
    /**
     * This methods registers autoloaders
     */
    protected function registerAutoloaders()
    {
        $loader = new Loader();
        $loader->registerNamespaces($this->prepareNameSpaces());
        $loader->register();
    }
    /**
     * This methods registers the services to be used by the application
     */
    protected function registerServices()
    {
        $di = new DI();
        $di->set('router', function(){
            return $this->prepareRoutes();
        });
        $di->set('view', function(){
            $view = new View();
            $view->setViewsDir($this->config->application->viewsDir);
            return $view;
        });
        $di->set('db', function(){
            return new Database($this->config->database->toArray());
        });
        $di->set('dispatcher', function(){
            $dispatcher = new Dispatcher();
            return $dispatcher;
        });
        $di->set('response', function(){
            return new Response();
        });
        $di->set('request', function(){
            return new Request();
        });
        $di->set('modelsMetadata', function(){
            return new MemoryMetaData();
        });
        $di->set('modelsManager', function(){
            return new ModelsManager();
        });
        $this->setDI($di);
    }

    public function main()
    {
        $this->registerServices();
        $this->registerAutoloaders();
        echo $this->handle()->getContent();
    }
}
