<?php

namespace Youngx\Bundle\UserBundle;

use Youngx\MVC\AppContext;
use Symfony\Component\HttpFoundation\Cookie;
use Youngx\MVC\Event\FilterResponseEvent;
use Youngx\MVC\UserIdentityStorage;
use Youngx\MVC\UserIdentity;

class CookieIdentityStorage implements UserIdentityStorage
{
    protected $duration;
    /**
     * @var UserIdentity
     */
    protected $identity;

    protected $key = 'YoungxUserToken';

    public function clear()
    {
        AppContext::session()->remove('Youngx.User.Identity');
        AppContext::registerListener('kernel.response', array($this, 'onResponseForClear'));
    }

    public function onResponseForClear(FilterResponseEvent $event)
    {
        $header = $event->getResponse()->headers;
        $header->clearCookie($this->key);
    }

    public function read()
    {
        if (null === $this->identity) {
            $identity = null;
            $cookie = AppContext::request()->cookies;
            if ($cookie->has($this->key)) {
                $token = explode('.', base64_decode($cookie->get($this->key)));
                if (count($token) == 2) {
                    list($id, $encoded) = $token;
                    $identity = AppContext::repository()->load('user', $id);
                    if ($identity && $identity instanceof UserIdentity) {
                        if ($encoded === $this->generateEncodedToken($identity)) {
                            $this->identity = $identity;
                        }
                    }
                }

                if (!$this->identity) {
                    AppContext::registerListener('kernel.response', array($this, 'onResponseForClear'));
                }
            }
        }

        if (!$this->identity) {
            $this->identity = false;
        }

        return $this->identity;
    }

    public function write(UserIdentity $identity, $duration)
    {
        $this->identity = $identity;
        $this->duration = $duration;
        //$this->context->session()->set('Youngx.User.Identity', $identity);
        AppContext::registerListener('kernel.response', array($this, 'onResponseForWrite'));
    }

    public function onResponseForWrite(FilterResponseEvent $event)
    {
        $header = $event->getResponse()->headers;

        if ($this->identity) {
            $token = $this->generateLoggedToken($this->identity);
            if ($this->duration) {
                $expire = Y_TIME + $this->duration;
                $header->setCookie(new Cookie($this->key, $token, $expire));
            } else {
                $header->setCookie(new Cookie($this->key, $token));
            }
        }
    }

    protected function generateLoggedToken(UserIdentity $identity)
    {
        return base64_encode("{$identity->getId()}.{$this->generateEncodedToken($identity)}");
    }

    protected function generateEncodedToken(UserIdentity $identity)
    {
        $token = $identity->getId() . $identity->getUsername() . $identity->getPassword() . $identity->getSalt() . AppContext::request()->server->get('HTTP_USER_AGENT');
        return md5($token);
    }
}