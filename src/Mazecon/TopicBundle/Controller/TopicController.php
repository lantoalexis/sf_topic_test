<?php

namespace Mazecon\TopicBundle\Controller;

use Mazecon\TopicBundle\Controller\Common;
use Mazecon\TopicBundle\Entity\Topic;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Topic controller.
 *
 * @Route("topic")
 *
 */
class TopicController extends Common
{
    /**
     * Lists all topic entities.
     *
     * @Route("/", name="topic_index")
     * @Method("GET")
     * @Rest\Get("/topics")
     * @Rest\View(statusCode=Response::HTTP_OK)
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $topics = $em->getRepository('MazeconTopicBundle:Topic')->findAll();

        return $this->render('topic/index.html.twig', array(
            'topics' => $topics,
            'header_title_panel' => "Liste des Topics",
            'page_header_title' => "Topic",

        ), new Response(null,Response::HTTP_NOT_FOUND));
    }

    /**
     * Creates a new topic entity.
     *
     * @Route("/new", name="topic_new")
     * @Method({"GET", "POST"})
     * @Rest\Post("/new")
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function newAction(Request $request)
    {
        $topic = new Topic();
        $form = $this->createForm('Mazecon\TopicBundle\Form\TopicType', $topic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $topic->addUser($topic->getUser());

            $em->persist($topic);
            $em->flush();

            return $this->redirectToRoute('topic_index', array('id' => $topic->getId()));
        }

        return $this->render('topic/new.html.twig', array(
            'topic' => $topic,
            'header_title_panel' => "Ajouter Topic",
            'page_header_title' => "Topic",
            'form' => $form->createView(),
        ));
    }



    /**
     * Displays a form to edit an existing topic entity.
     *
     * @Route("/{id}/edit", name="topic_edit")
     * @Method({"GET", "POST"})
     *
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function editAction(Request $request, Topic $topic)
    {
        $deleteForm = $this->createDeleteForm($topic);
        $editForm = $this->createForm('Mazecon\TopicBundle\Form\TopicType', $topic);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('topic_index', array('id' => $topic->getId()));
        }

        return $this->render('topic/edit.html.twig', array(
            'topic' => $topic,
            'header_title_panel' => "Editer Topic",
            'page_header_title' => "Topic",
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a topic entity.
     *
     * @Route("/delete", name="topic_delete")
     * @Method("DELETE")
     *
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function deleteAction(Request $request)
    {
        if($request->getMethod() == 'POST' && $request->isXmlHttpRequest()) {

            $id_topic = $request->get('id');

            $em = $this->getDoctrine()->getManager();
            $topic = $em->getRepository('MazeconTopicBundle:Topic')
                ->findOneById($id_topic);

            if($topic){
                $em->remove($topic);
                $em->flush();

                $response = new Response(json_encode(array('topic'=>$topic)));
                $response->headers->set('Content-Type', 'application/json');

                return $response;

            }

        }

        return $this->redirectToRoute('topic_index');
    }

    /**
     * Creates a form to delete a topic entity.
     *
     * @param Topic $topic The topic entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Topic $topic)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('topic_delete', array('id' => $topic->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Finds and displays a topic entity.
     *
     * @Route("/{id}/show", name="topic_show")
     * @Method("GET")
     */
    public function showAction(Topic $topic)
    {
        $deleteForm = $this->createDeleteForm($topic);

        return $this->render('topic/show.html.twig', array(
            'topic' => $topic,
            'delete_form' => $deleteForm->createView(),
            'header_title_panel' => "Détail Topic",
            'page_header_title' => "Topic",
        ));
    }

}
