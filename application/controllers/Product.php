<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$page_data['cart'] = $this->cart->contents();
		$cat = cleanit($this->uri->segment(3));
		$product_id = cleanit($this->uri->segment(4));
		$json = file_get_contents('./products.json');
		$prod = json_decode($json, TRUE);
		$x = 0;
		foreach( $prod as $key ){
			if( $key['id'] == $product_id && $key['category'] == strtolower($cat)){
				$page_data['product'] = $prod[$x];
			}
			$x++;
		}
		if( !empty($page_data['product']) ){
			// get the cart content
			$cart = $this->cart->contents();
			$this->load->view('landing/item', $page_data);
		}
		else{
			$this->session->set_flashdata(array('error_msg' => 'The product item can not be found.'));
			redirect('landing');
		}
	}

	public function category(){
		$page_data['cart'] = $this->cart->contents();
		$cat = cleanit($this->uri->segment(3));
		$json = file_get_contents('./products.json');
		$prod = json_decode($json, TRUE);
		// lets check if product category exist
		$page_data['products'] = array();
		$x = 0;
		foreach( $prod as $value ){
			if( $value["category"] == strtolower($cat) ){
				array_push( $page_data['products'], $prod[$x] );
			}
			$x++;
		}	
		if(empty($page_data['products'])){
			$this->session->set_flashdata(array('error_msg' => 'Product Category not found.' ));
			redirect('landing');
		}else {
			$this->load->view('landing/category', $page_data);			
		}
	}

	// add to cart
	public function add_to_cart(){

		$id = $_POST['product_id'];
		// check if the product id is available
		$carts = $this->cart->contents();
		foreach( $carts as $cart => $value ) {
			if( $id == $value ){
				echo json_encode( array('status' => 'error', 'message' => 'This product already in the cart system'));
				exit;
			}
		}
		$json = file_get_contents('./products.json');
		$products = json_decode($json, TRUE);
		// $cart = $this->cart->contents();

		foreach( $products as $product ){
			if( $product['id'] == $id ){
				$data = array(
					'id' => $id,
					'qty' => 1,
					'price' => $product['amount'],
					'name' => $product['product_name']
				);
				$this->cart->insert($data);
				echo json_encode( array('status' => 'success', 'message' => 'Product item successfully added to cart'));
				exit;
			}
		}
	}

	// remove from cart
	public function remove_from_cart(){
		if( $this->cart->remove($_POST['product_id'])) {
			echo json_encode( array('status' => 'success', 'message' => 'Product item has been removed successfully.'));
			exit;
		}else{
			echo json_encode( array('status' => 'error', 'message' => 'There was an error removing the product item'));
			exit;
		}
	}

}
