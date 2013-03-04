<?php

namespace Ikdoeict\Repository;

class User extends \Knp\Repository {

	public function getTableName() {
		return 'users';
	}

	public function getNumLinks($id) {
		return $this->db->fetchColumn('SELECT COUNT(*) FROM links WHERE added_by = ?', array($id));
	}

	public function getLinks($id) {
		return $this->db->fetchAll('SELECT * FROM links WHERE added_by = ?', array($id));
	}

}