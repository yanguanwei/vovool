<?php

namespace Youngx\Bundle\FeedbackBundle\Module\AdminFeedbackModule\Controller;

use Youngx\Bundle\FeedbackBundle\Entity\Feedback;
use Youngx\MVC\AppContext;
use Youngx\MVC\JSONResponse;
use Youngx\MVC\PagingQuery;

class AdminFeedbackController
{
    public function indexAction()
    {
        $request = AppContext::request();
        $status = $request->query->get('status', 'all');
        $keyword = $request->query->get('keyword', '');

        $query = Feedback::query();
        $params = array();

        if ($status === 'all') {
        } else if ($status === 'star') {
            $query->where('is_star=:is_star');
            $params[':is_star'] = 1;
        } else {
            $status = intval($status);
            $query->where('status=:status');
            $params[':status'] = $status;
        }

        $pagingQuery = new PagingQuery($query, $params);
        $pagingQuery->query();

        return AppContext::render('feedback/list.html.php', array(
                'keyword' => $keyword,
                'status' => $status,
                'status_all' => 'all',
                'status_star' => 'star',
                'status_unread' => Feedback::STATUS_UNREAD,
                'status_read' => Feedback::STATUS_READ,
                'status_processed' => Feedback::STATUS_PROCESSED,
                'feedbacks' => $pagingQuery,
                'unread_count' => Feedback::unreadCount()
            ));
    }

    public function readAction(Feedback $feedback)
    {
         $format = AppContext::request()->attributes->get('_format');

        if ($feedback->isUnread()) {
            $feedback->setStatus(Feedback::STATUS_READ);
            $feedback->save();
        }

        if ($format === 'json') {
            $params = array('id' => $feedback->getId());
            $array = $feedback->toArray();
            $array['intention'] = $feedback->getIntention()->getLabel();
            $array['starUrl'] = AppContext::generateUrl('admin-feedback-star', $params);
            $array['is_star'] = $feedback->isStar();
            $array['processUrl'] = AppContext::generateUrl('admin-feedback-process', $params);
            $array['deleteUrl'] = AppContext::generateUrl('admin-feedback-delete', $params);
            $array['is_processed'] = $feedback->isProcessed();

            return new JSONResponse($array);
        }
    }

    public function deleteAction()
    {
        $repository = AppContext::repository();
        $request = AppContext::request();
        foreach ($repository->loadMultiple('feedback', AppContext::request()->get('id')) as $entity) {
            $repository->delete($entity);
        }

        if (!$request->isXmlHttpRequest()) {
            return AppContext::backResponse();
        }
    }

    public function flagAction()
    {
        $repository = AppContext::repository();
        $request = AppContext::request();
        $status = $request->query->get('status');

        foreach ($repository->loadMultiple('feedback', $request->get('id')) as $entity) {
            if ($entity instanceof Feedback) {
                if (null === $status) {
                    $entity->setStatus($entity->isUnread() ? Feedback::STATUS_READ : Feedback::STATUS_UNREAD);
                } else {
                    $entity->setStatus($status);
                }
                $entity->save();
            }
        }

        if (!$request->isXmlHttpRequest()) {
            return AppContext::backResponse();
        }
    }

    public function processAction()
    {
        $repository = AppContext::repository();
        $request = AppContext::request();
        $status = $request->query->get('status');

        foreach ($repository->loadMultiple('feedback', $request->get('id')) as $entity) {
            if ($entity instanceof Feedback) {
                if (null === $status) {
                    $entity->setStatus($entity->isProcessed() ? Feedback::STATUS_READ : Feedback::STATUS_PROCESSED);
                } else {
                    $entity->setStatus($status);
                }
                $entity->save();
            }
        }

        if (!$request->isXmlHttpRequest()) {
            return AppContext::backResponse();
        }
    }

    public function starAction()
    {
        $repository = AppContext::repository();
        $request = AppContext::request();
        $star = $request->query->get('star');

        foreach ($repository->loadMultiple('feedback', $request->get('id')) as $entity) {
            if ($entity instanceof Feedback) {
                if (null === $star) {
                    $entity->setIsStar($entity->isStar() ? 0 : 1);
                } else {
                    $entity->setIsStar($star);
                }
                $entity->save();
            }
        }

        if (!$request->isXmlHttpRequest()) {
            return AppContext::backResponse();
        }
    }
}