<?php

namespace Youngx\Bundle\AdminBundle\Controller;

use Youngx\MVC\AppContext;
use Youngx\MVC\Form;

class ConfirmController
{
    public function indexAction($menu)
    {
        $request = AppContext::request();
        return AppContext::render('confirm.html.php@Ace', array(
                'cancelUrl' => $request->server->get('HTTP_REFERER'),
                'actionUrl' => $request->get('_targetUrl'),
                'tips' => $this->getTips(),
                'message' => $this->getMessage(),
                'data' => $this->getData(),
                'actionMethod' => $request->isMethod('POST') ? 'post' : 'get'
            ));
    }

    protected function getData()
    {
        $request = AppContext::request();
        $data = $request->isMethod('POST') ? $request->request->all() : $request->query->all();
        unset($data['_targetUrl']);
        return $data;
    }

    protected function getTips()
    {
        return AppContext::translate('Are you sure you want to perform this operation?');
    }

    protected function getMessage()
    {
        return '';
    }
} 