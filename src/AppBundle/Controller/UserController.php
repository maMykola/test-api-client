<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
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
        $users = $this->RemoteServer()->allUsers();
        return ['users' => $users];
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
        $error_message = '';
        $form = $this->createFormBuilder()
            ->add('name', TextType::class)
            ->add('email', EmailType::class)
            ->add('group', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Create User'])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $create_result = $this->RemoteServer()->createUser($data);
        }

        if (!empty($create_result['status']) && $create_result['status'] == 'success') {
            return $this->redirectToRoute('app_user_show', ['id' => $create_result['user_id']]);
        }

        if (!empty($create_result['error'])) {
            $error_message = $create_result['error'];
        }

        return ['form' => $form->createView(), 'error_message' => $error_message];
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
