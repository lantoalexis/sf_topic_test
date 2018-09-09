<?php

namespace Mazecon\TopicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MazeconTopicBundle:Default:index.html.twig');
    }
}
