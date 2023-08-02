<?php 
    $status = array(1 => 'Active', 0 => 'Inactive');
	// $galleryType 	= array(''=> 'Select One', 1 => 'Gallery', 2 => 'Document');
?>
<div class="content-wrapper">
<section id="basic-form-layouts">
  
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">

                    <?php
                        if($news_gallery_edit){ ?>
                            <div class="px-3">
                            <?php echo form_open_multipart('Admin/EditGallery/'.$img_id); ?>
                                <div class="form-body">
                                <?php foreach($news_gallery_edit as $row): { ?>
                                    <h4 class="form-section" style="margin-top: 10px"><i class="fas fa-newspaper"></i>Gallery Edit</h4>

                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="projectinput1">Image Caption *</label>
                                                
                                                <?php echo form_input('img_caption',set_value('img_caption', $row-> img_caption),'class="form-control"'); ?>
                                                <small class="text-danger" style="font-size: 11px">
                                                    <?php if(form_error('img_caption')){ echo form_error('img_caption',); } ?>
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput5">Status *</label>
                                                <?php
                                                    $sts = $row->gallery_status;
                                                    echo form_dropdown('gallery_status', $status,$sts,'class="form-control"');
                                                ?>
                                                <small class="text-danger" style="font-size: 11px">
                                                    <?php if(form_error('gallery_status')){ echo form_error('gallery_status'); } ?>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <!--- END OF CLASS ROW ---->

                                    <h4 class="form-section"><i class="ft-file-text"></i> Galley Image Upload </h4>
                                    <div class="row">
                            
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="projectinput1">Image Upload *</label>
                                                <!-- <input type="file" class="form-control-file" id="projectinput8"> -->
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
                                    <!--- END OF CLASS ROW ---->
                                    
                    
                                </div>
                                <?php
                                    }
                                    endforeach;
                                ?>
                                <?php
                                   $img_id=$this->uri->segment(3); /*** Indicate the segment number 3 ***/
                                    echo form_hidden('img_id',$img_id);
                                    echo form_hidden('tbl_name','news_gallery_info');	// controller a hidden data pathanu hoise (Table Name) //
                                ?>
                            
                                <div class="form-actions">
                                    <?php echo form_reset('sign_in ', 'Refresh','class="btn btn-raised btn-raised btn-warning mr-1"'); ?>
                                    <?php echo form_submit('upload', 'Save','class="btn btn-raised btn-raised btn-primary"'); ?>
                                </div>
                            <?php echo form_close(); ?>
                        </div>
                    <?php  }


                    else{ ?>
                    <div class="px-3">
                        <?php echo form_open_multipart('Admin/GallerySetup'); ?>
                            <div class="form-body">
                                <h4 class="form-section" style="margin-top: 10px"><i class="fas fa-newspaper"></i>Gallery Setup</h4>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="projectinput1" class="text-info">Image Caption *</label>
                                            
                                            <?php echo form_input('img_caption', set_value('img_caption'),'class="form-control"'); ?>
                                            <small class="text-danger" style="font-size: 11px">
                                                <?php if(form_error('img_caption')){ echo form_error('img_caption',); } ?>
                                            </small>
                                            
                                        
                                        </div>
                                    </div>
                                </div>
                                <!--- END OF CLASS ROW ---->

                                <h4 class="form-section"><i class="ft-file-text"></i> Galley Image Upload </h4>
                                <div class="row">
                        
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="projectinput1" class="text-info">Image Upload *</label> <br>
                                            <!-- <input type="file" class="form-control-file" id="projectinput8"> -->
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
                                <!--- END OF CLASS ROW ---->
                                <?php
                                    echo form_hidden('gallery_status', 1,'','class="form-control"');
                                ?>

                            </div>
                            <?php
                                echo form_hidden('tbl_id','img_id');		
                                echo form_hidden('tbl_name','news_gallery_info');
                            ?>
                        
                            <div class="form-actions" style="width: 100%; text-align: center">
                                <?php echo form_reset('reset', 'Refresh','class="btn btn-raised btn-raised btn-warning mr-1"'); ?>
                                <?php echo form_submit('upload', 'Upload','class="btn btn-raised btn-raised btn-primary"'); ?>
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