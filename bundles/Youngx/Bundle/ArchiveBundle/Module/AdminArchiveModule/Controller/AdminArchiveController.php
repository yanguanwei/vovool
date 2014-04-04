<?php

namespace Youngx\Bundle\ArchiveBundle\Module\AdminArchiveModule\Controller;

use Youngx\Bundle\ArchiveBundle\ArchiveContent;
use Youngx\Bundle\ArchiveBundle\Entity\Archive;
use Youngx\Bundle\ArchiveBundle\Entity\Channel;
use Youngx\Bundle\ArchiveBundle\Module\AdminArchiveModule\Form\AdminArchiveForm;
use Youngx\MVC\AppContext;
use Youngx\MVC\Form;

class AdminArchiveController
{
    public function indexAction(Channel $channel, $entityCode)
    {
        $archiveContent = $this->getArchiveContent($entityCode);
        $listView = $archiveContent->adminListView($channel);

        return AppContext::render('archive/list.html.php', array(
                'listView' => $listView,
                'channel' => $channel,
                'entityCode' => $entityCode,
                'subtitle' => array($channel->getLabel(), $archiveContent->label())
            ));
    }

    public function addAction(Channel $channel, $entityCode)
    {
        $archiveContent = $this->getArchiveContent($entityCode);
        $form = $archiveContent->adminForm($channel, AppContext::repository()->create('archive'));
        if (!$form || !$form instanceof Form) {
            throw new \RuntimeException(sprintf('ArchiveContent[%s]::adminForm() should return Youngx\MVC\Form.', $entityCode));
        }

        if ($form instanceof AdminArchiveForm) {
            $form->setEntityCode($entityCode);
        }

        $request = AppContext::request();
        if ($request->isMethod('POST')) {
            $form->bindRequest($request);
            if ($form->validate()) {
                $form->submit();
                AppContext::flash()->add('success', sprintf("成功保存%s<i>%s</i>", $archiveContent->label(), $form->getValue('title')));
                return AppContext::redirectResponse(AppContext::generateUrl('admin-archive-content', array(
                            'channel' => $channel->getName(),
                            'entityCode' => $entityCode
                        )));
            }
        }

        return AppContext::render('archive/form.html.php', array(
                'form' => $form->render(),
                'channel' => $channel
            ));
    }

    public function editAction(Channel $channel, Archive $archive, $entityCode)
    {
        $archiveContent = $this->getArchiveContent($entityCode);
        $form = $archiveContent->adminForm($channel, $archive);
        if (!$form || !$form instanceof Form) {
            throw new \RuntimeException(sprintf('ArchiveContent[%s]::adminForm() should return Youngx\MVC\Form.', $entityCode));
        }

        if ($form instanceof AdminArchiveForm) {
            $form->setEntityCode($entityCode);
        }

        $request = AppContext::request();
        if ($request->isMethod('POST')) {
            $form->bindRequest($request);
            if ($form->validate()) {
                $form->submit();
                AppContext::flash()->add('success', sprintf("成功保存%s<i>%s</i>", $archiveContent->label(), $form->getValue('title')));
                return AppContext::redirectResponse(AppContext::generateUrl('admin-archive-content', array(
                            'channel' => $channel->getName(),
                            'entityCode' => $entityCode
                        )));
            }
        }

        return AppContext::render('archive/form.html.php', array(
                'form' => $form->render(),
                'channel' => $channel
            ));
    }

    /**
     * @param $entityCode
     * @throws \RuntimeException
     * @return ArchiveContent
     */
    protected function getArchiveContent($entityCode)
    {
        if (empty($entityCode)) {
            throw new \RuntimeException('未指定内容类型');
        }
        return AppContext::service('archiveContentCollection')->getInstance($entityCode);
    }

    public function deleteAction(Channel $channel, $entityCode)
    {
        $entities = AppContext::repository()->loadMultiple('archive', AppContext::request()->get('id'));
        $deletedEntities = array();
        foreach ($entities as $entity) {
            if ($entity instanceof Archive) {
                $entity->delete();
                $deletedEntities[] = '<i>'.$entity.'</i>';
            }
        }

        AppContext::flash()->add('success', sprintf('成功删除以下内容：'.implode('，', $deletedEntities)));

        return AppContext::redirectResponse(AppContext::generateUrl('admin-archive-content', array(
                    'channel' =>$channel->getName(),
                    'entityCode' => $entityCode
        )));
    }
}