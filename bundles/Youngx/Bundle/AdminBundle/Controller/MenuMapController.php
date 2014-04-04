<?php

namespace Youngx\Bundle\AdminBundle\Controller;

use Youngx\MVC\AppContext;
use Youngx\MVC\Html\ULHtml;
use Youngx\MVC\Html;
use Youngx\MVC\Menu;

class MenuMapController
{
    public function indexAction()
    {
        $route = AppContext::request()->attributes->get('_route');
        $menu = AppContext::router()->getMenu($route);
        $this->parseNestedMenu($menu, $ul = new ULHtml());

        return AppContext::render('memuMap.html.php@Ace', array(
                'menuMap' => $ul
            ));
    }

    private function parseNestedMenu(Menu $current, ULHtml $ul)
    {
        foreach ($current->getSubMenus() as $name => $menu) {
            if ($menu->getOption('is_menu') || $menu->getOption('is_manumap')) {
                foreach ($menu->getNavigation() as $label => $url) {
                    $li = $ul->addItem($a = new Html('a', array('content' => $label, 'href' => $url)));
                    if ($menu->getChildren()) {
                        $subUL = new ULHtml();
                        $this->parseNestedMenu($menu, $subUL);
                        if ($subUL->itemCount() > 0) {
                            $li->append($subUL);
                        }
                    }
                }
            }
        }
    }
} 