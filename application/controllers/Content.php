<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends CI_Controller 
{

	public function index()
	{
		$this->data['title'] = 'Home';
		$this->load->view('templates/header', $this->data);
		$this->load->view('templates/navbar', $this->data);
		$this->load->view('home/index.php', $this->data);
		$this->load->view('templates/footer', $this->data);
	}

	public function direct()
	{
		$this->data['title'] = 'Direct';
		$this->load->view('templates/header', $this->data);
		$this->load->view('templates/navbar', $this->data);
		$this->load->view('home/direct_message.php', $this->data);
		$this->load->view('templates/footer', $this->data);
	}
}