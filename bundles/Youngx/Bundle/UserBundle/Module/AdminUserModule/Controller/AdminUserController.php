<?php

namespace Youngx\Bundle\UserBundle\Module\AdminUserModule\Controller;

use Youngx\Bundle\UserBundle\Entity\User;
use Youngx\Bundle\UserBundle\Module\AdminUserModule\Form\AdminUserForm;
use Youngx\Bundle\UserBundle\Module\AdminUserModule\Form\AdminUserPasswordForm;
use Youngx\Bundle\UserBundle\Module\AdminUserModule\Table\AdminUserTable;
use Youngx\MVC\AppContext;

class AdminUserController
{
    public function indexAction()
    {
        $table = new AdminUserTable();

        return AppContext::render('list.html.php', array(
                'table'=> $table
            ));
    }

    public function addAction()
    {
        $user = AppContext::repository()->create('user', array(
                'created_at' => date('Y-m-d H:i:s'),
                'salt' => 'a2m4k3'
            ));

        $form = new AdminUserForm($user);
        $request = AppContext::request();
        if ($request->isMethod('POST')) {
            $form->bindRequest($request);
            if ($form->validate()) {
                $form->submit();
                AppContext::flash()->add('success', AppContext::translate("Successfully saved the user <i>%user%</i>'s account information", array(
                            '%user%' => $user->get('username')
                        )));

                return AppContext::redirectResponse(AppContext::generateUrl('admin-user'));
            }
        }

        return AppContext::render('account.html.php', array(
                'form' => $form
            ));
    }

    public function editAction(User $user)
    {
        $form = new AdminUserForm($user);
        $request = AppContext::request();
        if ($request->isMethod('POST')) {
            $form->bindRequest($request);
            if ($form->validate()) {
                $form->submit();
                AppContext::flash()->add('success', AppContext::translate("Successfully saved the user <i>%user%</i>'s account information", array(
                            '%user%' => $user->get('username')
                        )));

                return AppContext::redirectResponse(AppContext::generateUrl('admin-user'));
            }
        }

        return AppContext::render('account.html.php', array(
                'form' => $form
            ));
    }

    public function passwordAction()
    {
        $user = AppContext::user();
        if ($user instanceof User) {
            $form = new AdminUserPasswordForm($user);
            $request = AppContext::request();
            if ($request->isMethod('POST')) {
                $form->bindRequest($request);
                if ($form->validate()) {
                    $form->submit();
                    AppContext::flash()->add('success', '密码修改成功！');
                    return AppContext::redirectResponse(AppContext::generateUrl('admin-user'));
                }
            }

            return AppContext::render('password.html.php', array(
                    'form' => $form
                ));
        }
    }

    public function deleteAction()
    {
        $repository = AppContext::repository();
        $entities = $repository->loadMultiple('user', AppContext::request()->get('id'));
        $deletedPages = array();
        foreach ($entities as $entity) {
            if ($entity instanceof User) {
                $entity->delete();
                $deletedPages[] = '<i>'.$entity->getUsername().'</i>';
            }
        }

        AppContext::flash()->add('success', '成功删除用户：'.implode('，', $deletedPages));
        return AppContext::redirectResponse(AppContext::generateUrl('admin-user'));
    }
} 