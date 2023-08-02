<?php 
    $starting_date = array(
        'name'	=> 'add_start_date',
        'id'	=> 'add_start_date',
        'value' => set_value('add_start_date'),
        'maxlength'	=> 10,
        'size'	=> 30,
    );

    $ending_date = array(
        'name'	=> 'ending_date',
        'id'	=> 'ending_date',
        'value' => set_value('ending_date'),
        'maxlength'	=> 10,
        'size'	=> 30,
    );
?>
<div class="content-wrapper">
<section id="basic-form-layouts">
    <div class="row">
        <div class="col-sm-12">
        <div class="content-header">Media Module</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">
                
                
                    <div class="px-3">
                        <?php echo form_open_multipart('Admin/MediaEntry'); ?>
                            <div class="form-body">
                                <h4 class="form-section" style="margin-top: 10px"><i class="fas fa-newspaper"></i>Media Enrty</h4>
                                
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="projectinput5">Media Type *</label>
                                            <?php
                                                $media_type = array(
                                                    '' => 'Select One',
                                                    1 => 'TV',
                                                    2 => 'Print',
                                                    3 => 'Paper Link',
                                                    4 => 'Organization Link'
                                                );
                                                echo form_dropdown('media_type', $media_type,'','class="form-control"');
                                             ?>
                                             <small class="text-danger" style="font-size: 11px">
                                                <?php if(form_error('media_type')){ echo form_error('media_type',); } ?>
                                            </small>
                                           
                                        </div>
                                    </div>
                                    
                                </div>
                                <!--- END OF CLASS ROW ---->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Media (Bangla) *</label>
                                            
                                            <?php echo form_input('media_name', set_value(''),'class="form-control"'); ?>
                                            <small class="text-danger" style="font-size: 11px">
                                                <?php if(form_error('media_name')){ echo form_error('media_name',); } ?>
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Media (Englisg) *</label>
                                            
                                            <?php echo form_input('media_en_name', set_value(''),'class="form-control"'); ?>
                                            <small class="text-danger" style="font-size: 11px">
                                                <?php if(form_error('media_en_name')){ echo form_error('media_en_name',); } ?>
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="projectinput1">Image Upload *</label>
                                            <?php 
                                                $Fdata = array('name' => 'user_avatar', 'class' => 'file');
                                                echo form_upload($Fdata);  
                                            ?>
                                            <small class="text-danger" style="font-size: 11px">
                                                <?php if(form_error('user_avatar')){ echo form_error('user_avatar'); } ?>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                echo form_hidden('tbl_id','media_id');
					            echo form_hidden('tbl_name','media_info');	
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