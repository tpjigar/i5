<?php 
$edit_data      =   $this->db->get_where('customer' , array('customer_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('edit_customer');?>
                </div>
            </div>
            <div class="panel-body">
                    <?php echo form_open(base_url() . 'index.php?admin/paidCustomer/do_update/'.$row['customer_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                                                         
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('is_paid');?></label>
                                <div class="col-sm-5">
                                    <select name="is_paid" class="form-control">
                                        <option value="1" <?php if($row['is_paid'] == '1')echo 'selected';?>><?php echo get_phrase('yes');?></option>
                                        <option value="0" <?php if($row['is_paid'] == '0')echo 'selected';?>><?php echo get_phrase('no');?></option>
                                    </select>
                                </div>
                            </div>
                            
                            

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_customer');?></button>
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