<?php 
$edit_data      =   $this->db->get_where('email_template' , array('email_template_id' => $param2) )->result_array();
foreach ( $edit_data as $row):

?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('edit_email_template');?>
                </div>
            </div>
            <div class="panel-body">
                    <?php echo form_open(base_url() . 'index.php?admin/email_template/do_update/'.$row['email_template_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                                
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('email_type');?></label>
                                <div class="col-sm-5">
                                    <input readonly="readonly" type="text" class="form-control" name="email_type" value="<?php echo $row['email_type'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('email_title');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="email_title" value="<?php echo $row['email_title'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Email_subject');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="email_subject" value="<?php echo $row['email_subject'];?>"/>
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('email_body_text');?></label>
                                <div class="col-sm-5">
                                    <textarea class="form-control" name="email_body_text"><?php echo $row['email_body_text'];?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('email_body_html');?></label>
                                <div class="col-sm-5">
                                    <textarea class="form-control" name="email_body_html"><?php echo $row['email_body_html'];?></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('is_visible');?></label>
                                <div class="col-sm-5">
                                    <select name="is_visible" class="form-control">
                                        <option value="1" <?php if($row['is_visible'] == '1')echo 'selected';?>><?php echo get_phrase('yes');?></option>
                                        <option value="0" <?php if($row['is_visible'] == '0')echo 'selected';?>><?php echo get_phrase('no');?></option>
                                    </select>
                                </div>
                            </div>
                            
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_email_template');?></button>
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