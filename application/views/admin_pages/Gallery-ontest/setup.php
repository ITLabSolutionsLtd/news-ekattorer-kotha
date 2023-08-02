<style>
.gallery_records{
    width:100%;
    padding: 10px;
    background: #2c2e46;
}
.remove{
    width:100%;
    padding: 10px;
    background: #2c2e46;
}
.file{
    padding: 2px; 
}
</style>
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
                        <div class="px-3">
                            <?php echo form_open_multipart('Admin/GallerySetup'); ?>
                                <div class="form-body">
                                    <h4 class="form-section text-info" style="margin-top: 10px"><i class="fas fa-image"></i>Gallery Setup</h4>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="projectinput1">Title *</label>
                                                <?php echo form_input('title', set_value(''),'class="form-control" required'); ?>
                                                <small class="text-danger" style="font-size: 11px">
                                                    <?php if(form_error('title')){ echo form_error('title',); } ?>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="projectinput1">Sub Title</label>
                                                <textarea name="sub_title" cols="12" rows="3" maxlength="255" class="form-control"></textarea>
                                                <small class="text-danger" style="font-size: 11px">
                                                    <?php if(form_error('sub_title')){ echo form_error('sub_title',); } ?>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="gallery_records" style="width: 100%">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a class="btn btn-success text-white btn-sm extra-fields-customer" >Add <small><i class="fa fa-plus"></i></small></a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="file" name="file" class="form-control file" placeholder="Image" required>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="image_caption"  class="form-control" maxlength="50" placeholder="Caption">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea name="image_des" cols="12" rows="3" class="form-control" placeholder="Short Descrition"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <input name="customer_email"  > -->
                                    </div>
                                    <div class="gallery_records_dynamic"></div>  
                                </div>
                                <?php
                                    echo form_hidden('tbl_id','img_id');		
                                    echo form_hidden('tbl_name','news_gallery_info');
                                ?>
                                <div class="form-actions">
                                    <?php echo form_reset('reset', 'Refresh','class="btn btn-raised btn-raised btn-warning mr-1"'); ?>
                                    <?php echo form_submit('upload', 'Upload','class="btn btn-raised btn-raised btn-primary"'); ?>
                                </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>