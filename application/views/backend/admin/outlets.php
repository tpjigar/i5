<div class="row">
    <div class="col-md-12">
    
        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('outlets_list');?>
                        </a></li>
            <li>
                <a href="#add" id="add_state" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_outlet');?>
                        </a></li>
        </ul>
        <!------CONTROL TABS END------>
        <div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
               <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th width="80"><div><?php echo get_phrase('photo');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th><div><?php echo get_phrase('description');?></div></th>
                            <th><div><?php echo get_phrase('email');?></div></th>
                            <th><div><?php echo get_phrase('contact_number');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                foreach($outlets as $row):?>
                        <tr>
                            <td><img src="<?php echo $this->crud_model->get_image_url('outlets',$row['outlets_id']);?>"  width="100" /></td>
                            <td><?php echo $row['outlets_name'];?></td>
                            <td><?php echo $row['short_desc'];?></td>
                            <td><?php echo $row['email'];?></td>
                            <td><?php echo $row['contact_number'];?></td>
                            <td>
                                
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                        
                                        <!-- teacher EDITING LINK -->
                                        <li>
                                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_outlets_edit/<?php echo $row['outlets_id'];?>');">
                                            	<i class="entypo-pencil"></i>
													<?php echo get_phrase('edit');?>
                                               	</a>
                                        				</li>
                                        <li class="divider"></li>
                                        
                                        <!-- teacher DELETION LINK -->
                                        <li>
                                        	<a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/outlets/delete/<?php echo $row['outlets_id'];?>');">
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
            <!--TABLE LISTING ENDS-->

            <!-- CREATION FORM STARTS-->
            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open(base_url() . 'admin/outlets/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('outlets_name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" data-validate="required" class="form-control" name="outlets_name"  data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('category_name');?></label>
                                
                                <div class="col-sm-5">
                                    <select name="category_id" class="form-control" onchange="return get_category_subcategory(this.value)">
                                      <option value=""><?php echo get_phrase('select');?></option>
                                      <?php 
                                        $categories = $this->db->get_where('category',array('is_visible'=> 1))->result_array();
                                        foreach($categories as $row2):
                                            ?>
                                            <option value="<?php echo $row2['category_id'];?>">
                                                <?php echo $row2['category_name'];?>
                                            </option>
                                        <?php
                                        endforeach;
                                      ?>
                                  </select>
                                </div> 
                            </div>

                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('sub_category_name');?></label>
                                
                                <div class="col-sm-5">
                                    <select name="sub_category_id" id="sub_category_id" class="form-control">
                                      <option value=""><?php echo get_phrase('select_category_first'); ?></option>
                                  </select>
                                </div> 
                            </div>

                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                                
                                <div class="col-sm-5">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                            <img src="http://placehold.it/200x200" alt="...">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                        <div>
                                            <span class="btn btn-white btn-file">
                                                <span class="fileinput-new">Select image</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" name="userfile" accept="image/*">
                                            </span>
                                            <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('short_desc');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="short_desc"  data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('long_desc');?></label>
                                <div class="col-sm-5">
                                    <textarea class="form-control" name="long_desc"  data-message-required="<?php echo get_phrase('value_required');?>"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('facilities');?></label>
                                <div class="col-sm-5">
                                    <textarea class="form-control" name="facilities"  data-message-required="<?php echo get_phrase('value_required');?>"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('other_facilities');?></label>
                                <div class="col-sm-5">
                                    <select multiple name="facilities_icon" class="form-control" >
                                      <option value=""><?php echo get_phrase('select');?></option>
                                      <?php 
                                        $facilitiesData = $this->db->get_where('facilities',array('is_visible'=> 1))->result_array();
                                        foreach($facilitiesData as $facilitie):
                                            ?>
                                            <option value="<?php echo $facilitie['facilities_id'];?>">
                                                <?php echo $facilitie['facilities_name'];?>
                                            </option>
                                        <?php
                                        endforeach;
                                      ?>
                                    </select>
                                    (hold ctrl to select more than one):
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('country_name');?></label>
                                
                                <div class="col-sm-5">
                                    <select name="country_id" class="form-control" onchange="return get_country_state(this.value)">
                                      <option value=""><?php echo get_phrase('select');?></option>
                                      <?php 
                                        $countries = $this->db->get_where('country',array('is_visible'=> 1))->result_array();
                                        foreach($countries as $row2):
                                            ?>
                                            <option value="<?php echo $row2['country_id'];?>">
                                                <?php echo $row2['country_name'];?>
                                            </option>
                                        <?php
                                        endforeach;
                                      ?>
                                  </select>
                                </div> 
                            </div>

                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('state_name');?></label>
                                
                                <div class="col-sm-5">
                                    <select name="state_id" id="state_id" class="form-control" onchange="return get_state_city(this.value)">
                                      <option value=""><?php echo get_phrase('select_country_first'); ?></option>
                                  </select>
                                </div> 
                            </div>

                            <div class="form-group">
                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('city_name');?></label>
                                
                                <div class="col-sm-5">
                                    <select name="city_id" id="city_id" class="form-control">
                                      <option value=""><?php echo get_phrase('select_state_first'); ?></option>
                                  </select>
                                </div> 
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('pincode');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="pincode"  data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="address"  data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('open_time');?> (24Hr format)</label> 
                                <div class="col-sm-9">
                                <div class="col-sm-4"><?php echo get_phrase('sunday');?>
                                    <input type="text" class="form-control" name="time_sun"  data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                                <div class="col-sm-4"><?php echo get_phrase('monday');?>
                                    <input type="text" class="form-control" name="time_mon"  data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                                <div class="col-sm-4"><?php echo get_phrase('tuesday');?>
                                    <input type="text" class="form-control" name="time_tue"  data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                                <div class="col-sm-4"><?php echo get_phrase('wednesday');?>
                                    <input type="text" class="form-control" name="time_wed"  data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                                <div class="col-sm-4"><?php echo get_phrase('thursday');?>
                                    <input type="text" class="form-control" name="time_thu"  data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                                <div class="col-sm-4"><?php echo get_phrase('friday');?>
                                    <input type="text" class="form-control" name="time_fri"  data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                                <div class="col-sm-4"><?php echo get_phrase('saturday');?>
                                    <input type="text" class="form-control" name="time_sat"  data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>

                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="email"  data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('website');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="website"  data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('contact_number');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="contact_number"  data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('latitude');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="latitude"  data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('longitude');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="longitude"  data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('seo_title');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="seo_title"  data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('seo_keyword');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="seo_keyword"  data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('seo_desc');?></label>
                                <div class="col-sm-5">
                                    <textarea class="form-control" name="seo_desc"  data-message-required="<?php echo get_phrase('value_required');?>"></textarea>
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
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_outlets');?></button>
                                </div>
                                </div>
                    </form>                
                </div>                
            </div>
            <!----CREATION FORM ENDS-->
            
        </div>
    </div>
</div>



<script type="text/javascript">
        
    function get_category_subcategory(category_id) {

        $.ajax({
            url: '<?php echo base_url();?>admin/get_category_subcategory/'+category_id ,
            success: function(response)
            { 
                jQuery('#sub_category_id').html(response);
            }
        });

    }

    function get_country_state(country_id) {

        $.ajax({
            url: '<?php echo base_url();?>admin/get_country_state/'+country_id ,
            success: function(response)
            { 
                jQuery('#state_id').html(response);
                get_state_city(jQuery('#state_id').val());
            }
        });

    }

    function get_state_city(state_id) {

        $.ajax({
            url: '<?php echo base_url();?>admin/get_state_city/'+state_id ,
            success: function(response)
            { 
                jQuery('#city_id').html(response);
            }
        });

    }

</script>