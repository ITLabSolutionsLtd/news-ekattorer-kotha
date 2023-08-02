<div class="content-wrapper">
    <section id="basic-form-layouts">
        <div class="row">
            <div class="col-sm-12">
                <div class="content-header">Opinion Module</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <div class="px-3">
                            <?php echo form_open_multipart('Admin/OpinionEntry'); ?>
                            <?php echo form_hidden('page_id',''); ?>
                            <?php echo form_hidden('cat_id', 5); ?>
                            <?php echo form_hidden('sub_cat_id', ''); ?>
                            <div class="form-body">
                                <h4 class="form-section text-primary" style="margin-top: 10px"><i class="fa fa-pencil"></i>Opinion setup</h4>
            

                                <div class="row">
                                
                                    <?php if ($user_type == 7 || $user_type == 5 || $user_type == 3) { ?>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Status <span class="compulsory-tag">*</span> </label>
                                                <?php
                                                $news_status = array(
                                                    5 => 'Normal',
                                                    1 => 'Lead News',
                                                    2 => 'Top News',
                                                    6 => 'Selective News',
                                                    0 => 'Inactive',
                                                );
                                                echo form_dropdown('news_status', $news_status, '', 'class="form-control select2" required ="required"');

                                                ?>
                                                <small class="text-danger" style="font-size: 11px">
                                                    <?php if (form_error('news_status')) {
                                                        echo form_error('news_status');
                                                    } ?>
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>News Caption</label>
                                                <?php echo form_input('news_caption', set_value(''), 'class="form-control" autocomplete="off" '); ?>
                                            </div>
                                        </div>
                                    <?php
                                    } else {
                                        form_hidden('news_status', '');
                                    }
                                    ?>

                                </div>
                                <!--- END OF CLASS ROW ---->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Head Line <span class="compulsory-tag">*</span></label>
                                            <?php echo form_input('news_headline', set_value('news_headline'), 'class="form-control" required ="required"'); ?>
                                            <small class="text-danger" style="font-size: 11px">
                                                <?php if (form_error('news_headline')) {
                                                    echo form_error('news_headline');
                                                } ?>
                                            </small>


                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label> Sub Head Line </label>
                                            <?php echo form_input('news_sub_headline', set_value('news_sub_headline'), 'class="form-control"'); ?>

                                        </div>
                                    </div>
                                </div>
                                <!--- END OF CLASS ROW ---->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Opinion Writter </label>
                                            <select class="form-control aut select2" name="news_author[]" tabindex="-1" aria-hidden="true">
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
                                            <label>Opinion Desk </label>
                                            <?php echo form_input('news_reporter', set_value('news_reporter'), 'class="form-control rep"'); ?>
                                        </div>
                                    </div>
                                </div>

                                <?php echo form_hidden('news_source', ''); ?>
                                <?php echo form_hidden('news_source_link', ''); ?>
                                <?php echo form_hidden('video_link', ''); ?>
                                <?php echo form_hidden('video_caption', ''); ?>
                                <?php echo form_hidden('audio_link', ''); ?>
                                <?php echo form_hidden('audio_caption',''); ?>


                                <!--- END OF CLASS ROW ---->
                                <h4 class="form-section text-info"><i class="ft-file-text"></i>News Description</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label> Opinion Description <span class="text-warning"> (Briefly) </span> </label>
                                            <?php 
                                                $textarea = array(
                                                    'name'  =>  'news_details_brief',
                                                    'value' =>  set_value('news_details_brief'),
                                                    'rows'  =>  '2',
                                                    'class' =>  'form-control'
                                                ); 
                                            ?>
                                            <?php echo form_textarea($textarea); ?>
                                        </div>
                                    </div>
                                </div>
                                <!--- END OF CLASS ROW ---->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label> Opinion Details <span class="compulsory-tag">*</span></label>
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
                                            <label> News Area </label>
                                            <?php echo form_input('news_area', set_value(''), 'class="form-control"'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label> News area zone </label>
                                            <?php echo form_input('news_zone', set_value(''), 'class="form-control"'); ?>
                                        </div>
                                    </div>

                                </div>
                                <!--- END OF CLASS ROW ---->

                                <h4 class="form-section"><i class="ft-file-text"></i> Tag </h4>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Opinion Tag </label>
                                            <?php echo form_input('news_tag', '', ' class="form-control tokenfield1"'); ?>
                                        </div>
                                    </div>
                                </div>
                                <!--- END OF CLASS ROW ---->


                                <h4 class="form-section text-primary"><i class="ft-image"></i> File </h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Image <span class="text-warning"> (Size : 720×480p) </span> </label>
                                            <?php
                                            $Fdata = array('name' => 'user_avatar', 'class' => 'form-control');
                                            echo form_upload($Fdata);
                                            ?>
                                        </div>
                                    </div>


                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label> Caption </label>
                                            <?php echo form_input('img_caption', set_value(''), 'class="form-control"'); ?>
                                        </div>
                                    </div>
                                </div>
                                <!--- END OF CLASS ROW ---->

                                <h4 class="form-section text-primary"><i class="fa fa-signal"></i> SEO Settings </h4>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Title </label>
                                            <?php echo form_input('news_seo_title', set_value(''), 'class="form-control"'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Keyword </label>
                                            <?php echo form_input('news_seo_keyword', set_value(''), 'class="form-control tokenfield2"'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label> Description <span class="text-warning">(Briefly)</span> </label>
                                            <?php 
                                                $seo_des = array(
                                                    'name'  =>  'news_seo_description',
                                                    'value' =>  set_value('news_seo_description'),
                                                    'rows'  =>  '2',
                                                    'class' =>  'form-control'
                                                ); 
                                            ?>
                                            <?php echo form_textarea($seo_des); ?>
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