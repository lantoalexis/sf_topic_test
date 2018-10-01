<?php

namespace Mazecon\TopicBundle\Controller;

use Mazecon\TopicBundle\Entity\Topic;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class TopicRestController extends Controller
{
    /**
     * @Rest\Get("/api/index")
     * @Rest\View()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $topics = $em->getRepository('MazeconTopicBundle:Topic')->findAll();

        return $topics;
       /* return $this->render('topic/index.html.twig', array(
            'topics' => $topics,
            'header_title_panel' => "Liste des Topics",
            'page_header_title' => "Topic",

        ), new Response(null,Response::HTTP_NOT_FOUND));*/
    }

    /**
     * @param Topic $topic
     * @return Response
     * @Rest\Get("/api/show")
     * @Rest\View()
     */
    public function showAction(Topic $topic) {
        $deleteForm = $this->createDeleteForm($topic);

        return $this->render('topic/show.html.twig', array(
            'topic' => $topic,
            'delete_form' => $deleteForm->createView(),
            'header_title_panel' => "Détail Topic",
            'page_header_title' => "Topic",
        ));
    }

    /**
     * @param Request $request
     * @return array
     * @Rest\Post("api/newtopic")
     * @Rest\View(statusCode=Response::HTTP_CREATED )
     */
    public function newAction(Request $request) {

        $name = $request->get('name');
        $age = $request->get('age');
        return ['payload' => [
            'name' => $name,
            'age' => $age
        ]];
    }
}
