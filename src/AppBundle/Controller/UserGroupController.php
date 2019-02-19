<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

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
        $group = $this->RemoteServer()->findGroup($id);
        return ['group' => $group];
    }

    /**
     * @Route("/new")
     * @Template("AppBundle/UserGroup/new.html.twig")
     */
    public function newAction(Request $request)
    {
        $error_message = '';
        $form = $this->createFormBuilder()
            ->add('name', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Create Group'])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $create_result = $this->RemoteServer()->createGroup($data['name']);
        }

        if (!empty($create_result['status']) && $create_result['status'] == 'success') {
            return $this->redirectToRoute('app_usergroup_show', ['id' => $create_result['group_id']]);
        }

        if (!empty($create_result['error'])) {
            $error_message = $create_result['error'];
        }

        return ['form' => $form->createView(), 'error_message' => $error_message];
    }

    /**
     * @Route("/{id}/edit")
     * @Template("AppBundle/UserGroup/edit.html.twig")
     */
    public function editAction($id, Request $request)
    {
        $rs = $this->RemoteServer();

        $group = $rs->findGroup($id);
        if (empty($group)) {
            throw $this->createNotFoundException('Group not found');
        }

        $error_message = '';
        $form = $this->createFormBuilder()
            ->add('name', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Update'])
            ->getForm();
        $form->setData(['name' => empty($group['name']) ? '' : $group['name']]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $update_result = $this->RemoteServer()->updateGroup($id, $data);
        }

        if (!empty($update_result['status']) && $update_result['status'] == 'success') {
            return $this->redirectToRoute('app_usergroup_show', ['id' => $id]);
        }

        if (!empty($update_result['error'])) {
            $error_message = $update_result['error'];
        }

        return [
            'group' => $group,
            'form' => $form->createView(),
            'error_message' => $error_message,
        ];
    }

    /**
     * @Route("/{id}/delete")
     * @Template("AppBundle/UserGroup/delete.html.twig")
     */
    public function deleteAction($id, Request $request)
    {
        $rs = $this->RemoteServer();

        $group = $rs->findGroup($id);
        if (empty($group)) {
            throw $this->createNotFoundException('Group not found');
        }

        $error_message = '';
        $form = $this->createFormBuilder()
            ->add('delete', SubmitType::class, ['label' => 'Delete Group'])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $delete_result = $this->RemoteServer()->deleteGroup($id);
        }

        if (!empty($delete_result['status']) && $delete_result['status'] == 'success') {
            return $this->redirectToRoute('app_usergroup_list');
        }

        if (!empty($delete_result['error'])) {
            $error_message = $delete_result['error'];
        }

        return [
            'group' => $group,
            'form' => $form->createView(),
            'error_message' => $error_message,
        ];
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
