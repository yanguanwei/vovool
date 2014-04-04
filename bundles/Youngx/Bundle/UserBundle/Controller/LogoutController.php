<?php

namespace Youngx\Bundle\UserBundle\Controller;

use Youngx\MVC\AppContext;

class LogoutController
{
    public function indexAction()
    {
        AppContext::logout();
        return AppContext::redirectResponse(AppContext::generateUrl('user-login'));
    }
}