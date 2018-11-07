<table class="form-table" >
	<thead>
		<tr>
			<th>Email</th>
			<th>Activation Key</th>
			<th>Status</th>
			<th>Url</th>
			<th>Action</th>

		</tr>
	</thead>
	<tbody>
		<?php 
		global $wpdb;
		$users_list = $wpdb->prefix."activation_key";	
		$users_list = $wpdb->get_results("SELECT * FROM $users_list ",ARRAY_A);
		foreach ($users_list as $key => $value) { 
			if(!empty($value['site_url'])){
				$old_status = '1';
			}else{
				$old_status = '0';
			}
		 ?>
			<tr>
				<td><?php echo $value['email']?></td>
				<td><?php echo $value['activation_key']?></td>
				<td><?php echo $value['activation_key_status']?></td>
				<td><?php if(empty($value['site_url'])){echo 'Not Activated';}else{echo $value['site_url'];}?>					
				</td>
				<td><?php if($value['activation_key_status'] =='2'){echo '<button class="button button-primary unblock" old_status='.$old_status.' id='.$value['id'].'>Un Block</button>';}else{echo '<button class="button button-secondary block"  id='.$value['id'].'>Block</button>';} ?></td>
			</tr>
		<?php  } ?>
	</tbody>
</table>
