<div class="row">
    <div class="col-md-12">
    
        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('pages_list');?>
                        </a></li>
            <li>
                <a href="#add" id="add_pages" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_pages');?>
                        </a></li>
        </ul>
        <!------CONTROL TABS END------>
        <div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
               <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th><div><?php echo get_phrase('page_name');?></div></th>
                            <th><div><?php echo get_phrase('is_visible');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                $pages = $this->db->get('pages' )->result_array();
                                foreach($pages as $row):?>
                        <tr>
                            <td><?php echo $row['pages_name'];?></td>
                            <td><?php if($row['is_visible'] == 1) echo "Yes"; else echo "No"; ?></td>
                            <td>
                                
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                        
                                        <!-- teacher EDITING LINK -->
                                        <li>
                                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_pages_edit/<?php echo $row['pages_id'];?>');">
                                            	<i class="entypo-pencil"></i>
													<?php echo get_phrase('edit');?>
                                               	</a>
                                        				</li>
                                        <li class="divider"></li>
                                        
                                        <!-- teacher DELETION LINK -->
                                        <li>
                                        	<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/pages/delete/<?php echo $row['pages_id'];?>');">
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
                    <?php echo form_open(base_url() . 'index.php?admin/pages/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('page_name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="pages_name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('content');?></label>
                                <div class="col-sm-5">
                                    <textarea class="form-control" name="content"></textarea>
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
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_page');?></button>
                                </div>
                                </div>
                    </form>                
                </div>                
            </div>
            <!----CREATION FORM ENDS-->
            
        </div>
    </div>
</div>




