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
        <div class="content-header">Ads Sense Module</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">
                <?php if($news_pol_edit){?>

                    <div class="px-3">
                        <?php echo form_open_multipart('Admin/EditPoll/'.$pol_id); ?>
                            <?php foreach($news_pol_edit as $row): { ?>
                            <div class="form-body">
                                <h4 class="form-section" style="margin-top: 10px"><i class="fas fa-newspaper"></i>Poll Edit</h4>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput5">Poll Status *</label>
                                            <?php
                                                $pol_status = array(
                                                    1 => 'Normal',
                                                    0 => 'Inactive',
                                                    2 => 'Hide'
                                                );
                                                $pol_sts = $row-> pol_status;
                                                echo form_dropdown('pol_status', $pol_status,$pol_sts,'class="form-control"');
                                             ?>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Poll Title *</label>
                                            
                                            <?php echo form_input('pol_title',set_value('pol_title', $row-> pol_title),'class="form-control"'); ?>
                                            <small class="text-danger" style="font-size: 11px">
                                                <?php if(form_error('pol_title')){ echo form_error('pol_title',); } ?>
                                            </small>
                                        </div>
                                    </div>
             
                                </div>
                                <!--- END OF CLASS ROW ---->
                        
                               
                                <!--- END OF CLASS ROW ---->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Starting Date *</label>
                                            <?php
                                               echo form_input(array('type' => 'date', 'class'=>'form-control', 'id'=>"pol_start_date" , 'value' => $row-> pol_start_date , 'name' => "pol_start_date" ));
                                            ?>
                                            <small class="text-danger" style="font-size: 11px">
                                                <?php if(form_error('pol_start_date')){ echo form_error('pol_start_date'); } ?>
                                            </small>
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Ending Date *</label>
                                            <?php
                                                echo form_input(array('type' => 'date', 'class'=>'form-control', 'id'=>"pol_end_date" , 'value' => $row-> pol_end_date , 'name' => "pol_end_date" ));
                                            ?>
                                            <small class="text-danger" style="font-size: 11px">
                                                <?php if(form_error('pol_end_date')){ echo form_error('pol_end_date'); } ?>
                                            </small>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <?php } endforeach; ?>
                            
                            <?php
                                $pol_id=$this->uri->segment(3); 
                                echo form_hidden('news_id',$pol_id);
                                echo form_hidden('tbl_name','pol_info');	
                            ?>
                        
                            <div class="form-actions">
                                <?php echo form_reset('sign_in ', 'Refresh','class="btn btn-raised btn-raised btn-warning mr-1"'); ?>
                                <?php echo form_submit('upload', 'Save','class="btn btn-raised btn-raised btn-primary"'); ?>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                <?php }
                else{?>
                    <div class="px-3">
                        <?php echo form_open_multipart('Admin/PollEntry'); ?>
                            <div class="form-body">
                                <h4 class="form-section" style="margin-top: 10px"><i class="fas fa-newspaper"></i>Poll Enrty</h4>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput5">Poll Status *</label>
                                            <?php
                                                $pol_status = array(
                                                    1 => 'Normal',
                                                    0 => 'Inactive',
                                                    2 => 'Hide'
                                                );
                                                echo form_dropdown('pol_status', $pol_status,'','class="form-control"');
                                                
                                             ?>
                                           
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Poll Title *</label>
                                            
                                            <?php echo form_input('pol_title', set_value(''),'class="form-control"'); ?>
                                            <small class="text-danger" style="font-size: 11px">
                                                <?php if(form_error('pol_title')){ echo form_error('pol_title',); } ?>
                                            </small>
                                        </div>
                                    </div>
             
                                </div>
                                <!--- END OF CLASS ROW ---->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Starting Date *</label>
                                            <?php
                                               echo form_input(array('type' => 'date', 'id'=>"pol_start_date" , 'value' => $starting_date['value'] , 'name' => "pol_start_date",'class'=>"form-control" ));
                                            ?>
                                            <small class="text-danger" style="font-size: 11px">
                                                <?php if(form_error('pol_start_date')){ echo form_error('pol_start_date'); } ?>
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Ending Date *</label>
                                            <?php
                                                echo form_input(array('type' => 'date','id'=>"pol_end_date" , 'value' => $starting_date['value'] , 'name' => "pol_end_date", 'class'=>"form-control" ));
                                            ?>
                                            <small class="text-danger" style="font-size: 11px">
                                                <?php if(form_error('pol_end_date')){ echo form_error('pol_end_date'); } ?>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                echo form_hidden('tbl_id','pol_id');
					            echo form_hidden('tbl_name','pol_info');	
                            ?>
                        
                            <div class="form-actions">
                                <?php echo form_reset('sign_in ', 'Refresh','class="btn btn-raised btn-raised btn-warning mr-1"'); ?>
                                <?php echo form_submit('upload', 'Save','class="btn btn-raised btn-raised btn-primary"'); ?>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
</div>