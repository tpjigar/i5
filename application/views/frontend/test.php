<div class="section-padding"></div>

<style type="text/css">
ul li
{
	display: inline-block;
}
</style>
<!-- LANGUAGE -->
<!-- UPDATED FILE LIST
	INCLUDE LIBRARY LANGUAGE_HELPER.PHP
CONTROLLER-> set_language()
JAVASCRIPT -> INCLUDE_BOTTONM.PHP -> set_langs CLICK EVENT 
-->
<ul style="list-style: none;">
	<?php
    	$fields = $this->db->list_fields('language');
		foreach($fields as $field)
		{
			if($field == 'phrase_id' || $field == 'phrase')continue;
	?>
	<li><a href="<?php echo base_url().'user/set_language/'.$field; ?>"> <?php echo $field ?></a></li>
	<?php } ?>
	
</ul>
<h1><?php echo translate('login');?></h1>
<!--  -->
<hr>

<!-- CURRENCY -->
<!-- UPDATED FILE LIST
	INCLUDE LIBRARY LANGUAGE_HELPER.PHP
CONTROLLER-> set_currency()
JAVASCRIPT -> INCLUDE_BOTTONM.PHP -> set_langs CLICK EVENT 
 -->
<ul style="list-style: none;">
	<?php
    	$currencies = $this->db->get_where('currency_settings',array('status'=>'ok'))->result_array();
		foreach($currencies as $row)
		{
	?>
	<li>
		<a href="<?php echo base_url().'user/set_currency/'.$row['currency_settings_id']; ?>"> <?php echo $row['name']; ?> (<?php echo $row['symbol']; ?>)</a>
	</li>
	<?php } ?>
	
</ul>
<h1><?php echo currency(280); ?></h1>