<?php
 // Filename: /module/Blog/src/Blog/Mapper/PostMapperInterface.php
 namespace Blog\Mapper;

 use Blog\Model\PostInterface;

 interface PostMapperInterface
 {
     /**
      * @param int|string $id
      * @return PostInterface
      * @throws \InvalidArgumentException
      */
     public function find($id);

     /**
      * @return array|PostInterface[]
      */
     public function findAll();
     
     public function savePost(PostInterface $post);
     
     /**
      * @param PostInterface $postObject
      *
      * @return bool
      * @throws \Exception
      */
     public function delete(PostInterface $postObject);     
 }

