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
		 	redirect(base_url('login')); 
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
	Public function update()
	{    $data['store_id']= $this->input->post('store_id');
	     $data['store_name']= $this->input->post('store_name');
		 $data['user_id']= $this->input->post('user_id');
		 $data['created_date']= $this->input->post('created_date');
		 $data['updated_date']= $this->input->post('updated_date');
		 $data['address_id']= $this->input->post('address_id');
		 $result=$this->store->modify_store($data['store_id'], $data);
		   if($result){
		   	 redirect(base_url('store/storelist'));
		   }else{
              echo"<b>update failed</b>";
		   }
		
	}
	/*controller function in editing store data*/
	Public function edit($id=null)
	{
	  
	   $data['storeData'] = $this->store->edit($id);
	   $user_name['name'] = $this->store->get_username_by_id();
	      echo "<pre>";
	      print_r($user_name['name'][0]->username);
       //echo json_encode($data);
         $this->load->view('user/store/storeProfile',$data);
    //$data['storeData'][0]->user_id
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
    public function modify($id= null)
    {     // $data = new stdClass(); 
          $data['storeData'] = $this->store->view($id);
          $this->load->view('user/store/storeEditProfile',$data);

    }  
	
	public function get_store($id= null){
		$data['storeData']=$this->store->view_my_stores($id);
		$this->load->view('user/store/storeView',$data);
		;
	}
    

    public function storelist(){
        $data['stores'] = $this->store->get_all_store();
    	$this->load->view('user/Admin_lte_theme/Admin_lte_header');
    	$this->load->view('user/Admin_lte_theme/Admin_lte_leftsidebar');
        $this->load->view('user/store/Admin_lte_store_list', $data);
    	$this->load->view('user/Admin_lte_theme/Admin_lte_scripts_footer');
    }

}

