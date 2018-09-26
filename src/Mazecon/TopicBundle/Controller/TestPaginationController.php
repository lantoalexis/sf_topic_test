<?php

namespace Mazecon\TopicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TestPaginationController
 * @Route("testpagination")
 */
class TestPaginationController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/test", name="test_pagination")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository('MazeconTopicBundle:Topic')->findAllOrderedASC();

        dump($query->getResult());

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($query, $request->query->getInt('page', 1), 5);

        // parameters to template
        return $this->render('Default/test_pagination.html.twig', array(
            'pagination' => $pagination,
            'header_title_panel' => "Pagination",
            'page_header_title' => "test Pagination",
        ));
    }
}
