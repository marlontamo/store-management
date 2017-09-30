<?php $this->load->view('header'); ?>
<div class="row">
	<div class="col-md-4">
		<div class="row">
				<div class="image-profile">
				  <h1>shownewstore</h1>
				     
         				</div>
		           
		</div>
	</div>

	<div class="col-md-4">
	<?php 
    foreach ($storeData as $key) {
    	echo "<h4>store name:".$key->store_name."</h4>";
    	echo  "<h4>store owner:".$key->user_id."</h4>";
    }
	 ?>
		
		
	</div>

<?php $this->load->view('footer'); ?>