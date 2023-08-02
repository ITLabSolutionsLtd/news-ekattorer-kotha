<style>
    .note-editor.note-airframe, .note-editor.note-frame {
        background: #ffffff;
    }
    .note-editor .note-toolbar, .note-popover .popover-content {
        border-bottom: 0.5px solid #ddd;
    }
    .note-editor, .note-editor p{
        color: #222; 
    }
</style>
<?php
$starting_date = array(
    'name'    => 'add_start_date',
    'id'    => 'add_start_date',
    'value' => set_value('add_start_date'),
    'maxlength'    => 10,
    'size'    => 30,
);

$ending_date = array(
    'name'    => 'ending_date',
    'id'    => 'ending_date',
    'value' => set_value('ending_date'),
    'maxlength'    => 10,
    'size'    => 30,
);
?>
<div class="content-wrapper">
    <section id="basic-form-layouts">
        <div class="row">
            <div class="col-sm-12">
                <div class="content-header">Writer Module</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <?php
                        if ($get_writer_data) {
                            foreach ($get_writer_data as $row) { ?>
                                <div class="px-3">
                                    <?php echo form_open_multipart('admin/EditWriter/'.$writer_id); ?>
                                    <div class="form-body">
                                        <h4 class="form-section" style="margin-top: 10px"><i class="fas fa-newspaper"></i>Writer Edit</h4>

                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1">Name (BN) *</label>

                                                    <?php echo form_input('writer_name', $row-> writer_name, 'class="form-control"'); ?>
                                                    <small class="text-danger" style="font-size: 11px">
                                                        <?php if (form_error('writer_name')) {
                                                            echo form_error('writer_name',);
                                                        } ?>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1">Name (EN) *</label>

                                                    <?php echo form_input('writer_name_en', $row->writer_name_en, 'class="form-control"'); ?>
                                                    <small class="text-danger" style="font-size: 11px">
                                                        <?php if (form_error('writer_name_en')) {
                                                            echo form_error('writer_name_en',);
                                                        } ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="projectinput5">Writer Type *</label>
                                                    <?php
                                                    $WriterType = array(
                                                        '' => 'Select One',
                                                        1 => 'Reporter',
                                                        2 => 'Opinion Writer',

                                                    );
                                                    echo form_dropdown('writer_type', $WriterType, $row-> writer_type, 'class="form-control"');
                                                    ?>
                                                    <small class="text-danger" style="font-size: 11px">
                                                        <?php if (form_error('writer_type')) {
                                                            echo form_error('writer_type',);
                                                        } ?>
                                                    </small>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1">Writer Designation *</label>
                                                    <?php
                                                        echo form_input('writer_designation', set_value('writer_designation', $row->writer_designation), 'class="form-control"'); 
                                                    ?>
                                                    <small class="text-danger" style="font-size: 11px">
                                                        <?php if (form_error('writer_designation')) {
                                                            echo form_error('writer_designation',);
                                                        } ?>
                                                    </small>
                                                </div>
                                            </div>


                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="projectinput5">Status *</label>
                                                    <?php
                                                    $statustype = array(
                                                        1 => 'active',
                                                        2 => 'Inactive',

                                                    );
                                                    echo form_dropdown('writer_status', $statustype, $row->writer_status, 'class="form-control"');
                                                    ?>
                                                </div>
                                            </div>

                                        </div>
                                        <!--- END OF CLASS ROW ---->

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="projectinput1">Email</label>
                                                    <?php echo form_input('writer_email', $row->writer_email, 'class="form-control"'); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="projectinput1">Contact No.</label>
                                                    <?php echo form_input('writer_contact', $row->writer_contact, 'class="form-control"'); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="projectinput1">Web</label>
                                                    <?php echo form_input('writer_web', $row->writer_web, 'class="form-control"'); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1">Image Upload </label> <br>
                                                    <?php
                                                    $Fdata = array('name' => 'user_avatar', 'class' => 'file');
                                                    echo form_upload($Fdata);
                                                    ?>
                                                    <small class="text-danger" style="font-size: 11px">
                                                        <?php if (form_error('user_avatar')) {
                                                            echo form_error('user_avatar');
                                                        } ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="projectinput2"> Biodata </label>
                                                    <?php echo form_textarea('writer_bio', $row->writer_bio, 'id="summernote" class="form-control"'); ?>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <?php
                                    // echo form_hidden('tbl_id','media_id');
                                    echo form_hidden('writer_id', $writer_id);
                                    echo form_hidden('tbl_name', 'writer_info');
                                    ?>

                                    <div class="form-actions">
                                        <?php echo form_reset('reset ', 'Refresh', 'class="btn btn-raised btn-raised btn-warning mr-1"'); ?>
                                        <?php echo form_submit('upload', 'Save', 'class="btn btn-raised btn-raised btn-primary"'); ?>
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            <?php
                            }
                        } else { ?>
                            <div class="px-3">
                                <?php echo form_open_multipart('admin/writerSetup'); ?>
                                <div class="form-body">
                                    <h4 class="form-section" style="margin-top: 10px"><i class="fas fa-newspaper"></i>New Writer Setup</h4>

                                    <div class="row">
                                        

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Name (EN) *</label>

                                                <?php echo form_input('writer_name_en', set_value('writer_name_en'), 'class="form-control"'); ?>
                                                <small class="text-danger" style="font-size: 11px">
                                                    <?php if (form_error('writer_name_en')) {
                                                        echo form_error('writer_name_en',);
                                                    } ?>
                                                </small>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Name (BN) *</label>

                                                <?php echo form_input('writer_name', set_value('writer_name'), 'class="form-control"'); ?>
                                                <small class="text-danger" style="font-size: 11px">
                                                    <?php if (form_error('writer_name')) {
                                                        echo form_error('writer_name',);
                                                    } ?>
                                                </small>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!--- END OF CLASS ROW ---->

        
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="projectinput5">Writer Type *</label>
                                                <?php
                                                $WriterType = array(
                                                    '' => 'Select One',
                                                    1 => 'Reporter',
                                                    2 => 'Opinion Writer',

                                                );
                                                echo form_dropdown('writer_type', $WriterType, set_value('writer_type'), 'class="form-control"');
                                                ?>
                                                <small class="text-danger" style="font-size: 11px">
                                                    <?php if (form_error('writer_type')) {
                                                        echo form_error('writer_type',);
                                                    } ?>
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="projectinput1">Designation *</label>
                                                <?php echo form_input('writer_designation', set_value('writer_designation'), 'class="form-control"')?>
                                                <small class="text-danger" style="font-size: 11px">
                                                    <?php if (form_error('writer_designation')) {
                                                        echo form_error('writer_designation',);
                                                    } ?>
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="projectinput1">Web</label>
                                                <?php echo form_input('writer_web', set_value('writer_web'), 'class="form-control"'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="projectinput1">Email</label>
                                                <?php echo form_input('writer_email', set_value('writer_email'), 'class="form-control"'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="projectinput1">Contact No.</label>
                                                <?php echo form_input('writer_contact', set_value('writer_contact'), 'class="form-control"'); ?>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Image Upload </label> <br>
                                                <?php
                                                $Fdata = array('name' => 'user_avatar', 'class' => 'file');
                                                echo form_upload($Fdata);
                                                ?>
                                                <small class="text-danger" style="font-size: 11px">
                                                    <?php if (form_error('user_avatar')) {
                                                        echo form_error('user_avatar');
                                                    } ?>
                                                </small>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="projectinput2"> Biodata</label>
                                                <?php echo form_textarea('writer_bio', set_value('writer_bio'), 'id="summernote" class="form-control"'); ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <?php
                                
                                echo form_hidden('tbl_name', 'writer_info');
                                ?>

                                <div class="form-actions">
                                    <?php echo form_reset('reset ', 'Refresh', 'class="btn btn-raised btn-raised btn-warning mr-1"'); ?>
                                    <?php echo form_submit('upload', 'Save', 'class="btn btn-raised btn-raised btn-primary"'); ?>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>