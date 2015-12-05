<?php

// Filename: /module/Blog/src/Blog/Controller/ListController.php

namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Blog\Service\PostServiceInterface;

class ListController extends AbstractActionController {

    public function __construct(PostServiceInterface $postService) {
        $this->postService = $postService;
    }
    
     public function indexAction()
     {
         return array(
             'posts' => $this->postService->findAllPosts()
         );
     }

}
