<?php
namespace Mazecon\TopicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Common
 */
class Common extends Controller
{
    public function render($view, array $parameters = array(), Response $response = null) {


        $request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();

        if(stripos($request->getPathInfo(), 'api') !== false && $request->isXmlHttpRequest()) {

            $serializer = \JMS\Serializer\SerializerBuilder::create()->build();
            $dataSerialized = $serializer->serialize($parameters, 'json');

            return new Response($dataSerialized, 200, array('Content-Type', 'application/json'));
        }
        $this->get('twig')->addGlobal('PHOTO_PATH', $this->getParameter('web_photo'));

        return parent::render($view, $parameters, $response);
    }

}