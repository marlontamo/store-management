<?php $this->load->view('header'); ?>
<div class="row">
 <table class="table-hover table">
 	<thead>
 		<th>Store Id</th>
 		<th>Store Name</th>
 		<th>address</th>
 		<th>store owner</th>
 		<th>  Options</th>
 	</thead>
 	<tbody>
 	    
         <?php 
          foreach ($information as $key) {
          echo "<tr>";	  
          echo "<td>".$key->store_id."</td>";
           echo "<td>".$key->store_name."</td>";
            echo "<td>".$key->address_id."</td>";
             echo "<td>".$this->store->get_user_by_id($key->user_id)."</td>";
             echo "<td><a href='".base_url('store/edit')."/".$key->store_id."' class='btn-danger'>edit<a><a href='".base_url('store/view')."/".$key->store_id."' class='btn-warning'>view<a><a href='' class='btn-primary'>delete<a></td>";
         
             echo "</tr>";
          }
          ?>
 		
 		 
 	</tbody>
 </table>
</div>

<?php $this->load->view('footer'); ?>