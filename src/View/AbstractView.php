<?php

namespace Application\View;

abstract class AbstractView
{
    protected $layout;
    protected $layoutAjax;
    protected $data = [];
    protected $obj;

    public function __construct($o = null)
    {
        $this->obj = $o;
    }

    public function addVar($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function render()
    {
        $loader = new \Twig_Loader_Filesystem('src/Template');
        $twig = new \Twig_Environment($loader, array());
        $twig->addGlobal('rootPath', str_replace("/index.php", "", $_SERVER['SCRIPT_NAME']));
        $template = $twig->loadTemplate($this->layout);
        return $template->render($this->data);
    }
}