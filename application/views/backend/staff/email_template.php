<div class="row">
    <div class="col-md-12">
    
        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('email_template_list');?>
                        </a></li>
            <li>
                <a href="#add" id="add_email_template" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_email_template');?>
                        </a></li>
        </ul>
        <!------CONTROL TABS END------>
        <div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
               <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th><div><?php echo get_phrase('email_type');?></div></th>
                            <th><div><?php echo get_phrase('email_title');?></div></th>
                            <th><div><?php echo get_phrase('is_visible');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                $email_template = $this->db->get('email_template' )->result_array();
                                foreach($email_template as $row):?>
                        <tr>
                            <td><?php echo $row['email_type'];?></td>
                            <td><?php echo $row['email_title'];?></td>
                            <td><?php if($row['is_visible'] == 1) echo "Yes"; else echo "No"; ?></td>
                            <td>
                                
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                        
                                        <!-- teacher EDITING LINK -->
                                        <li>
                                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_email_template_edit/<?php echo $row['email_template_id'];?>');">
                                            	<i class="entypo-pencil"></i>
													<?php echo get_phrase('edit');?>
                                               	</a>
                                        				</li>
                                        <li class="divider"></li>
                                        
                                        <!-- teacher DELETION LINK -->
                                        <li>
                                        	<a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/email_template/delete/<?php echo $row['email_template_id'];?>');">
                                            	<i class="entypo-trash"></i>
													<?php echo get_phrase('delete');?>
                                               	</a>
                                        				</li>
                                    </ul>
                                </div>
                                
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
            <!----TABLE LISTING ENDS--->
            
            
            <!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open(base_url() . 'admin/email_template/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('email_type');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="email_type" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('email_title');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="email_title" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('email_subject');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="email_subject" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email_body_text');?></label>
                                <div class="col-sm-5">
                                    <textarea class="form-control" name="email_body_text"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email_body_html');?></label>
                                <div class="col-sm-5">
                                    <textarea class="form-control" name="email_body_html"></textarea>
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
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_email_template');?></button>
                                </div>
                                </div>
                    </form>                
                </div>                
            </div>
            <!----CREATION FORM ENDS-->
            
        </div>
    </div>
</div>




