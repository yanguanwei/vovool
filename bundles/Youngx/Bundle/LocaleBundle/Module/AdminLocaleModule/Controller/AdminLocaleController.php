<?php

namespace Youngx\Bundle\LocaleBundle\Module\AdminLocaleModule\Controller;

use Youngx\Bundle\LocaleBundle\Entity\Locale;
use Youngx\Bundle\LocaleBundle\Module\AdminLocaleModule\Form\AdminLocaleForm;
use Youngx\Bundle\LocaleBundle\Module\AdminLocaleModule\Table\AdminLocaleTable;
use Youngx\MVC\AppContext;

class AdminLocaleController
{
    public function indexAction()
    {
        $table = new AdminLocaleTable();

        return AppContext::render('locale/list.html.php', array(
                'table' => $table
            ));
    }

    public function addAction()
    {
        $form = new AdminLocaleForm(AppContext::repository()->create('locale'));
        $request = AppContext::request();
        if ($request->isMethod('POST')) {
            $form->bindRequest($request);
            if ($form->validate()) {
                $form->submit();
                return AppContext::redirectResponse(AppContext::generateUrl('admin-locale'));
            } else {

            }
        }

        return AppContext::render('locale/form.html.php', array(
                'form' => $form,
            ));
    }

    public function editAction(Locale $locale)
    {
        $form = new AdminLocaleForm($locale);
        $request = AppContext::request();

        if ($request->isMethod('POST')) {
            $form->bindRequest($request);
            if ($form->validate()) {
                $form->submit();
                return AppContext::redirectResponse(AppContext::generateUrl('admin-locale', array('locale' => $locale->get('id'))));
            } else {

            }
        }

        return AppContext::render('locale/form.html.php', array(
                'form' => $form,
            ));
    }

    public function deleteAction()
    {
        $repository = AppContext::repository();
        $i = 0;
        foreach ($repository->loadMultiple('locale', AppContext::request()->get('id')) as $entity) {
            $i++;
            $repository->delete($entity);
        }

        AppContext::flash()->add('success', AppContext::translate('Successfully deleted %count% pieces of %entity%!', array(
                    '%count%' => $i,
                    '%entity%' => '地区'
                )));

        return AppContext::redirectResponse(AppContext::generateUrl('admin-locale'));
    }
}