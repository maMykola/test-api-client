<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/users/group")
 */
class UserGroupController extends Controller
{
    /**
     * @Route("/")
     * @Template("AppBundle/UserGroup/list.html.twig")
     */
    public function listAction()
    {
        $groups = $this->RemoteServer()->allGroups();
        return ['groups' => $groups];
    }

    /**
     * @Route("/{id}", requirements={"id"="\d+"})
     * @Template("AppBundle/UserGroup/show.html.twig")
     */
    public function showAction($id)
    {
        // !!! stub
        return [];
    }

    /**
     * @Route("/new")
     * @Template("AppBundle/UserGroup/new.html.twig")
     */
    public function newAction()
    {
        // !!! stub
        return [];
    }

    /**
     * @Route("/{id}/edit")
     * @Template("AppBundle/UserGroup/edit.html.twig")
     */
    public function editAction($id)
    {
        // !!! stub
        return [];
    }

    /**
     * @Route("/{id}/delete")
     * @Template("AppBundle/UserGroup/delete.html.twig")
     */
    public function deleteAction($id)
    {
        // !!! stub
        return [];
    }

    /**
     * Return object for remote server communication.
     *
     * @return RemoteServer
     * @author Mykola Martynov
     **/
    private function RemoteServer()
    {
        static $remote_server = null;

        if (empty($remote_server)) {
            $host = $this->container->getParameter('remote_server_host');
            $remote_server = \AppBundle\Utils\RemoteServer::getInstance($host);
        }

        return $remote_server;
    }
}
