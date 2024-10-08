<?php
    $sub_cat_name	= ($this-> input-> post('subcat_name')) ? $this-> input-> post('subcat_name') : '';
	$subcat_key_name	= ($this-> input-> post('subcat_key_name')) ? $this-> input-> post('subcat_key_name') : '';
	$cat_name	= ($this-> input-> post('cat_name')) ? $this-> input-> post('cat_name') : '';
?>
<div class="content-wrapper">
<section id="basic-form-layouts">
    <div class="row">
        <div class="col-sm-12">
        <div class="content-header">Category Module</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">
                    
                    <div class="px-3">
                    
                        <?php echo form_open_multipart('Admin/SubcatInsert'); ?>
                            <div class="form-body">
                                <h4 class="form-section" style="margin-top: 10px"><i class="fas fa-newspaper"></i>News Category Setup</h4>
                                <?php
                                    $message = $this->session->userdata('message');
                                    if($message){?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">  <?php      
                                                echo "<span class='alert alert-success ml-3 mt-3'>$message</span>";
                                                $this->session->unset_userdata('message');
                                        ?> </div> 
                                        </div>
                                    </div>
                                    <?php
                                    }
                                ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput2">Sub-Category (Bangla)* :</label>
                                            <?php echo form_input('subcat_name', $sub_cat_name,'class="form-control" '); ?>
                                            <small class="text-danger" style="font-size: 11px">
                                                <?php if(form_error('subcat_name')){ echo form_error('subcat_name',); } ?>
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Sub-Category (English)* :</label>
                                            <?php echo form_input('subcat_key_name', $subcat_key_name,'class=" form-control " tabindex="2" '); ?>
                                            <small class="text-danger" style="font-size: 11px">
                                                <?php if(form_error('subcat_key_name')){ echo form_error('subcat_key_name',); } ?>
                                            </small>

                                        </div>
                                    </div>
                                </div>
                                <!--- END OF CLASS ROW ---->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput2">Select Category * :</label>
                                        
                                            <?php echo form_dropdown('cat_name',$category_info,$cat_name,'class="form-control"')?>
                                            <small class="text-danger" style="font-size: 11px">
                                                <?php if(form_error('cat_name')){ echo form_error('cat_name',); } ?>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <!--- END OF CLASS ROW ---->

                            </div>
                            <?php
                                echo form_hidden('tbl_id','subcat_id');
                                echo form_hidden('tbl_name','sub_category_info');
                            ?>
                        
                            <div class="form-actions">   
                                <?php echo form_reset('reset', 'Refresh','class="btn btn-raised btn-raised btn-warning mr-1"'); ?>
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