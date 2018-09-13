<?php

namespace Mazecon\TopicBundle\Controller;

use FOS\UserBundle\Controller\RegistrationController as BaseRegistrationController;
use Mazecon\TopicBundle\Controller\Common;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Topic controller.
 *
 * @Route("/")
 */
class RegistrationController extends Common
{
    /**
     * @param Request $request
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     * @Route("/")
     */

    public function registerAction(Request $request)
    {
        $response = parent::registerAction($request);

        return $response;
    }
}