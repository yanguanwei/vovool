<?php

namespace Youngx\Bundle\KernelBundle\Listener;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Youngx\MVC\AppContext;
use Youngx\MVC\Event\GetResponseEvent;
use Youngx\MVC\ListenerRegistry;
use Youngx\MVC\Renderable;

class ControllerListener implements ListenerRegistry
{
    public function controller(GetResponseEvent $event, Request $request)
    {
        $controller = $request->attributes->get('_controller');
        if ($controller) {
            $callback = $this->resolveController($controller, $request);
            $arguments = AppContext::arguments($callback, $request->attributes->all());
            $response = call_user_func_array($callback, $arguments);

            AppContext::dispatchWithMenu('kernel.layout', array(
                    $response
                ));

            if ($response instanceof Response) {
                $event->setResponse($response);
            } else {
                $event->setResponse(new Response($response));
            }
        }
    }

    protected function resolveController($controller, Request $request)
    {
        if (is_array($controller) || (is_object($controller) && method_exists($controller, '__invoke'))) {
            return $controller;
        }

        if (false === strpos($controller, '.') && false === strpos($controller, '@')) {
            if (is_object($controller) && method_exists($controller, '__invoke')) {
                return new $controller;
            } elseif (is_string($controller) && function_exists($controller)) {
                return $controller;
            }
        }

        $callable = $this->createController($controller, $request);

        if (!is_callable($callable)) {
            throw new \InvalidArgumentException(sprintf('The controller for URI "%s" is not callable.', $request->getPathInfo()));
        }

        return $callable;
    }

    /**
     *
     * @param string $controller ::method  |
     *                           Controller |
     *                           PathTo.Controller::method
     * @param Request $request
     * @throws \InvalidArgumentException
     * @return callback
     */
    protected function createController($controller, Request $request)
    {
        list($controller, $action, $module) = AppContext::app()->resolveControllerAlias($controller);
        $method = "{$action}Action";
        $module = $module ?: $request->attributes->get('_module');
        $controllerClass = AppContext::classOf($module, $controller, 'Controller', true);
        $controller = AppContext::instantiate($controllerClass, $request->attributes->all());
        return array($controller, $method);
    }

    public static function registerListeners()
    {
        return array(
            'kernel.controller' => 'controller'
        );
    }
}