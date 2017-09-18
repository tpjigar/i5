
           <!--  <a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_country_add/');" 
            	class="btn btn-primary pull-right">
                <i class="entypo-plus-circled"></i>
            	<?php echo get_phrase('add_new_country');?>
                </a>  -->
                <br><br>
               <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th width="80"><div><?php echo get_phrase('icon');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th><div><?php echo get_phrase('iso');?></div></th>
                            <th><div><?php echo get_phrase('phonecode');?></div></th>
                            <th><div><?php echo get_phrase('state');?></div></th>
                            <th><div><?php echo get_phrase('is_active');?></div></th>
                            <!-- <th><div><?php echo get_phrase('options');?></div></th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                // $categories	=	$this->db->get('category' )->result_array();
                                foreach($countries as $row):?>
                        <tr>
                            <td>
                                <?php 
                                if (file_exists('uploads/flag_icon_image/' . $row['flag_icon'] ))
                                    $image_url = base_url() . 'uploads/flag_icon_image/'.$row['flag_icon'];
                                else
                                    $image_url = base_url() . 'uploads/user.jpg';
                                ?>
                            <img src="<?php echo $image_url; ?>" width="30" /></td>
                            <td><?php echo $row['country_name'];?></td>
                            <td><?php echo $row['iso2'];?></td>
                            <td><?php echo $row['phonecode'];?></td>
                            <td><a href="<?php echo base_url().'index.php?admin/state/'.$row['country_id'] ?>"><?php echo get_phrase('state');?></a></td>
                            <td><?php if($row['is_active'] == 1) echo "Yes"; else echo "No"; ?></td>
                            <!-- <td>
                                
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                        
                                        <!-- teacher EDITING LINK ->
                                        <li>
                                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_country_edit/<?php echo $row['country_id'];?>');">
                                            	<i class="entypo-pencil"></i>
													<?php echo get_phrase('edit');?>
                                               	</a>
                                        				</li>
                                        <li class="divider"></li>
                                        
                                        <!-- teacher DELETION LINK ->
                                        <li>
                                        	<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/country/delete/<?php echo $row['country_id'];?>');">
                                            	<i class="entypo-trash"></i>
													<?php echo get_phrase('delete');?>
                                               	</a>
                                        				</li>
                                    </ul>
                                </div>
                                
                            </td> -->
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable({
			"sPaginationType": "bootstrap",
			"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
			"oTableTools": {
				"aButtons": [
					
					{
						"sExtends": "xls",
						"mColumns": [1,2,3]
					},
					{
						"sExtends": "pdf",
						"mColumns": [1,2,3]
					},
					{
						"sExtends": "print",
						"fnSetText"	   : "Press 'esc' to return",
						"fnClick": function (nButton, oConfig) {
							datatable.fnSetColumnVis(0, false);
                            datatable.fnSetColumnVis(4, false);
                            datatable.fnSetColumnVis(5, false);
                            datatable.fnSetColumnVis(5, false);
							
							this.fnPrint( true, oConfig );
							
							window.print();
							
							$(window).keyup(function(e) {
								  if (e.which == 27) {
									  datatable.fnSetColumnVis(0, true);
                                      datatable.fnSetColumnVis(4, true);
                                      datatable.fnSetColumnVis(5, true);
                                      datatable.fnSetColumnVis(6, true);
								  }
							});
						},
						
					},
				]
			},
			
		});
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script>

