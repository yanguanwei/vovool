<?php

namespace Youngx\Bundle\DistrictBundle\Module\AdminDistrictModule\Controller;

use Symfony\Component\HttpFoundation\Response;
use Youngx\Bundle\DistrictBundle\Module\AdminDistrictModule\Form\DistrictImportForm;
use Youngx\MVC\AppContext;
use Youngx\MVC\PagingQuery;
use Youngx\MVC\TreeTable;
use Youngx\MVC\Widget\TreeTableWidget;

class AdminController
{
    public function indexAction()
    {
        $request = AppContext::request();
        $parentId = $request->request->get('parent_id', $request->query->get('parent_id', 0));
        $query = AppContext::repository()->query('district')
            ->where('parent_id=:parent_id');
        $pagingQuery = new PagingQuery($query, array(
            ':parent_id' => $parentId
        ));

        $treeTable = new TreeTable($pagingQuery);
        $treeTable->setJsonForPost('{parent_id: entity.id}');
        $treeTable->add('name', '地区名称', array(
                'style' => 'width: 40%'
            ));

        $widget = new TreeTableWidget($treeTable, 'ace');

        if (AppContext::request()->isMethod('POST')) {
            return new Response($widget->toJson());
        } else {
            return AppContext::render('list.html.php', array(
                    'widget' => $widget
                ));
        }
    }

    public function importAction()
    {
        $importForm = new DistrictImportForm();

        if (AppContext::request()->isMethod('POST')) {
            $importForm->bindRequest(AppContext::request());
            $importForm->submit();
        }

        return AppContext::render('import.html.php', array(
                'form' => $importForm
            ));
    }
}