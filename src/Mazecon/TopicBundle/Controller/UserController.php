<?php

namespace Mazecon\TopicBundle\Controller;

use Mazecon\TopicBundle\Controller\Common;
use Mazecon\TopicBundle\Entity\User;
use Mazecon\TopicBundle\Entity\UserFOS;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * User controller.
 *
 * @Route("user")
 */
class UserController extends Common
{
    /**
     * Lists all user entities.
     *
     * @Route("/", name="user_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('MazeconTopicBundle:User')->findAll();

        return $this->render('user/userList.html.twig', array(
            'users' => $users,
            'header_title_panel' => "Liste des utilisateurs"
        ));
    }

    /**
     * Creates a new user entity.
     *
     * @Route("/new", name="user_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm('Mazecon\TopicBundle\Form\UserType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->uploadPhoto($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user_index', array('id' => $user->getId()));
        }

        return $this->render('user/addUserForm.html.twig', array(
            'user' => $user,
            'header_title_panel' => "Ajouter nouveau utilisateur",
            'form' => $form->createView(),
        ));
    }

    public function uploadPhoto($context) {
        $photo = $context->getPhoto();

        $newFileName = sha1(uniqid()).'.'.$photo->guessExtension();
        $uploadPhotoDir = $this->container->getParameter('upload_photo');

        $photo->move($uploadPhotoDir, $newFileName);
        $context->setPhoto($newFileName);
    }




    /**
     * Deletes a user entity.
     *
     * @Route("/delete", name="user_delete")
     */
    public function deleteAction(Request $request)
    {


        if($request->getMethod() == 'POST' && $request->isXmlHttpRequest()) {

            $username = $request->get('username');

            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('MazeconTopicBundle:User')
                ->findOneByUsername($username);

            if($user){
                 $em->remove($user);
                 $em->flush();

                $response = new Response(json_encode(array('username'=>$username)));
                $response->headers->set('Content-Type', 'application/json');

                return $response;

            }

        }

        return $this->redirectToRoute('user_index');
    }

    /**
     * Creates a form to delete a user entity.
     *
     * @param User $user The user entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(User $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, User $user)
    {
        $deleteForm = $this->createDeleteForm($user);
        $editForm = $this->createForm('Mazecon\TopicBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $this->uploadPhoto($user);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index', array('id' => $user->getId()));
        }

        return $this->render('user/editUserForm.html.twig', array(
            'user' => $user,
            'header_title_panel' => "Modifier utilisateur",
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/{id}/show", name="user_show")
     * @Method("GET")
     */
    public function showAction(User $user)
    {
        $deleteForm = $this->createDeleteForm($user);

        return $this->render('user/show.html.twig', array(
            'user' => $user,
            'delete_form' => $deleteForm->createView(),
        ));
    }

}
