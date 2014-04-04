<?php

namespace Youngx\Bundle\PageBundle\Module\FrontPageModule;

use Youngx\Bundle\PageBundle\Entity\Page;
use Youngx\MVC\AppContext;
use Youngx\MVC\ListenerRegistry;
use Youngx\MVC\MenuCollection;
use Youngx\MVC\Module;

class FrontPageModule extends Module implements ListenerRegistry
{
    public function onMenuCollect(MenuCollection $collection)
    {
        $frontCollection = $collection->getSubMenuCollection('Front');
        foreach (Page::findAll() as $page) {
            if ($page instanceof Page) {
                $menuClass = $page->getMenuClass();
                if ($menuClass) {
                    $menuClass = AppContext::classOfAlias($menuClass);
                } else {
                    $menuClass = 'Youngx\MVC\Menu';
                }

                $frontCollection->add($page->getName(), $page->getGroup()->getPrefix() . $page->getPath(), $page->getLabel(), $page->getController() ?: 'FrontPage::index@FrontPage')
                    ->setDefaults($page->getDefaultsToArray())
                    ->setDefault('page', $page->getId())->addReference('page', 'entity')
                    ->setModule('Front')
                    ->setMenuClass($menuClass)
                    ->setParent($page->getParent())
                    ->setAccessible(true);
            }
        }
    }

    public static function registerListeners()
    {
        return array(
            'kernel.menu.collect' => 'onMenuCollect'
        );
    }
}