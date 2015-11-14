<?php

namespace Application\Controller;

use Application\View\IndexView;

class IndexController extends AbstractController
{
    public function index()
    {
        $view = new IndexView();
        $view->addVar('session', $_SESSION);
        return $view->render();
    }
}
