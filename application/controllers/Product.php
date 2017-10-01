<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
 */
class Product extends CI_Controller {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
		$this->load->model('product_model','product');
		$this->load->model('user_model','user');
		$this->load->helper('form');
		$this->load->database();
		$this->load->library('xmlrpc');
        
		
		
	}
	
	
	public function create()
	{
      
      $this->load->view('user/product/createNewProduct');
      
	}
	/*controller function  in creating new store*/
	public function getvar(){
		echo "motherfucker";
	}
    /*controller function in updating store*/
	Public function update($id)
	{
		
		echo $this->home->update($id);
	}
	/*controller function in editing store data*/
	Public function edit($id=null)
	{
	  
	   $data['storeData'] = $this->store->edit($id);
	   $user_name = $this->store->get_user_by_id($data['storeData'][0]->user_id);
	    

       //echo json_encode($data);
         $this->load->view('user/store/storeProfile',$data);
    
	}
	/*controller function in deleting store*/
	public function delete()
	{
		$data = json_decode(file_get_contents("php://input"));   	             
		echo $this->home->delete($data);
		
	}
	/*
	*controller for store api
	*/
	Public function get_data()
	{
		$data = array();
		$data = $this->store->get_data();
		echo json_encode($data);

	}
    public function view( $id)
    {
          $data['storeData'] = $this->store->view($id);
          $this->load->view('user/store/storeView',$data);
    } 
	public function StoreList(){
        

         $data['information'] = $this->store->get_all_store();
         $this->load->view('user/store/storeList',$data);
          //echo "<pre>";
          //print_r($data);

	}
	public function Logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

}
