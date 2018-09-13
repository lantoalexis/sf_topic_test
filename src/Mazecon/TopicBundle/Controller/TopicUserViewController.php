<?php

namespace Mazecon\TopicBundle\Controller;

use Mazecon\TopicBundle\Controller\Common;
use Mazecon\TopicBundle\Entity\TopicUserView;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Topicuserview controller.
 *
 * @Route("topicuserview")
 */
class TopicUserViewController extends Common
{
    /**
     * Lists all topicUserView entities.
     *
     * @Route("/", name="topicuserview_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $topicUserViews = $em->getRepository('MazeconTopicBundle:TopicUserView')->findAll();

        return $this->render('topicuserview/index.html.twig', array(
            'topicUserViews' => $topicUserViews,
        ));
    }

    /**
     * Creates a new topicUserView entity.
     *
     * @Route("/new", name="topicuserview_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $topicUserView = new Topicuserview();
        $form = $this->createForm('Mazecon\TopicBundle\Form\TopicUserViewType', $topicUserView);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($topicUserView);
            $em->flush();

            return $this->redirectToRoute('topicuserview_show', array('id' => $topicUserView->getId()));
        }

        return $this->render('topicuserview/new.html.twig', array(
            'topicUserView' => $topicUserView,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a topicUserView entity.
     *
     * @Route("/{id}", name="topicuserview_show")
     * @Method("GET")
     */
    public function showAction(TopicUserView $topicUserView)
    {
        $deleteForm = $this->createDeleteForm($topicUserView);

        return $this->render('topicuserview/show.html.twig', array(
            'topicUserView' => $topicUserView,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing topicUserView entity.
     *
     * @Route("/{id}/edit", name="topicuserview_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TopicUserView $topicUserView)
    {
        $deleteForm = $this->createDeleteForm($topicUserView);
        $editForm = $this->createForm('Mazecon\TopicBundle\Form\TopicUserViewType', $topicUserView);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('topicuserview_edit', array('id' => $topicUserView->getId()));
        }

        return $this->render('topicuserview/edit.html.twig', array(
            'topicUserView' => $topicUserView,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a topicUserView entity.
     *
     * @Route("/{id}", name="topicuserview_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TopicUserView $topicUserView)
    {
        $form = $this->createDeleteForm($topicUserView);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($topicUserView);
            $em->flush();
        }

        return $this->redirectToRoute('topicuserview_index');
    }

    /**
     * Creates a form to delete a topicUserView entity.
     *
     * @param TopicUserView $topicUserView The topicUserView entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TopicUserView $topicUserView)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('topicuserview_delete', array('id' => $topicUserView->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
