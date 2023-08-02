<style>
    form .form-control {
        border: 1px solid #A6A9AE;
        color: #75787d;
        padding: 3px 5px;
    }
</style>

<div class="content-wrapper">
    <section id="basic-form-layouts">
        <div class="row">
            <div class="col-sm-12">
                <div class="content-header">E-Paper Module</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">

                        <?php
                        if ($get_ePaper_data) {
                            foreach ($get_ePaper_data as $row) { ?>
                                
                                <div class="px-3">
                                    <?php echo form_open_multipart('admin/EditePaper/'.$row->ep_id); ?>
                                    <div class="form-body">
                                        <h4 class="form-section" style="margin-top: 10px"><i class="fas fa-newspaper"></i>ePaper Edit</h4>



                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="projectinput1">Subject *</label>

                                                    <?php echo form_input('ep_subject', $row->ep_subject, 'class="form-control" required="required"'); ?>
                                                    <small class="text-danger" style="font-size: 11px">
                                                        <?php if (form_error('ep_subject')) {
                                                            echo form_error('ep_subject',);
                                                        } ?>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="projectinput1">Date *</label>

                                                    <input type="date" value="<?php echo date('Y-m-d', strtotime($row->ep_date)) ?>" name="ep_date" class="form-control" required="required">

                                                    <small class="text-danger" style="font-size: 11px">
                                                        <?php if (form_error('ep_date')) {
                                                            echo form_error('ep_date',);
                                                        } ?>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="projectinput1">e-paper Thumbnail </label> <br>
                                                    <?php
                                                    $Fdata = array('name' => 'user_avatar', 'value' => '', 'class' => 'form-control file', 'onchange' => "preview()",);
                                                    echo form_upload($Fdata);
                                                    ?>
                                                    <small class="text-danger" style="font-size: 11px">
                                                        <?php if (form_error('user_avatar')) {
                                                            echo form_error('user_avatar');
                                                        } ?>
                                                    </small>
                                                    <script>
                                                        function preview() {
                                                            frame.src = URL.createObjectURL(event.target.files[0]);
                                                        }
                                                    </script>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="projectinput1">Preview </label> <br>
                                                <img id="frame" src="<?php echo base_url('images/epaper/' . $row->ep_id . $row->img_ext) ?>" width="50px" height="50px" />
                                            </div>
                                        </div>



                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1">e-paper File </label> <br>



                                                    <input type="file" name="ep_file" class="form-control" accept="application/pdf,.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" >


                                                    <small class="text-danger" style="font-size: 11px">
                                                        <?php if (form_error('ep_file')) {
                                                            echo form_error('ep_file');
                                                        } ?>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1">e-paper Status </label> <br>
                                                    <select name="ep_status" id="" class="form-control">
                                                        <option value="1" <?php if($row->ep_status == 1) echo 'selected'?>>Enable</option>
                                                        <option value="0" <?php if($row->ep_status == 0) echo 'selected'?>>Disable</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>





                                    </div>
                                    <?php

                                    echo form_hidden('tbl_name', 'epaper_info');
                                    ?>

                                    <div class="form-actions">
                                        <?php echo form_reset('reset ', 'Refresh', 'class="btn btn-raised btn-raised btn-warning mr-1"'); ?>
                                        <?php echo form_submit('upload', 'Update', 'class="btn btn-raised btn-raised btn-primary"'); ?>
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            <?php
                            }
                        } else { ?>

                            <?php
                            $ending_date = array(
                                'name'    => 'ending_date',
                                'id'    => 'ending_date',
                                'value' => date("Y-m-d"),
                                'maxlength'    => 10,
                                'size'    => 30,
                            );
                            ?>
                            <div class="px-3">
                                <?php echo form_open_multipart('admin/ePaperSetup'); ?>
                                <div class="form-body">
                                    <h4 class="form-section" style="margin-top: 10px"><i class="fas fa-newspaper"></i>ePaper Setup</h4>



                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="projectinput1">Subject *</label>

                                                <?php echo form_input('ep_subject', '', 'class="form-control" required="required"'); ?>
                                                <small class="text-danger" style="font-size: 11px">
                                                    <?php if (form_error('ep_subject')) {
                                                        echo form_error('ep_subject',);
                                                    } ?>
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">Date *</label>

                                                <?php
                                                echo form_input(array(
                                                    'type' => 'date', 'value' => $ending_date['value'], 'name' => "ep_date"
                                                ), '', 'class="form-control" required="required"');
                                                ?>
                                                <small class="text-danger" style="font-size: 11px">
                                                    <?php if (form_error('ep_date')) {
                                                        echo form_error('ep_date',);
                                                    } ?>
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">e-paper Thumbnail </label> <br>
                                                <?php
                                                $Fdata = array('name' => 'user_avatar', 'value' => '', 'class' => 'form-control file', 'onchange' => "preview()");
                                                echo form_upload($Fdata);
                                                ?>
                                                <small class="text-danger" style="font-size: 11px">
                                                    <?php if (form_error('user_avatar')) {
                                                        echo form_error('user_avatar');
                                                    } ?>
                                                </small>
                                                <script>
                                                    function preview() {
                                                        frame.src = URL.createObjectURL(event.target.files[0]);
                                                    }
                                                </script>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="projectinput1">Preview </label> <br>
                                            <img id="frame" src="<?php echo base_url('assets/app-assets/img/preview.jpg') ?>" width="50px" height="70px" />
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">e-paper File </label> <br>



                                                <input type="file" name="ep_file" class="form-control" accept="application/pdf,.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required="required">


                                                <small class="text-danger" style="font-size: 11px">
                                                    <?php if (form_error('ep_file')) {
                                                        echo form_error('ep_file');
                                                    } ?>
                                                </small>
                                            </div>
                                        </div>
                                    </div>





                                </div>
                                <?php

                                echo form_hidden('tbl_name', 'epaper_info');
                                ?>

                                <div class="form-actions">
                                    <?php echo form_reset('reset ', 'Refresh', 'class="btn btn-raised btn-raised btn-warning mr-1"'); ?>
                                    <?php echo form_submit('upload', 'Upload', 'class="btn btn-raised btn-raised btn-primary"'); ?>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        <?php }
                        ?>




                    </div>
                </div>
            </div>
        </div>
    </section>
</div>