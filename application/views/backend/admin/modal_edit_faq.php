<?php 
$edit_data		=	$this->db->get_where('faq' , array('faq_id' => $param2) )->result_array();
?>
<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php echo form_open(base_url(). 'admin/faq/do_update/'.$row['faq_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
            <div class="padded">
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('question');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="question" value="<?php echo $row['question'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('answer');?></label>
                    <div class="col-sm-5">
                        <div class="box closable-chat-box">
                            <div class="box-content padded">
                                    <div class="chat-message-box">
                                    <textarea name="answer" id="ttt" rows="5" class="form-control"
                                    	placeholder="<?php echo get_phrase('add_answer');?>"><?php echo $row['answer'];?></textarea>
                                    </div>
                            </div>
                        </div>
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
                            
                
            </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-5">
                  <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_faq');?></button>
              </div>
            </div>
        </form>
        <?php endforeach;?>
    </div>
</div>