<?php

// Filename: /module/Blog/src/Blog/Controller/ListController.php

namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Blog\Service\PostServiceInterface;

class ListController extends AbstractActionController {

    private $postService;

    public function __construct(PostServiceInterface $postService) {
        $this->postService = $postService;
    }
    
     public function indexAction()
     {
         return array(
             'posts' => $this->postService->findAllPosts()
         );
     }
     
     public function detailAction()
     {
        
         try {
             $post = $this->postService->findPost($this->params()->fromRoute('id'));
         } catch (\InvalidArgumentException $ex) {
             return $this->redirect()->toRoute('blog');
         }
         return array('post' => $post);
     }

}
