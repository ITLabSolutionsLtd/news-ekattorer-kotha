<style>
    body.layout-dark .alert p {
        color: #fff !important;
        margin-bottom: 0;
    }
    .image-boxx {
        position: relative;
        margin-top: 15px;
        width: 100%;
        height: 100px;
    }
    .image-boxx .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0);
        transition: background 0.5s ease;
    }
    .image-boxx:hover .overlay {
        display: block;
        background: rgba(0, 0, 0, .3);
    }
    .image-boxx img {
        position: absolute;
        width: 100%;
        height: 100px;
        left: 0;
    }
    .image-boxx .active {
        border: 5px solid green;
    }
    .image-boxx .button {
        position: absolute;
        width: 100%;
        left:0;
        top: 40px;
        text-align: center;
        opacity: 0;
        transition: opacity .35s ease;
    }
    .image-boxx .button a {
        padding: 5px 15px;
        margin: 0 5px;
        text-align: center;
        color: white;
        border: solid 1px white;
        background: #0e0e0eab;
        z-index: 1;
        transition: 0.5s ease;
    }
    .image-boxx .button a:hover {
        background: #000000db; 
        transition: 0.5s ease;
    }
    .image-boxx:hover .button {
        opacity: 1;
    }

</style>
<div class="content-wrapper">
    <section id="basic-form-layouts">
        <div class="row">
            <div class="col-sm-12">
                <div class="content-header">Share Footer Image</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        
                        <div class="card-header">
                            <?php if (isset($error)) { ?>
                                <div class="alert <?php echo $status ?> alert-dismissible mb-2" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <?php echo $error ?>
                                </div>
                            <?php  
                            } ?>
                        </div>
                        <div class="px-3">
                            <?php echo form_open_multipart('Admin/ShareImageSetup'); ?>
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="projectinput1">Select Image* <span class="text-danger"><small> ( IMAGE SIZE : <strong>728x70</strong> )</small></span></label> <br>
                                            <?php
                                                $Fdata = array('name' => 'user_avatar', 'class' => 'file','accept'=> 'image/png', 'id'=>'imgInp' );
                                                echo form_upload($Fdata);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="custom-control-inline custom-switch float-right">
                                            <input type="checkbox" class="switch custom-control-input" id="customSwitch10" value="<?php if($share_image_list->status==1){ echo '1'; } else { echo '0'; } ?>" <?php if($share_image_list->status==1){ echo 'checked'; } else { echo 'unchecked'; } ?>>
                                            <label class="custom-control-label" for="customSwitch10"><span class="text-primary"></span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group text-center">
                                            <?php if($share_image_list->img_ext){ ?>
                                                <img id="blah" src="<?php echo base_url('images/share/'.$share_image_list->share_id.$share_image_list->img_ext)?>" alt="Share Image"  style="width: 728px;  border: 5px dotted #0b0b0f;"/>
                                            <?php } else{ ?>
                                                <img id="blah" src="<?php echo base_url('images/share/share_demo.png')?>" alt="Share Image"  style="width: 728px; height: 70px; border: 5px dotted #0b0b0f;"/>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                echo form_hidden('tbl_name', 'tbl_share');
                            ?>
                            <div class="form-actions text-center">
                                <?php echo form_submit('upload', 'SET', 'class="btn btn-raised btn-raised btn-primary w-25"'); ?>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
            blah.src = URL.createObjectURL(file)
        }
    }
</script>