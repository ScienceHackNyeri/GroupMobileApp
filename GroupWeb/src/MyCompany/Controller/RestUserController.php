<?php
namespace MyCompany\Controller;

use ZendServerGateway\Controller\AbstractRestfulController;
use MyCompany\Model\UserRepository;

class RestUserController extends AbstractRestfulController
{
    /**
     *
     * @see \Zend\Mvc\Controller\AbstractRestfulController::create()
     */
    public function create ($data)
    {
        $data = (array) $data;
        $cr = new UserRepository();
        $name = $data['name'];
        $password = $data['password'];
        $id = $cr->add($name, $password);
        if ($id > - 1) {
            $this->getResponse()->setStatusCode(201);
            return $cr->get($id);
        } else {
            $this->getResponse()->setStatusCode(422);
            $this->getResponse()
                ->getHeaders()
                ->addHeaderLine('Content-type', 'application/error+json');
        }
    }

    public function authenticate($name, $password){
    	$ur = new UserRepository();
    	return $this->getResponse()->setStatusCode(200);


    }
	/* (non-PHPdoc)
	 * @see \Zend\Mvc\Controller\AbstractRestfulController::delete()
	 */
	public function delete($id) {
		// TODO Auto-generated method stub

	}

	/* (non-PHPdoc)
	 * @see \Zend\Mvc\Controller\AbstractRestfulController::get()
	 */
	public function get($id) {
		// TODO Auto-generated method stub

	}

	/* (non-PHPdoc)
	 * @see \Zend\Mvc\Controller\AbstractRestfulController::getList()
	 */
	public function getList() {
		// TODO Auto-generated method stub

	}

	/* (non-PHPdoc)
	 * @see \Zend\Mvc\Controller\AbstractRestfulController::update()
	 */
	public function update($id, $data) {
		// TODO Auto-generated method stub

	}

}
