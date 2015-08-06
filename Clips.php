<?php
/**
 * Copyright (c) Brigham Young University, Office of Digital Humanities
 * MIT License
 *
 * See https://raw.githubusercontent.com/byu-odh/clips-php-client/master/LICENSE for full license
 * and https://github.com/BYU-ODH/clips-php-client for source repository
 */

class Clips{
	private $key;
	const API_URL = 'https://clips.byu.edu/api/1.0.0';

	public function __construct($apiKey) {
		if(!$apiKey) {
			throw new Exception('API key required.');
		}
		$this->key = $apiKey;
	}

	private function sendRequest($endpoint) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, self::API_URL . '/' . $endpoint);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			"Authorization: {$this->key}",
		));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		if(getenv('CURL_CA_BUNDLE')) {
			curl_setopt($ch, CURLOPT_CAINFO, getenv('CURL_CA_BUNDLE'));
		}

		$result = curl_exec($ch);

		if(curl_errno($ch) || ($status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) != 200) {
			$err = 'Error in request: status code ' . $status_code . '. cURL message was ' . curl_error($ch);
			curl_close($ch);
			throw new Exception($err);
		}

	 	if(curl_getinfo($ch, CURLINFO_CONTENT_TYPE) === 'application/json') {
			$result = json_decode($result, true);
		}

		curl_close($ch);
		return $result;
	}

	public function getDiagnosticTests() {
		return $this->sendRequest('diagnostic');
	}

};
