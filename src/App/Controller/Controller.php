<?php

namespace Controller;

use Twig\Environment;
use Handler\TwigHandler;
use Handler\SessionHandler;
use Handler\PermissionHandler;
use Twig\Loader\FilesystemLoader;

abstract class Controller
{
    protected TwigHandler $twigHandler;
    protected SessionHandler $sessionHandler;
    protected PermissionHandler $permissionHandler;

    public function __construct(array $parameters, array $arguments)
    {
        $this->twigHandler = TwigHandler::getTwigHandler();
        $this->sessionHandler = SessionHandler::getSessionHandler();
        $this->permissionHandler = PermissionHandler::getPermissionHandler();

        if (!$this instanceof LoginController){
            $this->sessionHandler->handleSession();
        }
        call_user_func_array(array($this, $parameters['_route']), $arguments);
    }
}
