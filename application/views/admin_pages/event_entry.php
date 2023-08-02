<?php 

$p_date = array(
	'name'	=> 'p_date',
	'id'	=> 'p_date',
	'value' => set_value('p_date'),
	'maxlength'	=> 10,
	'size'	=> 30,
);
?>
<div class="content-wrapper">
<section id="basic-form-layouts">
    <div class="row">
        <div class="col-sm-12">
        <div class="content-header">Event Module</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">

                    <div class="px-3">
                        <?php echo form_open_multipart('Admin/EventInsert'); ?>
                            <div class="form-body">
                                <h4 class="form-section" style="margin-top: 10px"><i class="fas fa-newspaper"></i>Event Entry</h4>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Event Title *</label>
                                            <?php echo form_input('p_title', set_value(''),'class="form-control"'); ?>
                                            <small class="text-danger" style="font-size: 11px">
                                                <?php if(form_error('p_title')){ echo form_error('p_title',); } ?>
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Place of Event *</label>
                                            
                                            <?php echo form_input('p_place', set_value(''),'class="form-control"'); ?>
                                            <small class="text-danger" style="font-size: 11px">
                                                <?php if(form_error('p_place')){ echo form_error('p_place',); } ?>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                               
                                <!--- END OF CLASS ROW ---->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Place of Event *</label>
                                            <?php  echo form_input(array('type' => 'date','id'=>"p_date" , 'class'=>"form-control",  'value' => $p_date['value'] , 'name' => "p_date",)); ?>
                                            <small class="text-danger" style="font-size: 11px">
                                                <?php if(form_error('p_place')){ echo form_error('p_place',); } ?>
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Time schedule</label>
                                            <?php echo form_input('p_time', set_value(''),'class="form-control"'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Organizer *</label>
                                            <?php echo form_input('p_organizer', set_value(''),'class="form-control"'); ?>
                                            <small class="text-danger" style="font-size: 11px">
                                                <?php if(form_error('p_organizer')){ echo form_error('p_organizer',); } ?>
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <h4 class="form-section"><i class="ft-file-text"></i> File </h4>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="projectinput1">Event Image</label>
                                            <!-- <input type="file" class="form-control-file" id="projectinput8"> -->
                                            <?php 
                                                $Fdata = array('name' => 'user_avatar', 'class' => 'file');
                                                echo form_upload($Fdata);  
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <!--- END OF CLASS ROW ---->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for=""> Description *</label>
                                            <!-- <textarea id="projectinput8" rows="3" class="form-control" name="comment"></textarea> -->
                                            <?php echo form_textarea('p_des', set_value(''),''); ?>
                                        </div>
                                    </div>
                                </div>
                                
                
                            </div>
                            <?php
                                echo form_hidden('tbl_id','p_id');
					            echo form_hidden('tbl_name','prog_info');
                            ?>
                        
                            <div class="form-actions">
                                <?php echo form_reset('sign_in ', 'Refresh','class="btn btn-raised btn-raised btn-warning mr-1"'); ?>
                                <?php echo form_submit('upload', 'Save','class="btn btn-raised btn-raised btn-primary"'); ?>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
               
                </div>
            </div>
        </div>
    </div>
</section>
</div>