<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){

		// $this->cart->destroy();
		$page_data['cart'] = $this->cart->contents();
		$json = file_get_contents('./products.json');
		$page_data['products'] = json_decode($json, TRUE);
		$this->load->view('landing/index', $page_data);
	}

	public function product_item( $id ) {
		$this->load->view('landing/item');
	}

}
