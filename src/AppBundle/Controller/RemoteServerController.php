<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RemoteServerController extends Controller
{
    /**
     * Return object for remote server communication.
     *
     * @return RemoteServer
     * @author Mykola Martynov
     **/
    protected function RemoteServer()
    {
        static $remote_server = null;

        if (empty($remote_server)) {
            $host = $this->container->getParameter('remote_server_host');
            $remote_server = \AppBundle\Utils\RemoteServer::getInstance($host);
        }

        return $remote_server;
    }
}