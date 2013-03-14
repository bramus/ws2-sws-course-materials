<?php

namespace Ikdoeict\Repository;

class LinksRepository extends \Knp\Repository {

	public function getTableName() {
		return 'links';
	}

	public function findAll() {
		return $this->db->fetchAll('SELECT links.url, links.title, links.id, links.added_on, links.added_by, users.firstname FROM links INNER JOIN users ON links.added_by = users.id');
	}

}