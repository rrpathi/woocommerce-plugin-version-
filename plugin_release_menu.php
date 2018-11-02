<?php 
	global $wpdb;
	$plugin_release = $wpdb->prefix."plugin_release";	
	$value = $wpdb->get_results("SELECT * FROM $plugin_release WHERE id='1'",ARRAY_A)[0];
 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="post" >
<table class="form-table">
	<tbody><tr class="form-field form-required">
		<th scope="row"><label for="slug">Slug <span class="description">(required)</span></label></th>
		<td><input name="slug" type="text" id="slug" value="<?php echo $value['slug'] ?>" aria-required="true" autocapitalize="none" autocorrect="off" maxlength="60" readonly=""></td>
	</tr>
	<tr class="form-field form-required">
		<th scope="row"><label for="Download Url">Download Url <span class="description">(required)</span></label></th>
		<td><input name="download_url" type="text" id="download_url" value="<?php echo $value['download_url'] ?>"></td>
	</tr>
	<tr class="form-field">
		<th scope="row"><label for="version">Version <span class="description">(required)</span></label></th>
		<td><input name="version" type="text" id="version" value="<?php echo $value['version'] ?>"></td>
	</tr>
	</tbody></table>
<input type="submit"  id="createusersub" name="plugin_release" class="button button-primary" value="Update Plugin Version">
</form>
</body>
</html>


<?php 
	if(isset($_POST['plugin_release'])){
		$plugin_release = $wpdb->prefix."plugin_release";	
		$where = array('id'=>'1');
		$update = array('slug'=>$_POST['slug'],'download_url'=>$_POST['download_url'],'version'=>$_POST['version']);
		$wpdb->update($plugin_release,$update,$where);
		 wp_redirect( admin_url( '/admin.php?page=plugin_release' ));
        exit;

	}
 ?>