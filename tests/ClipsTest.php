<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Clips.php';

error_reporting(E_ALL);
define('API_KEY', getenv('CLIPS_API_KEY'));

class ClipsTest extends PHPUnit_Framework_TestCase {

	public function testGetDiagnosticTests() {
		$c = new Clips(API_KEY);
		$d = $c->getDiagnosticTests();
		$this->assertInternalType('array', $d);
		$this->assertArrayHasKey('title', current($d));
		$this->assertArrayHasKey('name', current($d));
		$this->assertArrayHasKey('language', current($d));
	}

};
