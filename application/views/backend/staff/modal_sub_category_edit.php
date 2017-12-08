<?php 
$edit_data      =   $this->db->get_where('sub_category' , array('sub_category_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('edit_sub_category');?>
                </div>
            </div>
            <div class="panel-body">
                    <?php echo form_open(base_url() . 'index.php?admin/sub_category/do_update/'.$row['sub_category_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                                
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                                
                                <div class="col-sm-5">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                            <img src="<?php echo $this->crud_model->get_image_url('sub_category' , $row['sub_category_id']);?>" alt="...">
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
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="sub_category_name" value="<?php echo $row['sub_category_name'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('category_name');?></label>
                                <div class="col-sm-5">
                                    <select name="category_id" class="form-control" style="width:100%;">
                                        <?php 
                                        $categories = $this->db->get('category')->result_array();
                                        foreach($categories as $row1):
                                        ?>
                                            <option value="<?php echo $row1['category_id'];?>"<?php if($row['category_id'] == $row1['category_id'])echo 'selected';?>><?php echo $row1['category_name'];?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                                <div class="col-sm-5">
                                    <textarea class="form-control" name="sub_category_desc"><?php echo $row['sub_category_desc'];?></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('is_visible');?></label>
                                <div class="col-sm-5">
                                    <select name="is_visible" class="form-control">
                                        <option value="yes" <?php if($row['is_visible'] == 'yes')echo 'selected';?>><?php echo get_phrase('yes');?></option>
                                        <option value="no" <?php if($row['is_visible'] == 'no')echo 'selected';?>><?php echo get_phrase('no');?></option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('seo_title');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="seo_title" value="<?php echo $row['seo_title'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('seo_keyword');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="seo_keyword" value="<?php echo $row['seo_keyword'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('seo_description');?></label>
                                <div class="col-sm-5">
                                    <textarea class="form-control" name="seo_desc"><?php echo $row['seo_desc'];?></textarea>
                                </div>
                            </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_sub_category');?></button>
                            </div>
                        </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>