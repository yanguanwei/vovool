<?php

namespace Youngx\Bundle\UserBundle\Module\AdminUserModule\Controller;

use Youngx\Bundle\UserBundle\Form\LoginForm;
use Youngx\MVC\AppContext;

class LoginController
{
    public function indexAction()
    {
        $form = new LoginForm();
        $request = AppContext::request();
        if ($request->isMethod('POST')) {
            $form->bindRequest($request);
            if ($form->validate()) {
                return AppContext::redirectResponse(AppContext::generateUrl('admin'));
            } else {
                foreach ($form->getErrors() as $error) {
                    AppContext::flash()->add('error', $error);
                }
            }
        }

        return AppContext::render('login.html.php@Ace', array(
                'form' => $form
            ));
    }

    public function logoutAction()
    {
        AppContext::logout();
        return AppContext::redirectResponse(AppContext::generateUrl('admin-login'));
    }
}
