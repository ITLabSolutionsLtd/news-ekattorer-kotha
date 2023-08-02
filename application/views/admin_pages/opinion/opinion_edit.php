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
                                <?php echo form_open_multipart('Admin/EditOpinionEntry/' . $news_id); ?>
                                <?php echo form_hidden('page_id',''); ?>
                                <?php echo form_hidden('cat_id', 5); ?>
                                <?php echo form_hidden('sub_cat_id', ''); ?>
                                
                                <?php
                                foreach ($news_edit as $row) : {
                                ?>
                                        <div class="form-body">
                                            <h4 class="form-section text-info" style="margin-top: 10px"><i class="fa fa-edit"></i>Edit News</h4>

                                            <div class="row">
                                                <?php if ($user_type == 7 || $user_type == 5 || $user_type == 3) { ?>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Status <span class="compulsory-tag">*</span></label>
                                                            <?php
                                                                $news_status = array(
                                                                    5 => 'Normal',
                                                                    1 => 'Lead News',
                                                                    2 => 'Top News',
                                                                    6 => 'Selective News',
                                                                    0 => 'Inactive'
                                                                );
                                                                echo form_dropdown('news_status', $news_status, $row->news_status, 'class="form-control select2"');
                                                            ?>
                                                        </div>
                                                    </div>
                                                <?php } ?>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label >Opinion Caption</label>
                                                        <?php echo form_input('news_caption', stripslashes($row->headline_tag), 'class="form-control" autocomplete="off"'); ?>
                                                    </div>
                                                </div>



                                            </div>
                                            <!--- END OF CLASS ROW ---->

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Headline <span class="compulsory-tag">*</span></label>
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
                                                        <label> Sub Headline </label>
                                                        <?php echo form_input('news_sub_headline', stripslashes($row->news_sub_headline), 'class="form-control"'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label >Author</label>

                                                        <select class="form-control aut select2" name="news_author" tabindex="-1" aria-hidden="true">
                                                            <option value="">Select One</option>
                                                            <?php
                                                                foreach ($writerList as $item){ ?>
                                                                    <option value="<?php echo $item->writer_id ?>" <?php if(isset($writerInfo)) echo in_array($item->writer_id, $writerInfo)?'selected':'' ?> ><?php echo $item->writer_name ?> </option>
                                                                <?php }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label ><?php if($cat_id == 5) echo 'Opinion Writer Desk'; else echo 'Reporter Desk'?> </label>
                                                        <?php 
                                                            if(isset($reporterInfo->reporter_ids)){
                                                                $reporter_data = $reporterInfo->reporter_ids;
                                                            }
                                                            else{
                                                                $reporter_data = '';
                                                            }
                                                            echo form_input('news_reporter', set_value('news_reporter', $reporter_data), 'class="form-control rep"'); 
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--- END OF CLASS ROW ---->



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
                                                        <label> News Description (Brief) </label>
                                                        <?php $news_details_brief = strip_tags(html_entity_decode($row->news_details_brief));  ?>
                                                        <?php 
                                                            $descrip = array(
                                                                'name'  =>  'news_details_brief',
                                                                'value' =>  stripslashes($news_details_brief),
                                                                'rows'  =>  '2',
                                                                'class' =>  'form-control'
                                                            ); 
                                                        ?>
                                                        <?php echo form_textarea($descrip); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--- END OF CLASS ROW ---->

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Opinion Details <span class="compulsory-tag">*</span></label>
                                                        <?php
                                                        $details = strip_tags($row->news_details, "<table><tr><td><th><h1><h2><h3><h3><h5><h5><b><i><br><u><strong><img><a><p><span><blockquote>");
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
       

                                            <h4 class="form-section text-info"><i class="ft-file-text"></i> File </h4>
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label >Image </label>
                                                        <?php
                                                        $Fdata = array('name' => 'user_avatar', 'class' => 'form-control');
                                                        echo form_upload($Fdata);
                                                        ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label> Caption </label>
                                                        <?php echo form_input('img_caption', set_value('img_caption', stripslashes($row->img_caption)), 'class="form-control"'); ?>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Opinion Tag </label>
                                                        <?php echo form_input('news_tag', $row->news_tag, 'class="form-control tokenfield1"'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                  

                                            <h4 class="form-section text-info"><i class="ft-file-text"></i> SEO Settings </h4>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label >Title </label>
                                                        <?php echo form_input('news_seo_title', set_value('news_seo_title', stripslashes($row->seo_title)), 'class="form-control"'); ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label >Keyword </label>
                                                        <?php echo form_input('news_seo_keyword', set_value('news_seo_keyword', $row->seo_keyword), 'class="form-control tokenfield2"'); ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label> Description </label>
                                                        <?php $new_seo_details = strip_tags(html_entity_decode($row->seo_description)); ?>
                                                        <?php 
                                                            $seo_descrip = array(
                                                                'name'  =>  'news_seo_description',
                                                                'value' =>  stripslashes($new_seo_details),
                                                                'rows'  =>  '2',
                                                                'class' =>  'form-control'
                                                            ); 
                                                        ?>
                                                        <?php echo form_textarea($seo_descrip); ?>
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