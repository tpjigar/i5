<?php 
$edit_data      =   $this->db->get_where('seo_meta' , array('seo_meta_id' => $param2) )->result_array();
foreach ( $edit_data as $row):

?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('edit_SEO');?>
                </div>
            </div>
            <div class="panel-body">
                    <?php echo form_open(base_url() . 'admin/seo_meta/do_update/'.$row['seo_meta_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                                
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('page_name');?></label>
                                <div class="col-sm-5">
                                    <input readonly="readonly" type="text" class="form-control" name="page_name" value="<?php echo $row['page_name'];?>"/>
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
                                <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                                <div class="col-sm-5">
                                    <textarea class="form-control" name="seo_desc"><?php echo $row['seo_desc'];?></textarea>
                                </div>
                            </div>
                            
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_SEO');?></button>
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