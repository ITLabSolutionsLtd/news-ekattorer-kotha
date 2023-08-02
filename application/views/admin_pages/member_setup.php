<?php
$status = array(1 => 'Active', 0 => 'Inactive');
// $galleryType 	= array(''=> 'Select One', 1 => 'Gallery', 2 => 'Document');
?>
<div class="content-wrapper">
    <section id="basic-form-layouts">
        <div class="row">
            <div class="col-sm-12">
                <div class="content-header">HR Module</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <?php
                        if ($member_info) {
                            foreach ($member_info as $row) { ?>
                                <div class="px-3">
                                    <?php echo form_open_multipart('Admin/EditMember/' . $id); ?>
                                    <div class="form-body">
                                        <h4 class="form-section" style="margin-top: 10px"><i class="fas fa-user-circle"></i>Member Edit</h4>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1">Name *</label>

                                                    <?php echo form_input('mem_name', $row->member_name, 'class="form-control"'); ?>
                                                    <small class="text-danger" style="font-size: 11px">
                                                        <?php if (form_error('mem_name')) {
                                                            echo form_error('mem_name',);
                                                        } ?>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1">Designation *</label>

                                                    <?php echo form_input('mem_designation', $row->member_designation, 'class="form-control"'); ?>
                                                    <small class="text-danger" style="font-size: 11px">
                                                        <?php if (form_error('mem_designation')) {
                                                            echo form_error('mem_designation',);
                                                        } ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1">Email </label>
                                                    <?php echo form_input('mem_email', $row->member_email, 'class="form-control"'); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1">Phone </label>
                                                    <?php echo form_input('mem_phone', $row->member_phone, 'class="form-control"'); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1">Group </label>
                                                    <?php
                                                    $group_by = array(
                                                        '' => 'Please select',
                                                        1 => 'Secretary',
                                                        2 => 'Reporter',
                                                        3 => 'Photo Section',
                                                        4 => 'Office Staff',

                                                    );
                                                    echo form_dropdown('mem_group', $group_by, $row->member_group, 'class="form-control"');
                                                    ?>
                                                    <small class="text-danger" style="font-size: 11px">
                                                        <?php if (form_error('mem_group')) {
                                                            echo form_error('mem_group',);
                                                        } ?>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="projectinput1">Status </label>
                                                <?php
                                                $status = array(
                                                    
                                                    1 => 'Active',
                                                    0 => 'Inactive',
                                                    

                                                );
                                                echo form_dropdown('mem_status', $status, $row->status, 'class="form-control"');
                                                ?>
                                            </div>
                                        </div>
                                        <!--- END OF CLASS ROW ---->

                                        <h4 class="form-section"><i class="ft-file-text"></i> Profile Image </h4>
                                        <div class="row">

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="projectinput1">File *</label>
                                                    <!-- <input type="file" class="form-control-file" id="projectinput8"> -->
                                                    <?php
                                                    $Fdata = array('name' => 'user_avatar', 'class' => 'file');
                                                    echo form_upload($Fdata);
                                                    ?>

                                                </div>
                                            </div>

                                        </div>
                                        <!--- END OF CLASS ROW ---->

                                    </div>

                                    <?php
                                    // $img_id=$this->uri->segment(3); 
                                    /*** Indicate the segment number 3 ***/
                                    echo form_hidden('id', $id);
                                    echo form_hidden('tbl_name', 'member_info');    // controller a hidden data pathanu hoise (Table Name) //

                                    ?>

                                    <div class="form-actions">
                                        <?php echo form_reset('reset', 'Refresh', 'class="btn btn-raised btn-raised btn-warning mr-1"'); ?>
                                        <?php echo form_submit('upload', 'Set', 'class="btn btn-raised btn-raised btn-primary"'); ?>
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            <?php
                            }
                        } else { ?>
                            <div class="px-3">
                                <?php echo form_open_multipart('Admin/MemberSetup'); ?>
                                <div class="form-body">
                                    <h4 class="form-section" style="margin-top: 10px"><i class="fas fa-user-circle"></i>Member Setup</h4>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Name *</label>

                                                <?php echo form_input('mem_name', set_value(''), 'class="form-control"'); ?>
                                                <small class="text-danger" style="font-size: 11px">
                                                    <?php if (form_error('mem_name')) {
                                                        echo form_error('mem_name',);
                                                    } ?>
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Designation *</label>

                                                <?php echo form_input('mem_designation', set_value(''), 'class="form-control"'); ?>
                                                <small class="text-danger" style="font-size: 11px">
                                                    <?php if (form_error('mem_designation')) {
                                                        echo form_error('mem_designation',);
                                                    } ?>
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Email </label>
                                                <?php echo form_input('mem_email', set_value(''), 'class="form-control"'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Phone </label>
                                                <?php echo form_input('mem_phone', set_value(''), 'class="form-control"'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Group </label>
                                                <?php
                                                $group_by = array(
                                                    '' => 'Please select',
                                                    1 => 'Secretary',
                                                    2 => 'Reporter',
                                                    3 => 'Photo Section',
                                                    4 => 'Office Staff',

                                                );
                                                echo form_dropdown('mem_group', $group_by, '', 'class="form-control"');
                                                ?>
                                                <small class="text-danger" style="font-size: 11px">
                                                    <?php if (form_error('mem_group')) {
                                                        echo form_error('mem_group',);
                                                    } ?>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <!--- END OF CLASS ROW ---->

                                    <h4 class="form-section"><i class="ft-file-text"></i> Profile Image </h4>
                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">File *</label>
                                                <!-- <input type="file" class="form-control-file" id="projectinput8"> -->
                                                <?php
                                                $Fdata = array('name' => 'user_avatar', 'class' => 'file');
                                                echo form_upload($Fdata);
                                                ?>

                                            </div>
                                        </div>

                                    </div>
                                    <!--- END OF CLASS ROW ---->

                                </div>
                                <?php
                                echo form_hidden('tbl_id', 'id');
                                echo form_hidden('tbl_name', 'member_info');
                                ?>

                                <div class="form-actions">
                                    <?php echo form_reset('reset', 'Refresh', 'class="btn btn-raised btn-raised btn-warning mr-1"'); ?>
                                    <?php echo form_submit('upload', 'Set', 'class="btn btn-raised btn-raised btn-primary"'); ?>
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