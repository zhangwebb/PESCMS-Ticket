<?php

namespace App\Ticket\GET;

class Category extends Content {

    public function index($display = true){

    }

    public function action($display = false) {
        parent::action($display);

        $this->assign('select', \Model\Category::recursion(\Core\Func\CoreFunc::$param['category_id'],\Core\Func\CoreFunc::$param['category_parent'], true));

        $this->layout();
    }

}