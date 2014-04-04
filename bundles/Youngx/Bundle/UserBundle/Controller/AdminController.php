<?php

namespace Youngx\Bundle\UserBundle\Controller;

use Youngx\Bundle\UserBundle\Form\AdminAccountForm;
use Youngx\MVC\AppContext;

class AdminController
{
    public function accountAction()
    {
        $form = new AdminAccountForm();

        return AppContext::render('account.html.php', array(
                'form' => $form
            ));
    }
}