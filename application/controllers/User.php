<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{

	public function index()
	{
		$this->data['title'] = 'Profile Full Name';
		$this->load->view('templates/header', $this->data);
		$this->load->view('templates/navbar', $this->data);
		$this->load->view('user/profile', $this->data);
		$this->load->view('templates/footer', $this->data);
	}

}