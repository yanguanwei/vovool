<?php

namespace Youngx\Bundle\CategoryBundle\Input;

use Youngx\Bundle\DistrictBundle\Entity\District;
use Youngx\Bundle\CategoryBundle\Entity\Category;
use Youngx\Bundle\jQueryBundle\Input\CXSelectInput;
use Youngx\MVC\AppContext;

class SelectCategoryInput extends CXSelectInput
{
    protected function init()
    {
        parent::init();

        $this->setUrl(AppContext::generateUrl('category-ajax-cxselect'));;
        $this->setSelectsTotal(4);
    }

    public function setValue($value)
    {
        $current = AppContext::repository()->load('category', $value);
        if ($current && $current instanceof Category) {
            $paths = $current->getPaths();
            $values = array();
            foreach ($paths as $i => $entity) {
                $values[$this->selects[$i]] = $paths[$i]->getId();
            }
            $this->setValues($values);
        }
    }
}