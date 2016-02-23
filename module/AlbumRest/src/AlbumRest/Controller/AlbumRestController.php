<?php
namespace AlbumRest\Controller;
 
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
 
class AlbumRestController extends AbstractRestfulController
{
    
    public function __construct() {
        $this->setIdentifierName('album');
    }    
    public function getList()
    {
        $result = new JsonModel(array( 
            'album' => array(2,2,23,31,2)
        ));

    return $result;
    }
 
    public function get($i)
    {
        $result = new JsonModel(array( 
            'album' => array($i)
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