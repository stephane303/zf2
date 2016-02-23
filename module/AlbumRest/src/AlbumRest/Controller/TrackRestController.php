<?php
namespace AlbumRest\Controller;
 
use Zend\Mvc\Controller\AbstractRestfulController;
 
use Zend\View\Model\JsonModel;
 
class TrackRestController extends AbstractRestfulController
{
    
    public function __construct() {
        $this->setIdentifierName('track');
    }
    
    public function getList()
    {
        $result = new JsonModel(array( 
            'track' => array(2,2,23,31,$this->params()->fromPost('album'))
        ));

    return $result;
    }
 
    public function get($id1)
    {
        $result = new JsonModel(array( 
            'track' => array($id1),
            'album' => $this->params()->fromRoute('album')
        ));
        return $result;
    }
 
    public function create($data)
    {
        # code...
    }
 
    public function update($id, $data)
    {
        # code...
    }
 
    public function delete($id)
    {
        # code...
    }
}

