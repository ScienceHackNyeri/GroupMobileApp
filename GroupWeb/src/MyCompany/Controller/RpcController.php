<?php
namespace MyCompany\Controller;

use ZendServerGateway\Controller\AbstractActionController;
use MyCompany\Model\UserRepository;
use MyCompany\Model\GroupRepository;

class RpcController extends AbstractActionController
{

    public function getHelloAction ($name, $surname)
    {
        return array(
            'message' => "Hello $name $surname!"
        );
    }

    public function getUsersAction ()
    {
        $cr = new UserRepository();
        return $cr->getAll();
    }

    public function getGroupsAction(){
    	$gr = new GroupRepository();
    	return $gr->getAll();
    }
}
