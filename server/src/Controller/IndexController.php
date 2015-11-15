<?php

namespace Application\Controller;

class IndexController extends AbstractController
{
    public function index()
    {
        $view = file_get_contents('src/Template/index.html');
        return $view;
    }
}
