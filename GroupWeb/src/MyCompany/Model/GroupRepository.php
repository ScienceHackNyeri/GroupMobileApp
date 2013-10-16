<?php

namespace MyCompany\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\TableGateway;

class GroupRepository {
 protected $groupTable;

    public function __construct()
    {
        $this->groupTable = new TableGateway(
            'groups',
            new Adapter(array(
                'driver' => 'Pdo_Sqlite',
                'database' => APPLICATION_PATH . '/data/sqlite.db'
            )
        ));
    }

    public function add($name)
    {
        $inserted = $this->groupTable->insert(array(
            'name' => $name,


        ));
        if($inserted)
            return $this->groupTable->getLastInsertValue();
        return -1;
    }

    public function getAll()
    {
        return $this->groupTable->select()->toArray();
    }

    public function get($id)
    {
        $resultSet = $this->groupTable->select(array('id = ?' => $id));
        $row = $resultSet->current();
        return ($row) ? $row->getArrayCopy() : false;
    }



    public function delete($id)
    {
        return $this->groupTable->delete(array('id = ?' => $id));
    }

    private function createTable()
    {
        $sqlDrop = 'DROP TABLE IF EXISTS groups;';

        $sqlCreate = 'CREATE TABLE groups (' . 'id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, ' . 'name TEXT NOT NULL, );';

        $this->dbAdapter->query($sqlDrop, Adapter::QUERY_MODE_EXECUTE);
        $this->dbAdapter->query($sqlCreate, Adapter::QUERY_MODE_EXECUTE);

        $group = array(
            array(
                'group',

            ),
            array(
                'group2',

            ),
            array(
                'group3',

            )
        );

        foreach ($group as $group) {
            $stmt = "INSERT INTO group (name, password) VALUES ('" . $group[0] . "');";
            $this->dbAdapter->query($stmt, Adapter::QUERY_MODE_EXECUTE);
        }
    }
}

?>