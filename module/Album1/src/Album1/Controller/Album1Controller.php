<?php
 namespace Album1\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Album1\Model\Album1;          
 use Album1\Form\Album1Form;   

 class Album1Controller extends AbstractActionController
 {
     
     protected  $albumTable;
     public function indexAction()
     {
         return new ViewModel(array(
             'albums' => $this->getAlbumTable()->fetchAll(),
         ));
     }


     // Add content to this method:
     public function addAction()
     {
         $form = new Album1Form();
         $form->get('submit')->setValue('Add');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $album = new Album1();
             $form->setInputFilter($album->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $album->exchangeArray($form->getData());
                 $this->getAlbumTable()->saveAlbum($album);

                 // Redirect to list of albums
                 return $this->redirect()->toRoute('album1');
             }
         }
         return array('form' => $form);
     }

    public function editAction()
     {
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('album', array(
                 'action' => 'add'
             ));
         }

         // Get the Album with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
             $album = $this->getAlbumTable()->getAlbum($id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('album', array(
                 'action' => 'index'
             ));
         }

         $form  = new Album1Form();
         $form->bind($album);
         $form->get('submit')->setAttribute('value', 'Edit');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $form->setInputFilter($album->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $this->getAlbumTable()->saveAlbum($album);

                 // Redirect to list of albums
                 return $this->redirect()->toRoute('album1');
             }
         }

         return array(
             'id' => $id,
             'form' => $form,
         );
     }

     public function deleteAction()
     {
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('album');
         }

         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Yes') {
                 $id = (int) $request->getPost('id');
                 $this->getAlbumTable()->deleteAlbum($id);
             }

             // Redirect to list of albums
             return $this->redirect()->toRoute('album1');
         }

         return array(
             'id'    => $id,
             'album' => $this->getAlbumTable()->getAlbum($id)
         );
     }
     
     public function getAlbumTable()
     {
         if (!$this->albumTable) {
             $sm = $this->getServiceLocator();
             $this->albumTable = $sm->get('Album1\Model\Album1Table');
         }
         return $this->albumTable;
     }     
 }