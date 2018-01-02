    <h3> <?php echo get_phrase('country');?> : <?php echo $country; ?> </h3>
    <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th><div><?php echo get_phrase('city');?></div></th>
                            <th><div><?php echo get_phrase('is_active');?></div></th>
                            <!-- <th><div><?php echo get_phrase('options');?></div></th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                foreach($state as $row):?>
                        <tr>
                            <td><?php echo $row['state_name'];?></td>
                            <td><a href="<?php echo base_url().'admin/city/'.$row['state_id'] ?>"><?php echo get_phrase('city');?></a></td>
                            <td><?php if($row['is_active'] == 1) echo "Yes"; else echo "No"; ?></td>
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
						"mColumns": [0,1,2]
					},
					{
						"sExtends": "pdf",
						"mColumns": [0,1,2]
					},
					{
						"sExtends": "print",
						"fnSetText"	   : "Press 'esc' to return",
						"fnClick": function (nButton, oConfig) {
							
							this.fnPrint( true, oConfig );
							
							window.print();
							
							$(window).keyup(function(e) {
								  if (e.which == 27) {
							
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

