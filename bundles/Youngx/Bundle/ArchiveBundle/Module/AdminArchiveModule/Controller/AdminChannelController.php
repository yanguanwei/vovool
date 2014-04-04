<?php

namespace Youngx\Bundle\ArchiveBundle\Module\AdminArchiveModule\Controller;

use Symfony\Component\HttpFoundation\Response;
use Youngx\Bundle\ArchiveBundle\ArchiveContentCollection;
use Youngx\Bundle\ArchiveBundle\Entity\Archive;
use Youngx\Bundle\ArchiveBundle\Entity\Channel;
use Youngx\Bundle\ArchiveBundle\Module\AdminArchiveModule\Form\AdminChannelForm;
use Youngx\Bundle\ArchiveBundle\Module\AdminArchiveModule\ListView\AdminChannelListView;
use Youngx\Bundle\ArchiveBundle\Module\AdminArchiveModule\ListView\AdminSubChannelListView;
use Youngx\MVC\AppContext;
use Youngx\MVC\Widget\TreeTableWidget;

class AdminChannelController
{
    public function indexAction()
    {
        $treeTable = new AdminChannelListView();
        $widget = new TreeTableWidget($treeTable, 'ace');

        if (AppContext::request()->isMethod('POST')) {
            return new Response($widget->toJson());
        } else {
            return AppContext::render('channel/list.html.php', array(
                    'widget' => $widget
                ));
        }
    }

    public function addAction(Channel $channel = null)
    {
        $form = new AdminChannelForm(AppContext::repository()->create('channel'));
        $request = AppContext::request();
        if ($request->isMethod('POST')) {
            $form->bindRequest($request);
            if ($form->validate()) {
                $form->submit();
                AppContext::flash()->add('success', sprintf("成功保存栏目<i>%s</i>", $form->getValue('name')));
                return AppContext::redirectResponse(AppContext::generateUrl('admin-channel'));
            }
        } else {
            if ($channel) {
                $form->bindValue('parent_id', $channel->getId());
            }
        }

        return AppContext::render('channel/form.html.php', array(
                'form' => $form
            ));
    }

    public function editAction(Channel $channel)
    {
        $form = new AdminChannelForm($channel);
        $request = AppContext::request();
        if ($request->isMethod('POST')) {
            $form->bindRequest($request);
            if ($form->validate()) {
                $form->submit();
                AppContext::flash()->add('success', sprintf("成功保存栏目<i>%s</i>", $form->getValue('name')));
                return AppContext::redirectResponse(AppContext::generateUrl('admin-channel'));
            }
        }

        return AppContext::render('channel/form.html.php', array(
                'form' => $form
            ));
    }

    public function deleteAction()
    {
        $repository = AppContext::repository();
        $entities = $repository->loadMultiple('channel', AppContext::request()->get('id'));
        foreach ($entities as $entity) {
            if ($entity instanceof Channel) {
                if ($entity->hasChildren()) {
                    AppContext::flash()->add('error', sprintf('栏目<i>%s</i>下有子栏目，请先删除子栏目！', $entity->getName()));
                    return AppContext::redirectResponse(AppContext::generateUrl('admin-channel'));
                }
            }
        }

        $deletedEntities = array();
        foreach ($entities as $entity) {
            $repository->delete($entity);
            $deletedEntities[] = '<i>'.$entity.'</i>';
        }

        AppContext::flash()->add('success', '成功删除栏目：'.implode('，', $deletedEntities));

        return AppContext::redirectResponse(AppContext::generateUrl('admin-channel'));
    }

    /**
     * @return ArchiveContentCollection
     */
    protected function getArchiveContentCollection()
    {
        return AppContext::service('archiveContentCollection');
    }

    public function viewAction(Channel $channel)
    {
        $collection = $this->getArchiveContentCollection();
        $archiveContents = array();
        foreach ($collection->all() as $code => $instance) {
            $archiveContents[$code] = array(
                'url' => AppContext::generateUrl('admin-archive-content', array('channel' => $channel->getName(), 'entityCode' => $code)),
                'label' => $instance->label(),
                'icon' => $instance->icon(),
                'count' => 0,
            );
        }

        $db = AppContext::db();
        $descendantIds = $channel->getDescendantIds();
        $descendantIds[] = $channel->getId();
        $select = $db->select(Archive::table(), array(
                'archive_count' => 'COUNT(id)',
                'entity_code'
            ))->where('channel_id IN (?)', $descendantIds)->groupBy('entity_code');

        foreach ($db->query($select)->fetchAll() as $row) {
            $archiveContents[$row['entity_code']]['count'] = intval($row['archive_count']);
        }

        $relativeArchiveContents = $channel->getArchiveContents();

        foreach ($archiveContents as $code => $info) {
            if ($info['count'] > 0) {
                //$archiveContents[$code]['listView'] = $collection->getInstance($code)->adminListView($channel);
            } else if (!in_array($code, $relativeArchiveContents)) {
                unset($archiveContents[$code]);
            }
        }

        return AppContext::render('channel/view.html.php', array(
                'subtitle' => array($channel->getLabel(), '栏目内容'),
                'archiveContents' => $archiveContents,
            ));
    }
}