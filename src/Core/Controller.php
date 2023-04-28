<?php

namespace App\Core;

class Controller {

    public function render(string $template, array $params = [])
    {
        extract($params);
        include '../templates/' . $template . '.phtml';
    }
    
    
}
