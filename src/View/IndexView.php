<?php

namespace Application\View;

class IndexView extends AbstractView {

    public function __construct() {
        $this->layout = "index.html.twig";
    }

}