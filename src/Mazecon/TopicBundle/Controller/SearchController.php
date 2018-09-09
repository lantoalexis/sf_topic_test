<?php
 namespace Mazecon\TopicBundle\Controller;

 use Symfony\Bundle\FrameworkBundle\Controller\Controller;
 use Symfony\Component\HttpFoundation\Request;
 use Symfony\Component\Routing\Annotation\Route;

 /**
  * Class SearchController
  * @package Mazecon\TopicBundle\Controller
  * @Route("search")
  */
 class SearchController extends Controller
 {
     /**
      * @param Request $request
      * @Route("/", name="search_page")
      */
     public function searchAction(Request $request){

     }

 }