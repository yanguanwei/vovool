<?php

namespace Youngx\Bundle\UserBundle\Module\AdminUserModule\Table;

use Youngx\Bundle\UserBundle\Entity\User;
use Youngx\MVC\AppContext;
use Youngx\MVC\ListView\OperationsCell;
use Youngx\MVC\PagingQuery;
use Youngx\MVC\Table;

class AdminUserTable extends Table
{
    public function __construct()
    {
        $query = AppContext::repository()->query('user');

        $pagingQuery = new PagingQuery($query);
        $pagingQuery->query();
        parent::__construct($pagingQuery);
    }

    public function setup()
    {
        $this->add('username', AppContext::translate('Username'));
        $this->addFieldColumn(new OperationsCell(array(
                'edit', 'delete'
            )));
    }

    public function formatOperationsColumnForEdit(User $user)
    {
        return array(
            'href' => AppContext::generateUrl('admin-user-edit', array('user' => $user->getId())),
            'content' => AppContext::translate('Edit')
        );
    }

    public function formatOperationsColumnForDelete(User $user)
    {
        return array(
            'href' => AppContext::generateUrl('admin-confirm-delete', array('menu' => 'admin-user-delete', 'id' => $user->getId(), 'entityType' => 'user')),
            'content' => AppContext::translate('Delete')
        );
    }
} 