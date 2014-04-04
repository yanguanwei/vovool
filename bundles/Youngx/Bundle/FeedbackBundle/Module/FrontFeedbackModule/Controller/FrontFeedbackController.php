<?php

namespace Youngx\Bundle\FeedbackBundle\Module\FrontFeedbackModule\Controller;

use Youngx\Bundle\FeedbackBundle\Form\FeedbackForm;
use Youngx\Bundle\PageBundle\Entity\Page;
use Youngx\Bundle\VocabularyBundle\Entity\Vocabulary;
use Youngx\MVC\AppContext;

class FrontFeedbackController
{
    public function addAction(Page $page)
    {
        $form = new FeedbackForm(AppContext::repository()->create('feedback'));
        $request = AppContext::request();

        $variables = $page->getPageVariables();
        $variables['submitted'] = false;

        if ($request->isMethod('POST')) {
            $form->bindRequest($request);
            if ($form->validate()) {
                $form->submit();
                $variables['submitted'] = true;
            }
        }

        $variables['form'] = $form;
        $variables['intentions'] = Vocabulary::load('feedback-intention')->getTerms();

        return AppContext::render($page->getTemplate(), $variables);
    }
}