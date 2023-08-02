<div class="content-wrapper">
    <section id="basic-form-layouts">
        <div class="row">
            <div class="col-sm-12">
                <div class="content-header">News Module</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <div class="px-3">
                            <?php echo form_open_multipart(base_url('news-upload')); ?>
                            <div class="form-body">
                                <h4 class="form-section" style="margin-top: 10px"><i class="fas fa-newspaper"></i>News setup</h4>
                                

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="projectinput5">Category <span class="compulsory-tag">*</span></label>
                                            <?php
                                                echo form_dropdown('cat_id', $category_info, '', 'class="form-control cat"  required="required"');
                                            ?>
                                            <small class="text-danger" style="font-size: 11px">
                                                <?php if (form_error('cat_id')) {
                                                    echo form_error('cat_id');
                                                } ?>
                                            </small>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="projectinput6">Sub Category</label>
                                            <select name="sub_cat_id" class="form-control subcat">
                                                <option value="">Select one</option>
                                            </select>
                                        </div>
                                    </div>

    
                                    <?php if ($user_type == 7 || $user_type == 5 || $user_type == 3) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="projectinput5">Status <span class="compulsory-tag">*</span> </label>
                                                <?php
                                                $news_status = array(
                                                    '' => 'Select One',
                                                    5 => 'Normal',
                                                    0 => 'Inactive',
                                                    1 => 'Lead News',
                                                    2 => 'Top News',
                                                    6 => 'Selective News',
                                                    7 => 'Breaking'

                                                );
                                                echo form_dropdown('news_status', $news_status, set_value('news_status'), 'class="form-control" required="required"');

                                                ?>
                                                <small class="text-danger" style="font-size: 11px">
                                                    <?php if (form_error('news_status')) {
                                                        echo form_error('news_status');
                                                    } ?>
                                                </small>
                                            </div>
                                        </div>
                                    <?php
                                    } else {
                                        form_hidden('news_status', '');
                                    }
                                    ?>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="projectinput6">Type  <span class="compulsory-tag">*</span> </label>
                                            <?php echo form_dropdown('news_type', $type_info, set_value('news_type'), 'class="form-control" required="required"'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="projectinput6">News Caption</label>
                                            <?php echo form_input('news_caption', set_value('news_caption'), 'class="form-control"'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="projectinput6">News Page</label>
                                            <?php
                                                echo form_dropdown('page_id', $pageList, set_value('page_id'), 'class="form-control" ');
                                            ?>
                                        </div>
                                    </div>

                                </div>
                                <!--- END OF CLASS ROW ---->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="projectinput1">Head Line <span class="compulsory-tag">*</span></label>
                                            <?php echo form_input('news_headline', set_value('news_headline'), 'class="form-control" required="required"'); ?>
                                            <small class="text-danger" style="font-size: 11px">
                                                <?php if (form_error('news_headline')) {
                                                    echo form_error('news_headline');
                                                } ?>
                                            </small>


                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="projectinput2"> Sub Head Line </label>
                                            <?php echo form_input('news_sub_headline', set_value('news_sub_headline'), 'class="form-control"'); ?>

                                        </div>
                                    </div>
                                </div>
                                <!--- END OF CLASS ROW ---->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Reporter </label>

                                            <select class="select2 form-control" name="news_author[]" multiple tabindex="-1" aria-hidden="true">
                                                <option value="">Select One</option>
                                                <?php
                                                    foreach ($writerList as $item){ ?>
                                                        <option value="<?php echo $item->writer_id ?>" ><?php echo $item->writer_name ?> </option>
                                                    <?php }
                                                ?>
                                            </select>
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Others source </label>
                                            <?php echo form_input('news_reporter', set_value('news_reporter'), 'class="form-control reporter_auto"'); ?>
                                        </div>
                                    </div>
                                </div>

                                <h4 class="form-section"><i class="ft-file-text"></i> News Source </h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Source </label>
                                            <?php echo form_input('news_source', set_value('news_source'), 'class="form-control"'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput2"> Source Link </label>
                                            <?php echo form_input('news_source_link', set_value('news_source_link'), 'class="form-control"'); ?>
                                        </div>
                                    </div>


                                </div>
                                <h4 class="form-section"><i class="ft-file-text"></i> Video Source </h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput2"> Video link </label>
                                            <?php echo form_input('video_link', set_value('video_link'), 'class="form-control"'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput2"> Video Caption </label>
                                            <?php echo form_input('video_caption', set_value('video_caption'), 'class="form-control"'); ?>
                                        </div>
                                    </div>
                                </div>
                                <!--- END OF CLASS ROW ---->
                                <!-- <h4 class="form-section"><i class="ft-file-text"></i> Audio Source </h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput2"> Audio link </label>
                                            <?php echo form_input('audio_link', set_value(''), 'class="form-control"'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput2"> Audio Caption </label>
                                            <?php echo form_input('audio_caption', set_value(''), 'class="form-control"'); ?>
                                        </div>
                                    </div>
                                </div> -->


                                <!--- END OF CLASS ROW ---->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="projectinput2"> News Description (Brief) </label>
                                            <?php 
                                                $text_data = array(
                                                    'name'        => 'news_details_brief',
                                                    'value'       => set_value('news_details_brief'),
                                                    'rows'        => '2',
                                                    'cols'        => '10',
                                                    'class'       => 'form-control'
                                                );
                                                echo form_textarea($text_data);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <!--- END OF CLASS ROW ---->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="projectinput2"> News Details <span class="compulsory-tag">*</span></label>
                                            <?php echo form_textarea('news_details', set_value(''), 'id="editor1" class="form-control"'); ?>
                                            <small class="text-danger" style="font-size: 11px">
                                                <?php if (form_error('news_details')) {
                                                    echo form_error('news_details');
                                                } ?>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <!--- END OF CLASS ROW ---->

                                <div class="row" style="display: none;">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="projectinput2"> News Area </label>
                                            <?php echo form_input('news_area', set_value(''), 'class="form-control"'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="projectinput2"> News area zone </label>
                                            <?php echo form_input('news_zone', set_value(''), 'class="form-control"'); ?>
                                        </div>
                                    </div>

                                </div>
                                <!--- END OF CLASS ROW ---->

                                <h4 class="form-section" style="display: none;"><i class="ft-file-text"></i> Tag </h4>

                                <div class="row" >
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Tag </label>
                                            <?php echo form_input('news_tag', '', 'class="form-control tokenfield1"'); ?>
                                        </div>
                                    </div>
                                </div>
                                <!--- END OF CLASS ROW ---->


                                <h4 class="form-section"><i class="ft-file-text"></i> File </h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="projectinput1">Image (Ratio : 720×480p) </label>
                                            <?php
                                            $Fdata = array('name' => 'user_avatar', 'class' => 'form-control');
                                            echo form_upload($Fdata);
                                            ?>
                                        </div>
                                    </div>


                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="projectinput2"> Caption </label>
                                            <?php echo form_input('img_caption', set_value(''), 'class="form-control"'); ?>
                                        </div>
                                    </div>
                                </div>
                                <!--- END OF CLASS ROW ---->

                                <h4 class="form-section"><i class="ft-file-text"></i> SEO Settings </h4>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Title </label>
                                            <?php echo form_input('news_seo_title', set_value(''), 'class="form-control"'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Keyword </label>
                                            <?php echo form_input('news_seo_keyword', set_value(''), 'class="form-control tokenfield2"'); ?>
                                        </div>
                                    </div>

                                    

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="projectinput2"> Description </label>
                                            <?php 
                                                $text_seo_data = array(
                                                    'name'        => 'news_seo_description',
                                                    'value'       => set_value('news_seo_description'),
                                                    'rows'        => '2',
                                                    'cols'        => '10',
                                                    'class'       => 'form-control',
                                                    'maxlength'   => "200"
                                                );
                                                echo form_textarea($text_seo_data);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <!--- END OF CLASS ROW ---->
                            </div>
                            <?php
                            echo form_hidden('user_type', $user_type);
                            echo form_hidden('tbl_id', 'news_id');            // controller a hidden data pathanu hoise
                            echo form_hidden('tbl_name', 'news_common_info');    // controller a hidden data pathanu hoise (Table Name) //
                            echo form_hidden('latestStatus', '');
                            echo form_hidden('catLead', '');
                            ?>

                            <div class="form-actions">
                                <?php echo form_reset('sign_in ', 'Refresh', 'class="btn btn-raised btn-raised btn-warning mr-1"'); ?>
                                <?php echo form_submit('upload', 'Save', 'class="btn btn-raised btn-raised btn-primary"'); ?>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</div>