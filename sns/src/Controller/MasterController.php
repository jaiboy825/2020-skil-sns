<?php

namespace Gondr\Controller;

use Gondr\App\View;

class MasterController
{
    public function render($page, $datas = [])
    {
        $view = new View($page, $datas);
    }
}