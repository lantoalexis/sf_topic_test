<?php
 namespace Mazecon\TopicBundle\Controller;

 use Mazecon\TopicBundle\Controller\Common;
 use Symfony\Bundle\FrameworkBundle\Controller\Controller;
 use Symfony\Component\HttpFoundation\Request;
 use Symfony\Component\Routing\Annotation\Route;

 /**
  * Class SearchController
  * @package Mazecon\TopicBundle\Controller
  * @Route("search")
  */
 class SearchController extends Common
 {
     const SEARCH_NOT_FOUND_MSG  = "Aucun résultat trouvé.";
     public static $userResult = array();
     public static $topicResult = array();
     /**
      * @param Request $request
      * @Route("/", name="search_page")
      */
     public function searchAction(Request $request){
         if($request->getMethod() == 'GET') {
             $content = $request->get('search');
             $requestTrimed = trim(strtolower($content));
             if (strstr($requestTrimed, " ")) {

                 $req_tab = explode(" ", $requestTrimed);
                 $em = $this->getDoctrine()->getManager();
                 $users = $em->getRepository('MazeconTopicBundle:User')->findAll();
                 $topics = $em->getRepository('MazeconTopicBundle:Topic')->findAll();


                 foreach ($req_tab as $requestTrimed) {
                     foreach ($users as $user) {
                         $this->firstnameUserSearch($requestTrimed, $user);
                         $this->lastnameUserSearch($requestTrimed, $user);
                     }

                     foreach ($topics as $topic){
                         $this->titleTopicSearch($requestTrimed, $topic);
                     }
                 }


                 if (count(SearchController::$userResult) > 0 || count(SearchController::$topicResult) > 0) {

                     return $this->render('Search/searchResult.html.twig',
                         array(
                             'users' => SearchController::$userResult,
                             'topics' => SearchController::$topicResult,
                             'request' => $content ));
                 } else {
                     return $this->render('Search/searchNotFound.html.twig',
                         array(
                             'request' => $content,
                             'message' => SearchController::SEARCH_NOT_FOUND_MSG,
                         ));
                 }
             }
             else if(preg_match('#^[a-zA-Z]{4,}#', $requestTrimed)){
                 $em = $this->getDoctrine()->getManager();
                 $users = $em->getRepository('MazeconTopicBundle:user')->findAll();
                 $topics = $em->getRepository('MazeconTopicBundle:topic')->findAll();

                 foreach ($users as $u) {
                     $this->firstnameUserSearch($requestTrimed, $u);
                     $this->lastnameUserSearch($requestTrimed, $u);
                 }

                 foreach ($topics as $topic){
                     $this->titleTopicSearch($requestTrimed, $topic);
                 }

                 if (count(SearchController::$userResult) > 0 || count(SearchController::$topicResult) > 0) {
                     return $this->render('Search/searchResult.html.twig',
                         array(
                             'users' => SearchController::$userResult,
                             'topics' => SearchController::$topicResult,
                             'request' => $content ));
                 } else {
                     return $this->render('Search/searchNotFound.html.twig',
                         array(
                             'request' => $content,
                             'message' => SearchController::SEARCH_NOT_FOUND_MSG,
                         ));
                 }
             }

             else{
                 return $this->render('Search/searchNotFound.html.twig',
                     array(
                         'request' => $content,
                         'message' => SearchController::SEARCH_NOT_FOUND_MSG,
                     ));
             }
         }
         else{
             throw $this->createAccessDeniedException("Your acces in this section is Denied!");
         }
     }

     public function firstnameUserSearch($request, $user){
         if(stristr($user->getFirstname(), $request)){
             foreach (SearchController::$userResult as $u) {
                 if($u->getId() == $user->getId())
                     return null;
             }
             array_push(SearchController::$userResult,$user);

             return 0;
         }
         return null;
     }

     public function lastnameUserSearch($request, $user){
         if(stristr($user->getLastname(), $request)){
             foreach (SearchController::$userResult as $u) {
                 if($u->getId() == $user->getId())
                     return null;
             }
             array_push(SearchController::$userResult,$user);

             return 0;
         }
         return null;
     }

     public function titleTopicSearch($request, $topic){
         if(stristr($topic->getTitle(), $request)){
             foreach (SearchController::$topicResult as $t) {
                 if($t->getId() == $topic->getId())
                     return null;
             }
             array_push(SearchController::$topicResult,$topic);

             return 0;
         }
         return null;
     }

 }