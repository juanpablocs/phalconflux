<?php
namespace Single\Controller\Index;

class IndexController extends \Phalcon\Mvc\Controller
{
    var $module = "index";

	public function initialize()
    {
        $this->view->setVar("module", $this->module);
        $this->view->setVar("seo_title", "Welcome to PhalconFlux");
        $this->view->setVar("seo_description", "Description PhalconFlux");
    }

    public function indexAction()
    {
    }
    public function error404Action()
    {	
    	echo "error page not exists";
    }	
}

