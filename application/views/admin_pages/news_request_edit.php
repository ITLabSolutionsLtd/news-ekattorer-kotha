<div class="content-wrapper">
    <section id="basic-form-layouts">
        <div class="row">
            <div class="col-sm-12">
            <div class="content-header">Approval Module</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <div class="px-3">
                            <?php echo form_open_multipart('Admin/NewsApproveUpdate/'.$news_id); ?>
                                <div class="form-body">
                                    <h4 class="form-section" style="margin-top: 10px"><i class="fas fa-newspaper"></i>Update Approval Request</h4>

                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="projectinput5">News Status *</label>
                                                <?php echo form_hidden('news_id', $news_id);?>
                                                <?php 
                                                    $news_status = array(
                                                        ''=> 'Please select',
                                                        5 => 'Normal',
                                                        0 => 'Inactive',
                                                        1 => 'Lead News',
                                                        2 => 'Top News',
                                                        6 => 'Selective News',
                                                        10 => 'Live Update'
                                                        //3 => 'Breaking News',
                                                        // 4 => 'Hide'
                                                    );
                                                    echo form_dropdown('news_status', $news_status, '', 'class="form-control" required="required"'); 
                                                    
                                                ?>
                                                <!--<small class="text-danger" style="font-size: 11px">-->
                                                <!--    <?php //if(form_error('news_status')){ echo form_error('news_status'); } ?>-->
                                                <!--</small>-->
                                            
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!--- END OF CLASS ROW ---->

                                </div>
                                
                            
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