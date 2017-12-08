<?php 
$edit_data      =   $this->db->get_where('currency' , array('currency_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('edit_currency');?>
                </div>
            </div>
            <div class="panel-body">
                    <?php echo form_open(base_url() . 'index.php?admin/currency/do_update/'.$row['currency_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                                                         
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('currency_name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="currency_name" value="<?php echo $row['currency_name'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('currency_code');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="currency_code" value="<?php echo $row['currency_code'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('currency_symbol');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="currency_symbol" value="<?php echo $row['currency_symbol'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('currency_value');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="currency_value" value="<?php echo $row['currency_value'];?>"/>
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
                                <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_currency');?></button>
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