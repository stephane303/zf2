<?php

namespace Album1\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Album1\Entity\Album1;
use Album1\Form\Album1Form;
use Doctrine\ORM\EntityManager;

class Album1Controller extends AbstractActionController {

    protected $albumTable;

    /**
     * @var EntityManager
     */
    protected $em;
    
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


    public function getEntityManager() {
        return $this->em;
    }

    public function indexAction()
    {
        return new ViewModel(array(
            'albums' => $this->getEntityManager()->getRepository('Album1\Entity\Album1')->findAll(),
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
                $this->getEntityManager()->persist($album);
                $this->getEntityManager()->flush();
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
            return $this->redirect()->toRoute('album1', array(
                'action' => 'add'
            ));
        }
        $album = $this->getEntityManager()->find('Album1\Entity\Album1', $id);
        if (!$album) {
            return $this->redirect()->toRoute('album1', array(
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
                $this->getEntityManager()->flush();
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
            return $this->redirect()->toRoute('album1');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $album = $this->getEntityManager()->find('Album1\Entity\Album1', $id);
                if ($album) {
                    $this->getEntityManager()->remove($album);
                    $this->getEntityManager()->flush();
                }
            }
            // Redirect to list of albums
            return $this->redirect()->toRoute('album1');
        }
        return array(
            'id'    => $id,
            'album' => $this->getEntityManager()->find('Album1\Entity\Album1', $id)
        );
    }

    public function getAlbumTable() {
        if (!$this->albumTable) {
            $sm = $this->getServiceLocator();
            $this->albumTable = $sm->get('Album1\Model\Album1Table');
        }
        return $this->albumTable;
    }

}
