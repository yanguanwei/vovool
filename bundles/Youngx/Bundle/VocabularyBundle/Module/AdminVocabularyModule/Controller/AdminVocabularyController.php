<?php

namespace Youngx\Bundle\VocabularyBundle\Module\AdminVocabularyModule\Controller;

use Youngx\Bundle\VocabularyBundle\Entity\Vocabulary;
use Youngx\Bundle\VocabularyBundle\Module\AdminVocabularyModule\Form\AdminVocabularyForm;
use Youngx\Bundle\VocabularyBundle\Module\AdminVocabularyModule\ListView\AdminVocabularyListView;
use Youngx\MVC\AppContext;

class AdminVocabularyController
{
    public function indexAction()
    {
        $listView = new AdminVocabularyListView();
        return AppContext::render('vocabulary/list.html.php', array(
                'listView' => $listView
            ));
    }

    public function addAction()
    {
        $form = new AdminVocabularyForm(AppContext::repository()->create('vocabulary'));
        $request = AppContext::request();
        if ($request->isMethod('POST')) {
            $form->bindRequest($request);
            if ($form->validate()) {
                $form->submit();
                AppContext::flash()->add('success', '词汇表<i>'.$form->getValue('label').'</i>保存成功！');
                return AppContext::redirectResponse(AppContext::generateUrl('admin-vocabulary'));
            }
        }

        return AppContext::render('vocabulary/form.html.php', array(
                'form' => $form
            ));
    }

    public function editAction(Vocabulary $vocabulary)
    {
        $form = new AdminVocabularyForm($vocabulary);
        $request = AppContext::request();
        if ($request->isMethod('POST')) {
            $form->bindRequest($request);
            if ($form->validate()) {
                $form->submit();
                AppContext::flash()->add('success', '词汇表<i>'.$form->getValue('label').'</i>保存成功！');
                return AppContext::redirectResponse(AppContext::generateUrl('admin-vocabulary'));
            }
        }

        return AppContext::render('vocabulary/form.html.php', array(
                'form' => $form
            ));
    }

    public function deleteAction()
    {
        $repository = AppContext::repository();
        $entities = $repository->loadMultiple('vocabulary', AppContext::request()->get('id'));
        $deletedEntities = array();
        foreach ($entities as $entity) {
            $entity->delete();
            $deletedEntities[] = '<i>'.$entity.'</i>';
        }

        AppContext::flash()->add('success', '成功删除词汇表：'.implode('，', $deletedEntities));
        return AppContext::redirectResponse(AppContext::generateUrl('admin-vocabulary'));
    }
}