<?php
namespace MyCompany\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\TableGateway;

/**
 * Stores group users information /data/sqlite.db file.
 */
class UserRepository
{

    protected $userTable;

    public function __construct()
    {
        $this->userTable = new TableGateway(
            'users',
            new Adapter(array(
                'driver' => 'Pdo_Sqlite',
                'database' => APPLICATION_PATH . '/data/sqlite.db'
            )
        ));
    }

    public function add($name, $password)
    {
        $inserted = $this->userTable->insert(array(
            'name' => $name,
            'password' => $password,

        ));
        if($inserted)
            return $this->userTable->getLastInsertValue();
        return -1;
    }

    public function getAll()
    {
        return $this->userTable->select()->toArray();
    }

    public function get($id)
    {
        $resultSet = $this->userTable->select(array('id = ?' => $id));
        $row = $resultSet->current();
        return ($row) ? $row->getArrayCopy() : false;
    }

    public function createAdmin($id){

    	$createAdmin = 'UPDATE users '. $this->userTable($id) . 'SET admin = 1';
    }

    public function validate($data){
    	foreach ($data as $value){
    		$name = $value[0];
    		$password = $value[1];
    	}
    	if($this->userTable->insert(array(
    			'name' => $name,
    			'password' => $password ))){
            return -1;
    	}
    	return 1;
    }

    public function delete($id)
    {
        return $this->userTable->delete(array('id = ?' => $id));
    }

    private function createDb()
    {
        $sqlDrop = 'DROP TABLE IF EXISTS customers;';

        $sqlCreate = 'CREATE TABLE users (' . 'id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, ' . 'name TEXT NOT NULL, ' . 'password TEXT NOT NULL, '.'admin INTEGER NULL);';

        $this->dbAdapter->query($sqlDrop, Adapter::QUERY_MODE_EXECUTE);
        $this->dbAdapter->query($sqlCreate, Adapter::QUERY_MODE_EXECUTE);

        $users = array(
            array(
                'Jane',
                'password',
            ),
            array(
                'Marc',
                'password',
            ),
            array(
                'Frank',
                'password',
            )
        );

        foreach ($users as $user) {
            $stmt = "INSERT INTO users (name, password) VALUES ('" . $user[0] . "', '" . $user[1] . "');";
            $this->dbAdapter->query($stmt, Adapter::QUERY_MODE_EXECUTE);
        }
    }
}
