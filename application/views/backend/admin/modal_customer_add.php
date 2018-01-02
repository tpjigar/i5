<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_customer');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'admin/customer/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('first_name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="first_name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('last_name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="last_name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="email_id" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('mobile');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="mobile" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>
						<div class="col-sm-5">
							<textarea class="form-control" name="address"></textarea>
						</div>
					</div>
					
                    <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('is_visible');?></label>
                        
						<div class="col-sm-5">
							<select name="is_visible" class="form-control">
                              <option value="1"><?php echo get_phrase('yes');?></option>
                              <option value="0"><?php echo get_phrase('no');?></option>
                          </select>
						</div> 
					</div>

					
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('add_customer');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>