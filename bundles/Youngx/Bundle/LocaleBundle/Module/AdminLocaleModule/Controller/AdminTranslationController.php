<?php

namespace Youngx\Bundle\LocaleBundle\Module\AdminLocaleModule\Controller;

use Youngx\Bundle\LocaleBundle\Entity\Locale;
use Youngx\Bundle\LocaleBundle\Entity\Translation;
use Youngx\Bundle\LocaleBundle\Module\AdminLocaleModule\Form\AdminTranslateForm;
use Youngx\Bundle\LocaleBundle\Module\AdminLocaleModule\Table\AdminTranslationTable;
use Youngx\MVC\AppContext;

class AdminTranslationController
{
    public function indexAction(Locale $locale)
    {
        $table = new AdminTranslationTable($locale);

        return AppContext::render('translation/list.html.php', array(
                'table' => $table,
                'locale' => $locale,
                'subtitle' => array(
                    $locale->getLabel(),
                    AppContext::translate('Translations')
                )
            ));
    }

    public function translateAction(Translation $translation = null, Locale $locale = null)
    {
        $form = new AdminTranslateForm($translation ?: AppContext::repository()->create('translation'));
        $request = AppContext::request();

        if ($request->isMethod('POST')) {
            $form->bindRequest($request);
            if ($form->validate()) {
                $form->submit();
                return AppContext::redirectResponse(AppContext::generateUrl('admin-translation', array('locale' => $form->getEntity()->get('locale_id'))));
            }
        } else {
            $form->bindRequestQuery($request);
            if ($locale) {
                $form->bindValue('locale_id', $locale->getId());
            }
        }

        return AppContext::render('translation/form.html.php', array(
                'form' => $form
            ));
    }

    public function deleteAction(Locale $locale)
    {
        $repository = AppContext::repository();
        $i = 0;
        foreach ($repository->loadMultiple('translation', AppContext::request()->get('id')) as $entity) {
            $i++;
            $repository->delete($entity);
        }

        AppContext::flash()->add('success', AppContext::translate('Successfully deleted %count% pieces of %entity%!', array(
                    '%count%' => $i,
                    '%entity%' => '译文'
                )));

        return AppContext::redirectResponse(AppContext::generateUrl('admin-translation', array('locale' => $locale)));
    }
}