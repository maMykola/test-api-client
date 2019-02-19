<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/users")
 */
class UserController extends RemoteServerController
{
    /**
     * @Route("/")
     * @Template("AppBundle/User/list.html.twig")
     */
    public function listAction()
    {
        // !!! stub
        // !!! mockup
        return ['users' => []];
    }

    /**
     * @Route("/{id}", requirements={"id"="\d+"})
     * @Template("AppBundle/User/show.html.twig")
     **/
    public function showAction($user_id)
    {
        // !!! stub
        return [];
    }

    /**
     * @Route("/new")
     * @Template("AppBundle/User/new.html.twig")
     **/
    public function newAction(Request $request)
    {
        // !!! stub
        return [];
    }

    /**
     * @Route("/{id}/edit", requirements={"id"="\d+"})
     * @Template("AppBundle/User/edit.html.twig")
     **/
    public function editAction($user_id, Request $request)
    {
        // !!! stub
        return [];
    }

    /**
     * @Route("/{id}/delete", requirements={"id"="\d+"})
     * @Template("AppBundle/User/delete.html.twig")
     **/
    public function deleteAction($user_id, Request $request)
    {
        // !!! stub
        return [];
    }
}
