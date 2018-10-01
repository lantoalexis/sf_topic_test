<?php

namespace Mazecon\TopicBundle\Controller;

use Mazecon\TopicBundle\Controller\Common;
use Mazecon\TopicBundle\Entity\Topic;
use Mazecon\TopicBundle\Entity\TopicUserView;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
/**
 * Topicuserview controller.
 *
 * @Route("topicuserview")
 *
 *
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

        $topics = $em->getRepository('MazeconTopicBundle:Topic')->findAll();

        return $this->render('topicuserview/index.html.twig', array(
            'topics' => $topics,
            'header_title_panel' => "Liste des Topics",
            'page_header_title' => "Topic",
        ));
    }

    /**
     * Creates a new topicUserView entity.
     *
     * @Route("/{id}/new", name="topicuserview_new")
     * @Method({"GET", "POST"})
     *
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function newAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $topic = $em->getRepository('MazeconTopicBundle:Topic')
            ->findOneById($id);
        $form = $this->createForm('Mazecon\TopicBundle\Form\TopicUserViewType', $topic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($topic);
            $em->flush();

            return $this->redirectToRoute('topicuserview_index');
        }

        return $this->render('topicuserview/new.html.twig', array(
            'topic' => $topic,
            'header_title_panel' => "Ajouter Topic",
            'page_header_title' => "Topic",
            'form' => $form->createView(),
        ));
    }


    /**
     * Finds and displays a topicUserView entity.
     *
     * @Route("/{id}/show", name="topicuserview_show")
     * @Method("GET")
     */
    public function showAction(TopicUserView $topicUserView)
    {
        $deleteForm = $this->createDeleteForm($topicUserView);

        return $this->render('topicuserview/show.html.twig', array(
            'topicUserView' => $topicUserView,
            'header_title_panel' => "Détail Topic",
            'page_header_title' => "Topic",
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing topicUserView entity.
     *
     * @Route("/{id}/edit", name="topicuserview_edit")
     * @Method({"GET", "POST"})
     *
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
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
            'page_header_title' => "Topic",
            'header_title_panel' => "Modifier vue Topic",
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a topicUserView entity.
     *
     * @Route("/{id}/delete", name="topicuserview_delete")
     * @Method("DELETE")
     *
     * @security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
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
