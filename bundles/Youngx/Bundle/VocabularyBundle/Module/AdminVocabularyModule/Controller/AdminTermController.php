<?php

namespace Youngx\Bundle\VocabularyBundle\Module\AdminVocabularyModule\Controller;

use Youngx\Bundle\VocabularyBundle\Entity\Term;
use Youngx\Bundle\VocabularyBundle\Entity\Vocabulary;
use Youngx\Bundle\VocabularyBundle\Module\AdminVocabularyModule\Form\AdminTermForm;
use Youngx\Bundle\VocabularyBundle\Module\AdminVocabularyModule\ListView\AdminTermListView;
use Youngx\MVC\AppContext;

class AdminTermController
{
    public function indexAction(Vocabulary $vocabulary)
    {
        $listView = new AdminTermListView($vocabulary);

        return AppContext::render('term/list.html.php', array(
                'listView' => $listView,
                'subtitle' => array($vocabulary->getLabel(), '术语')
            ));
    }

    public function addAction(Vocabulary $vocabulary)
    {
        $form = new AdminTermForm($vocabulary, AppContext::repository()->create('term'));
        $request = AppContext::request();
        if ($request->isMethod('POST')) {
            $form->bindRequest($request);
            if ($form->validate()) {
                $form->submit();
                AppContext::flash()->add('success', '术语<i>'.$form->getValue('label').'</i>保存成功！');
                return AppContext::redirectResponse(AppContext::generateUrl('admin-term', array('vocabulary' => $vocabulary->getId())));
            }
        }

        return AppContext::render('term/form.html.php', array(
                'form' => $form,
                'subtitle' => array($vocabulary->getLabel(), '添加术语')
            ));
    }

    public function editAction(Vocabulary $vocabulary, Term $term)
    {
        $form = new AdminTermForm($vocabulary, $term);
        $request = AppContext::request();
        if ($request->isMethod('POST')) {
            $form->bindRequest($request);
            if ($form->validate()) {
                $form->submit();
                AppContext::flash()->add('success', '术语<i>'.$form->getValue('label').'</i>保存成功！');
                return AppContext::redirectResponse(AppContext::generateUrl('admin-term', array('vocabulary' => $vocabulary->getId())));
            }
        }

        return AppContext::render('term/form.html.php', array(
                'form' => $form,
                'subtitle' => array($vocabulary->getLabel(), '编辑术语')
            ));
    }

    public function deleteAction(Vocabulary $vocabulary)
    {
        $repository = AppContext::repository();
        $entities = $repository->loadMultiple('term', AppContext::request()->get('id'));
        $deletedEntities = array();
        foreach ($entities as $entity) {
            $entity->delete();
            $deletedEntities[] = '<i>'.$entity.'</i>';
        }

        AppContext::flash()->add('success', '成功删除词汇表<i>'.$vocabulary.'</i>下的术语：'.implode('，', $deletedEntities));
        return AppContext::redirectResponse(AppContext::generateUrl('admin-term', array('vocabulary' => $vocabulary->getId())));
    }
}