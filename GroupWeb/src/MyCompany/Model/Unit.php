<?php

namespace MyCompany\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;

class Unit {
	protected $unitTable;

	public function __construct()
	{
		$this->unitTable = new TableGateway(
				'groups',
				new Adapter(array(
						'driver' => 'Pdo_Sqlite',
						'database' => APPLICATION_PATH . '/data/sqlite.db'
				)
				));
	}

	public function add($name)
	{
		$inserted = $this->unitTable->insert(array(
				'name' => $name,


		));
		if($inserted)
			return $this->unitTable->getLastInsertValue();
		return -1;
	}

	public function getAll()
	{
		return $this->unitTable->select()->toArray();
	}

	public function get($id)
	{
		$resultSet = $this->unitTable->select(array('id = ?' => $id));
		$row = $resultSet->current();
		return ($row) ? $row->getArrayCopy() : false;
	}





	private function createTable()
	{
		$sqlDrop = 'DROP TABLE IF EXISTS units;';

		$sqlCreate = 'CREATE TABLE units (' . 'id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, ' . 'unitName TEXT NOT NULL, );';

		$this->dbAdapter->query($sqlDrop, Adapter::QUERY_MODE_EXECUTE);
		$this->dbAdapter->query($sqlCreate, Adapter::QUERY_MODE_EXECUTE);

		$units = array(
				array(
						'ICS2000',

				),
				array(
						'SMA2100',

				),
				array(
						'HRD300',

				)
		);

		foreach ($units as $unit) {
			$stmt = "INSERT INTO units (name) VALUES ('" . $unit[0] . "');";
			$this->dbAdapter->query($stmt, Adapter::QUERY_MODE_EXECUTE);
		}
	}
}

?>