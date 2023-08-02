<style>
    body.layout-dark label {
        color: #e9e9e9;
        margin-bottom: 0;
        font-weight: 100;
    }
    .file{
        padding: 2px;
    }
    form .form-group {
        margin-bottom: 0.8rem;
    }
</style>
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">
                <?php if($news_add_edit){?>

                    <div class="px-3">
                        <?php echo form_open_multipart('Admin/SetAdSlot/'.$position_id); ?>
                            <div class="form-body">
                            <?php foreach($news_add_edit as $row): { ?>
                                <h4 class="form-section" style="margin-top: 10px"><i class="fas fa-newspaper"></i>Advertise Edit</h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="projectinput5">Category *</label>
                                            <?php
                                                $cat_value=$row->cat_id;
                                                echo form_dropdown('cat_id', $category_info,$cat_value,'class="form-control"');
                                             ?>
                                
                                        </div>
                                    </div>
                        
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="projectinput5">Ad Status *</label>
                                            <?php 
                                                $add_status = array(
                                                    1 => 'Normal',
                                                    0 => 'Inactive',
                                                    2 => 'Hide'
                                                );
                                                $ad_sts = $row->add_status;
                                                echo form_dropdown('add_status', $add_status, $ad_sts, 'class="form-control"'); 
                                            ?>
                                             <small class="text-danger" style="font-size: 11px">
                                                <?php if(form_error('add_status')){ echo form_error('add_status',); } ?>
                                            </small>
                                        </div>
                                    </div>

                                   
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="projectinput5">Ad Size *</label>
                                            <?php 
                                                $ad_sizes = array(
                                                    1 => 'Banner (468x60)',
                                                    2 => 'Leaderboard (728×90)',
                                                    3 => 'Rectangle (300×250)',
                                                );
                                                if($user_type == 7){
                                                    $editable = '';
                                                }
                                                else{
                                                    $editable = 'disable';
                                                }
                                                echo form_dropdown('add_size', $ad_sizes, $row->ad_size, 'class="form-control" required "'.$editable.'"'); 
                                            ?>
                                            <small class="text-danger" style="font-size: 11px">
                                                <?php if(form_error('add_size')){ echo form_error('add_size',); } ?>
                                            </small>
                                        </div>
                                    </div>
                                        

            

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Add Title *</label>
                                            
                                            <?php echo form_input('add_title', set_value('add_title', $row-> add_title),'class="form-control"'); ?>
                                            <small class="text-danger" style="font-size: 11px">
                                                <?php if(form_error('add_title')){ echo form_error('add_title',); } ?>
                                            </small> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput2"> Ad Link </label>
                                            <?php echo form_input('add_link',set_value('add_link', $row-> add_link),'class="form-control"'); ?>  
                                        </div>
                                    </div>
                        
                                 
                                </div>
                                <!--- END OF CLASS ROW ---->
                        
                                <div class="row">
                                    
                        
                                    

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Starting Date *</label>
                                            <?php
                                                echo form_input(array('type' => 'date', 'src' => '../../images/date_picker/cal.gif','id'=>"add_start_date" ,'value' => $row-> add_start_date  ,'class' => "form-control", 'name' => "add_start_date",'onclick' => "javascript:NewCssCal('add_start_date')" ));
                                            ?>
                                            <small class="text-danger" style="font-size: 11px">
                                                <?php if(form_error('add_start_date')){ echo form_error('add_start_date'); } ?>
                                            </small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Ending Date *</label>
                                            <?php
                                                echo form_input(array('type' => 'date', 'src' => '../../images/date_picker/cal.gif','id'=>"add_end_date" , 'value' => $row-> add_end_date  , 'class'=>"form-control",  'name' => "add_end_date",'onclick' => "javascript:NewCssCal('add_end_date')" ));
                                            ?>
                                            <small class="text-danger" style="font-size: 11px">
                                                <?php if(form_error('add_end_date')){ echo form_error('add_end_date'); } ?>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <!--- END OF CLASS ROW ---->

                                <h4 class="form-section"><i class="ft-file-text"></i> File </h4>
                                <div class="row">
                        
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Image Upload </label>
                                            <!-- <input type="file" class="form-control-file" id="projectinput8"> -->
                                            <?php 
                                                $Fdata = array('name' => 'user_avatar', 'class' => 'file');
						                        echo form_upload($Fdata);  
                                            ?>
                                        </div>
                                    </div>
                        
                                </div>
                                <!--- END OF CLASS ROW ---->
                            <?php } endforeach; ?>
                            </div>
                            <?php
                                $add_id=$this->uri->segment(3); /*** Indicate the segment number 3 ***/
                                echo form_hidden('add_id',$add_id);
                                echo form_hidden('tbl_name','add_info');
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
                        <?php echo form_open_multipart('Admin/AdSetup'); ?>
                            <div class="form-body">
                                <h4 class="form-section" style="margin-top: 10px"><i class="fas fa-newspaper"></i>Advertise Enrty</h4>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="projectinput5">Category <span class="text-warning">(If Applicable)</span></label>
                                            <?php
                                                echo form_dropdown('cat_id', $category_info,set_value('cat_id'),'class="form-control" ');
                                                
                                             ?>
                                            <small class="text-danger" style="font-size: 11px">
                                                <?php if(form_error('cat_id')){ echo form_error('cat_id'); } ?>
                                            </small>
                                        </div>
                                    </div>
                        
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="projectinput5">Ad Status *</label>
                                            <?php 
                                                $add_status = array(
                                                    1 => 'Normal',
                                                    0 => 'Inactive',
                                                    2 => 'Hide'
                                                );
                                                echo form_dropdown('add_status', $add_status, '', 'class="form-control" required'); 
                                            ?>
                                             <small class="text-danger" style="font-size: 11px">
                                                <?php if(form_error('add_status')){ echo form_error('add_status',); } ?>
                                            </small>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="projectinput5">Ad Size *</label>
                                            <?php 
                                                $ad_sizes = array(
                                                    1 => 'Banner (468x60)',
                                                    2 => 'Leaderboard (728×90)',
                                                    3 => 'Rectangle (300×250)',
                                                );
                                                echo form_dropdown('add_size', $ad_sizes, '', 'class="form-control" required'); 
                                            ?>
                                             <small class="text-danger" style="font-size: 11px">
                                                <?php if(form_error('add_size')){ echo form_error('add_size',); } ?>
                                            </small>
                                        </div>
                                    </div>

                                    
                        
                                 
                                </div>
                                <!--- END OF CLASS ROW ---->
                        
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="projectinput1">Add Title *</label>
                                            <?php echo form_input('add_title', set_value('add_title'),'class="form-control" required'); ?>
                                            <small class="text-danger" style="font-size: 11px">
                                                <?php if(form_error('add_title')){ echo form_error('add_title',); } ?>
                                            </small>
                                        </div>
                                    </div>        
                                
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="projectinput2"> Ad Link </label>
                                            <?php echo form_input('add_link', set_value('add_link'),'class="form-control"'); ?>  
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label> Position </label>
                                            <?php echo form_input('position', set_value('position'),'class="form-control" required'); ?>  
                                        </div>
                                    </div>
                                </div>
                                <!--- END OF CLASS ROW ---->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Starting Date *</label>
                                            <?php
                                                echo form_input(array('type' => 'date', 'id'=>"add_start_date" , 'value' => $starting_date['value'] ,'class' => "form-control", 'name' => "add_start_date",'onclick' => "javascript:NewCssCal('add_start_date')", 'required' => "required" ));
                                            ?>
                                            <small class="text-danger" style="font-size: 11px">
                                                <?php if(form_error('add_start_date')){ echo form_error('add_start_date'); } ?>
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Ending Date *</label>
                                            <?php
                                                echo form_input(array('type' => 'date','id'=>"add_end_date" , 'value' => $ending_date['value'] , 'class'=>"form-control",  'name' => "add_end_date",'onclick' => "javascript:NewCssCal('add_end_date')" ,'required' => "required" ));
                                            ?>
                                            <small class="text-danger" style="font-size: 11px">
                                                <?php if(form_error('add_end_date')){ echo form_error('add_end_date'); } ?>
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <h4 class="form-section"><i class="ft-file-text"></i> File </h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="projectinput1">Image Upload </label>
                                            <!-- <input type="file" class="form-control-file" id="projectinput8"> -->
                                            <?php 
                                                $Fdata = array('name' => 'user_avatar', 'class' => 'form-control file', 'required' => "required");
						                        echo form_upload($Fdata);  
                                            ?>
                                        </div>
                                    </div>
                        
                                </div>
                                <!--- END OF CLASS ROW ---->
                            </div>
                            <?php
                                echo form_hidden('tbl_id','add_id');			// controller a hidden data pathanu hoise
					            echo form_hidden('tbl_name','add_info');
                            ?>
                        
                            <div class="form-actions border-top-0 mt-0">
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