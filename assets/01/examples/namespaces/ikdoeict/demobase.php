<?php

namespace Ikdoeict;

class DemoBase {

	private $what;

	public function __construct($what) {
		$this->what = $what;
	}

	public function go() {
		return $this->what;
	}
}