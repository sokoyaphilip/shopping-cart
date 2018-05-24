<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Twilio\Rest\Client;

class Cart extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		// $page_data['cart'] = $this->cart->contents();		
		$this->load->view('landing/cart');
	}	

	public function cart_update(){
		// we need to update the cart by the number of quantity that the use must have set

		if( $_POST ){
			$data = array(
				'rowid' => $_POST['row_id'],
				'qty'	=> $_POST['qty']
			);
			$this->cart->update($data);
		}else{
			redirect('landing');
		}

		// $carts = $this->cart->contents();
		// foreach( $_POST as $post => $value ){
		// 	foreach( $carts as $cart => $ct ) {
		// 		$this->cart->update(
		// 			array(
		// 				'cart' => $cart, 
		// 				'qty' => $value['qty'])
		// 			);
		// 	}
		// }
		// is user loggedin
		// if( $this->session->userdata('logged_in') )
	}

	public function checkout(){
		if($_POST){
			// verify that the transaction is correct
			$url = $_POST['reference'];
			// if( $result = $this->call_curl($_POST['reference']) ){
			// 	if( $result['data']['status'] == "success") {
					// Send SMS
					$email = $this->session->userdata('email');
					$to = preg_replace('/^0/','+234',$this->session->userdata('phone'));
					$from = '';
					$sid    = "";
					$token  = "";
					$twilio = new Client($sid, $token);
					$message = $twilio->messages
					                  ->create( "{$to}",
					                           array(
					                               'body' => "This is a confirmation for ordering item(s) on shoppingcart.ng, check your mail for more details",
					                               'from' => "{$from}"
					                           )
					                  );					

					// Send mail
					$message = '';
					$message = "Hello, \n Thank you for choosing us, we hope you had an amazing experience.\n Please see your orders below.";
					$message .='<table cellpadding="6" cellspacing="1" style="width:100%" border="0"><tr><th>QTY</th><th>Item Description</th><th style="text-align:right">Item Price</th><th style="text-align:right">Sub-Total</th></tr>';

					$carts = $this->cart->contents();
					foreach( $carts as $cart => $variable ) {
						$message .= '<tr>';
						// foreach ($variable as $key => $value) {
						$message .='<td>' . $variable['qty'] . '</td>';
						$message .='<td>' . $variable['name'] . '</td>';
						$message .='<td>' . lang('ngn').$variable['price'] . '</td>';
						$message .='<td>' . lang('ngn').$variable['subtotal'] . '</td>';
						// }
						$message .= '</tr>';
					}

					$message .= '<tr><td colspan="2"></td><td class="right"><strong>Total</strong></td><td class="right">' .lang('ngn');
					$message .= $this->cart->format_number($this->cart->total());
					$message .= '</td></tr>';
					$message .='</table>';
					$message .="\n<footer>" .lang('footer_text'). "</footer>";
					$post = array(
						'to' => $email,
						'template' => 'OrderTemplate',
						'merge_accountaddress' => $email,
						'merge_message' => $message,
						'isTransactional' => false
					);
					// To use 
					if( $this->send_mail($post) ){
						// destroy the cart
						$this->cart->destroy();
						$this->session->set_flashdata(array('succes_msg' => 'Thank you for the order(s).' ));
						echo json_encode(array('status' => 'success', 'message' => 'Thank you for the order(s).'));
						exit;
					}else{
						echo json_encode(array('status' => 'error', 'message' => 'There was a technical error...'));
						exit;
					}
			// 	}else{
			// 		echo json_encode(array('status' => 'error', 'message' => 'Returning no success from Paystack.'));
			// 		exit;
			// 	}
			// }else{
			// 	echo json_encode(array('status' => 'error', 'message' => 'Technical cURL error'));
			// 	exit;
			// }

		}else{
			redirect('landing');
		}
	}

	function send_mail($post){
		$url = 'https://api.elasticemail.com/v2/email/send';
		try{
			$post['from'] = '{email_here}';
			$post['fromName'] = 'Shoppingcart.ng';
			$post['apikey'] = '{Your_elastic_email_key}';
			$ch = curl_init();
			curl_setopt_array($ch, array(
	            CURLOPT_URL => $url,
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => $post,
	            CURLOPT_RETURNTRANSFER => true,
	            CURLOPT_HEADER => false,
				CURLOPT_SSL_VERIFYPEER => false
	        ));			
	        $result=curl_exec ($ch);
	        curl_close($ch);
	        return $result;	
		}catch(Exception $ex){
			return false;
		}
	}

}
