<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
 */
class Store extends CI_Controller {

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
		$this->load->model('store_model','store');
		$this->load->helper('form');
		$this->load->database();
		if($_SESSION['logged_in'] == null){
		 	redirect(base_url('home/login')); 
		 }  
		
	}
	
	
	public function index() {
		//load the form
	 
	 if(isset($_POST['submit'])== 1){
         $data['info'] = array( //'store_id' => $_POST['store_id'],
		 	                    'store_name' => $_POST['store_Name'],
		 	                    'user_id' => $_POST['user_Id'],
		 	                    'created_date'=> $_POST['created_date'],
        	                    'updated_date'=> $_POST['updated_date'],
        	                    'address_id'=> $_POST['location']
        	                    );
	 
       $this->store->insert($data);
      if($this->db->affected_rows()){
      	 $data = array();
		$data['info'] = $this->store->get_data();
      	 $this->load->view('user/store/storeCreatedSuccess',$data);
      }else{
      	 echo'<h1>failed to insert data!!!</h1>';

      }
     } else{
     	$this->load->view('user/store/createStoreView');
     }
	}
	/*controller function  in creating new store*/
	public function create(){
		
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
    public function view($id= null)
    {
          $data['storeData'] = $this->store->view($id);
          $this->load->view('user/store/storeProfile',$data);
    } 
	public function StoreList(){
        

         $data['information'] = $this->store->get_all_store();
         $this->load->view('user/store/storeList',$data);
          //echo "<pre>";
          //print_r($data);

	}
	public function get_store($id= null){
		$data['storeData']=$this->store->view_my_stores($id);
		$this->load->view('user/store/storeView',$data);
		;
	}

}

