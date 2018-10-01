<?php

namespace Mazecon\TopicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $topics = $em->getRepository('MazeconTopicBundle:Topic')->findAll();

        return $this->render('topic/index.html.twig', array(
            'topics' => $topics,
            'header_title_panel' => "Liste des Topics",
            'page_header_title' => "Topic",

        ), new Response(null,Response::HTTP_NOT_FOUND));
    }

    public function showAction(Topic $topic) {
        $deleteForm = $this->createDeleteForm($topic);

        return $this->render('topic/show.html.twig', array(
            'topic' => $topic,
            'delete_form' => $deleteForm->createView(),
            'header_title_panel' => "Détail Topic",
            'page_header_title' => "Topic",
        ));
    }
}
