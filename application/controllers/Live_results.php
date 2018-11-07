<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Live_results extends CI_Controller {

	public function index()
	{
		$this->load->view('include/header');
		$this->load->view('pages/live_results');
	}
}
