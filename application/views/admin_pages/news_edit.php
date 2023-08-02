<div class="content-wrapper">
    <section id="basic-form-layouts">
        <div class="row">
            <div class="col-sm-12">
                <?php
                if ($cat_id == '5') {
                    echo '<div class="content-header">Opinion Module</div>';
                } else {
                    echo '<div class="content-header">News Module</div>';
                }

                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">

                        <?php
                        if (isset($news_edit)) { ?>

                            <div class="px-3">
                                <?php echo form_open_multipart('Admin/EditNewsEntry/' . $news_id); ?>
                                <?php
                                foreach ($news_edit as $row) : {
                                ?>
                                        <div class="form-body">
                                            <h4 class="form-section" style="margin-top: 10px"><i class="fa fa-edit"></i>Edit News</h4>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput5">Category <span class="compulsory-tag">*</span></label>
                                                        <?php
                                                        if(isset($row->cat_id))
                                                            $news_category = $row->cat_id;
                                                        else
                                                            $news_category = '';
        
                                                        echo form_dropdown('cat_id', $category_info, $news_category, 'class="form-control cat"');
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
                                                            <?php if ($sub_category_info) {
                                                                echo form_dropdown('sub_cat_id', $sub_category_info, $row->sub_cat_id, ' onclick="ClearInput()" class="form-control subcat"  ');
                                                            }else{ ?>
                                                                <select name="sub_cat_id" class="form-control subcat">
                                                                    <option value="">Select one</option>
                                                                </select>
                                                            <?php } ?>
                                                    </div>
                                                </div>

                                                

                                                <?php if ($user_type == 7 || $user_type == 5 || $user_type == 3) { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput5">Status <span class="compulsory-tag">*</span></label>
                                                            <?php
                                                            if($cat_id == 5){
                                                                $news_status = array(
                                                              
                                                                    5 => 'Normal',
                                                                    0 => 'Inactive',
                                                                    

                                                                );
                                                            }
                                                            else{
                                                                $news_status = array(
                                                                    '' => 'Select one',
                                                                    5 => 'Normal',
                                                                    0 => 'Inactive',
                                                                    1 => 'Lead News',
                                                                    2 => 'Top News',
                                                                    6 => 'Selective News',
                                                                    7 => 'Breaking',

                                                                );
                                                            }
                                                            echo form_dropdown('news_status', $news_status, $row->news_status, 'class="form-control"');

                                                            ?>
                                                            <small class="text-danger" style="font-size: 11px">
                                                                <?php if (form_error('news_status')) {
                                                                    echo form_error('news_status',);
                                                                } ?>
                                                            </small>
                                                        </div>
                                                    </div>
                                                <?php } ?>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput6">Type  <span class="compulsory-tag">*</span> </label>
                                                        <?php echo form_dropdown('news_type', $type_info, set_value('news_type', $row->news_type), 'class="form-control" required="required"'); ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput6">News Caption</label>
                                                        <?php echo form_input('news_caption', stripslashes($row->headline_tag), 'class="form-control"'); ?>
                                                    </div>
                                                </div>

                                                

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput6">News Page</label>
                                                        <?php
                                                            echo form_dropdown('page_id', $pageList, set_value('page_id', $row->page_id), 'class="form-control" ');
                                                        ?>
                                                    </div>
                                                </div>



                                            </div>
                                            <!--- END OF CLASS ROW ---->

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1">Head Line <span class="compulsory-tag">*</span></label>
                                                        <?php echo form_input('news_headline', stripslashes($row->news_headline), 'class="form-control"'); ?>
                                                        <small class="text-danger" style="font-size: 11px">
                                                            <?php if (form_error('news_headline')) {
                                                                echo form_error('news_headline',);
                                                            } ?>
                                                        </small>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput2"> Sub Head Line </label>
                                                        <?php echo form_input('news_sub_headline', stripslashes($row->news_sub_headline), 'class="form-control"'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">Author</label>

                                                        <select class="select2 form-control" name="news_author[]" multiple tabindex="-1" aria-hidden="true">
                                                            <option value="">Select One</option>
                                                            <?php
                                                                foreach ($writerList as $item){ ?>
                                                                    <option value="<?php echo $item->writer_id ?>" <?php if(isset($writerInfo)) echo in_array($item->writer_id, $writerInfo)?'selected':'' ?> ><?php echo $item->writer_name ?> </option>
                                                                <?php }
                                                                // echo form_dropdown('news_author[]', $writerList, $writerInfo, 'class="form-control select2"  multiple="multiple"');
                                                            ?>
                                                        </select>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"><?php if($cat_id == 5) echo 'Opinion Writer Desk'; else echo 'Reporter Desk'?> </label>
                                                        <?php 
                                                            if(isset($reporterInfo->reporter_ids)){
                                                                $reporter_data = $reporterInfo->reporter_ids;
                                                            }
                                                            else{
                                                                $reporter_data = '';
                                                            }
                                                            echo form_input('news_reporter', set_value('news_reporter', $reporter_data), 'class="form-control reporter_auto"'); 
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--- END OF CLASS ROW ---->



                                            <h4 class="form-section"><i class="ft-file-text"></i>Source</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">Source </label>
                                                        <?php echo form_input('news_source', set_value('news_source', $row->news_source), 'class="form-control"'); ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2"> Source Link </label>
                                                        <?php echo form_input('news_source_link', set_value('news_source_link', $row->news_source_link), 'class="form-control"'); ?>
                                                    </div>
                                                </div>


                                            </div>
                                            <h4 class="form-section"><i class="ft-file-text"></i>Video Source</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2"> Video link </label>
                                                        <?php echo form_input('video_link', set_value('video_link', $row->video_link), 'class="form-control"'); ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2"> Video Caption </label>
                                                        <?php echo form_input('video_caption', set_value('video_caption', stripslashes($row->video_caption)), 'class="form-control"'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4 class="form-section"><i class="ft-file-text"></i>Audio</h4>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2"> Audio link </label>
                                                        <?php echo form_input('audio_link', set_value('audio_link', $row->audio_link), 'class="form-control"'); ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2"> Audio Caption </label>
                                                        <?php echo form_input('audio_caption', set_value('audio_caption', stripslashes($row->audio_caption)), 'class="form-control"'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--- END OF CLASS ROW ---->


                                            <!--- END OF CLASS ROW ---->
                                            <h4 class="form-section"><i class="ft-file-text"></i>News Description</h4>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput2"> News Description (Brief) </label>
                                                        <?php $news_details_brief = strip_tags(html_entity_decode($row->news_details_brief));  ?>
                                                        <?php echo form_textarea('news_details_brief', set_value('news_details_brief', stripslashes($news_details_brief)), 'class="form-control"'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--- END OF CLASS ROW ---->

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput2">News Details <span class="compulsory-tag">*</span></label>
                                                        <?php
                                                        $details = strip_tags($row->news_details, "<table><tr><td><th><h1><h2><h3><h3><h5><h5><b><i><br><u><strong><img><a><p><span><blockquote>");
                                                        // $details = $row->news_details;
                                                        $details_news =  stripslashes($details);
                                                        ?>
                                                        <?php echo form_textarea('news_details', $details_news, ' id="editor1"class="form-control"'); ?>
                                                        <small class="text-danger" style="font-size: 11px">
                                                            <?php if (form_error('news_details')) {
                                                                echo form_error('news_details',);
                                                            } ?>
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--- END OF CLASS ROW ---->


                                            <!--- END OF CLASS ROW ---->



                                            <div class="row" style="display: none;">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput2">News Area</label>
                                                        <?php echo form_input('news_area', set_value('news_area', $row->news_area), 'class="form-control"'); ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput2">News Zone </label>
                                                        <?php echo form_input('news_zone', set_value('news_zone', $row->news_zone), 'class="form-control"'); ?>
                                                    </div>
                                                </div>

                                            </div>
                                            <!--- END OF CLASS ROW ---->

                                            <h4 class="form-section"><i class="ft-file-text"></i> Tag </h4>

                                            <div class="row" >
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">News tag </label>
                                                        <?php echo form_input('news_tag', $row->news_tag, 'class="form-control tokenfield1"'); ?>
                                                    </div>
                                                </div>



                                            </div>
                                            <!--- END OF CLASS ROW ---->


                                            <h4 class="form-section"><i class="ft-file-text"></i> File </h4>
                                            <div class="row">

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput1">Image </label>
                                                        <?php
                                                        $Fdata = array('name' => 'user_avatar', 'class' => 'form-control');
                                                        echo form_upload($Fdata);
                                                        ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2"> Caption </label>
                                                        <?php echo form_input('img_caption', set_value('img_caption', stripslashes($row->img_caption)), 'class="form-control"'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--- END OF CLASS ROW ---->

                                            <h4 class="form-section"><i class="ft-file-text"></i> SEO Settings </h4>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">Title </label>
                                                        <?php echo form_input('news_seo_title', set_value('news_seo_title', stripslashes($row->seo_title)), 'class="form-control"'); ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">Keyword </label>
                                                        <?php echo form_input('news_seo_keyword', set_value('news_seo_keyword', $row->seo_keyword), 'class="form-control tokenfield2"'); ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput2"> Description </label>
                                                        <?php $new_seo_details = strip_tags(html_entity_decode($row->seo_description)); ?>
                                                        <?php echo form_textarea('news_seo_description', set_value('news_seo_description', stripslashes($new_seo_details)), 'class="form-control"'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--- END OF CLASS ROW ---->
                                        </div>
                                        <?php

                                        echo form_hidden('user_type', $user_type);
                                        echo form_hidden('news_id', $news_id);
                                        echo form_hidden('tbl_name', 'news_common_info');    // controller a hidden data pathanu hoise (Table Name) //
                                        echo form_hidden('latestStatus', '');
                                        echo form_hidden('catLead', '');
                                        ?>
                                <?php }
                                endforeach;
                                ?>
                                <div class="form-actions">
                                    <?php echo form_reset('', 'Reset', 'class="btn btn-raised btn-raised btn-warning mr-1"'); ?>
                                    <?php echo form_submit('upload', 'Update', 'class="btn btn-raised btn-raised btn-primary"'); ?>
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