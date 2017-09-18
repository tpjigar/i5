<?php 
$edit_data      =   $this->db->get_where('pages' , array('pages_id' => $param2) )->result_array();
foreach ( $edit_data as $row):

?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('edit_pages');?>
                </div>
            </div>
            <div class="panel-body">
                    <?php echo form_open(base_url() . 'index.php?admin/pages/do_update/'.$row['pages_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                                
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('page_name');?></label>
                                <div class="col-sm-5">
                                    <input readonly="readonly" type="text" class="form-control" name="pages_name" value="<?php echo $row['pages_name'];?>"/>
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('content');?></label>
                                <div class="col-sm-5">
                                    <textarea class="form-control" name="content"><?php echo $row['content'];?></textarea>
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
                                <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_page');?></button>
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