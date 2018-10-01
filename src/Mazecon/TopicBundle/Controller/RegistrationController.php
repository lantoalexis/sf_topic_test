<?php

namespace Mazecon\TopicBundle\Controller;

use FOS\UserBundle\Controller\RegistrationController as BaseRegistrationController;
use Mazecon\TopicBundle\Controller\Common;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
USE FOS\RestBundle\Controller\Annotations as Rest;


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
     * @Rest\View(statusCode=Response::HTTP_OK)
     * @Rest\Post("/registration/")
     */

    public function registerAction(Request $request)
    {
        $response = parent::registerAction($request);

        return $response;
    }
}