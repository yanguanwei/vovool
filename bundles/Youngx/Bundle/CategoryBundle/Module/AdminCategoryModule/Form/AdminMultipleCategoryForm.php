<?php

namespace Youngx\Bundle\CategoryBundle\Module\AdminCategoryModule\Form;

use Youngx\MVC\AppContext;

class AdminMultipleCategoryForm extends AdminCategoryForm
{
    public function submit()
    {
        $labels = explode("\n", $this->value('label'));
        $category = AppContext::repository()->create('category');
        $category->set($this->toArray());
        foreach ($labels as $i => $label) {
            $label = trim($label);
            if ($label) {
                $clone = clone $category;
                $clone->set('label', $label);
                $clone->save();
            } else {
                unset($labels[$i]);
            }
        }
        AppContext::flash()->add('success', sprintf('批量添加分类 <i>%s</i>成功！', implode('，', $labels)));
    }
}