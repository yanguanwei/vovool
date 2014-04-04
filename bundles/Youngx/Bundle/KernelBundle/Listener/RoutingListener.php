<?php

namespace Youngx\Bundle\KernelBundle\Listener;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Youngx\MVC\AppContext;
use Youngx\MVC\Bundle;
use Youngx\MVC\Event\GetResponseEvent;
use Youngx\MVC\Exception\HttpException;
use Youngx\MVC\Exception\MethodNotAllowedHttpException;
use Youngx\MVC\Exception\NotFoundHttpException;
use Youngx\MVC\ListenerRegistry;
use Youngx\MVC\Menu;
use Youngx\MVC\Module;

class RoutingListener implements ListenerRegistry
{
    public function routing(GetResponseEvent $event, Request $request)
    {
        $router = AppContext::router();
        try {
            $attributes = $router->match($request->getPathInfo() === '/' ? $request->getPathInfo() : rtrim($request->getPathInfo(), '/'));
            $routeName = $attributes['_route'];
            $routeParams = $attributes;
            unset($routeParams['_route']);
            $attributes['_route_params'] = $routeParams;

            $menu = $router->getMenu($routeName);

            $attributes['_collection'] = $menu->getCollection();
            $attributes['_module'] = $menu->getModule();
            $attributes['_controller'] = $menu->getController();
            $attributes['menu'] = $menu;

            $route = $router->getRoute($routeName);
            foreach ($menu->getReferences() as $key => $reference) {
                if (isset($attributes[$key])) {
                    $value = AppContext::valueOf(array("kernel.menu.reference#{$reference}"),  array($key, $attributes[$key]));
                    if (null !== $value || $route->hasDefault($key)) {
                        $attributes[$key] = $value;
                    } else {
                        throw new ResourceNotFoundException();
                    }
                }
            }

            $request->attributes->add($attributes);

            if (!$menu->isAccessible()) {
                $this->accessibleForDenied($event, $menu);
            }

        } catch (ResourceNotFoundException $e) {
            $message = sprintf('No route found for "%s %s"', $request->getMethod(), $request->getPathInfo());
            throw new NotFoundHttpException($message, $e);
        } catch (MethodNotAllowedException $e) {
            $message = sprintf('No route found for "%s %s": Method Not Allowed (Allow: %s)',
                $request->getMethod(), $request->getPathInfo(), strtoupper(implode(', ', $e->getAllowedMethods()))
            );
            throw new MethodNotAllowedHttpException($e->getAllowedMethods(), $message, $e);
        }
    }

    private function accessibleForDenied(GetResponseEvent $event, Menu $menu)
    {
        $events = array(
            "kernel.accessible.deny#{$menu->getName()}",
            "kernel.accessible.deny@collection:{$menu->getCollection()}",
            "kernel.accessible.deny"
        );
        AppContext::dispatchOne($events, array($event));
        $this->throwHttpException($event);
    }

    private function throwHttpException(GetResponseEvent $event)
    {
        if (!$event->hasResponse()) {
            if (AppContext::user()) {
                throw new HttpException(403, 'Access Denied.');
            } else {
                throw new HttpException(401, 'Not Authenticated.');
            }
        }
    }

    public function onMenuFilterForEntity($entityType, $id)
    {
        $schema = AppContext::schema();
        if ($schema->hasEntityType($entityType)) {
            $class = $schema->getEntityClass($entityType);
            return $class::load($id);
        }
    }

    public static function registerListeners()
    {
        return array(
            'kernel.routing' => 'routing',
            'kernel.menu.reference#entity' => 'onMenuFilterForEntity'
        );
    }
}