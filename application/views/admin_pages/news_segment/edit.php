<style>
    #bg-show, #bg_color, #bg_image{
        display: none; 
    }
</style>
<div class="content-wrapper">
    <section id="basic-form-layouts">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="content-header">NEWS SEGMENT</div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="content-header text-right"> <a class="btn btn-sm btn-warning" href="<?php echo base_url('news-segment'); ?>"> Segment List  </a> </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <div class="px-3">
                            <?php echo form_open_multipart('edit-news-segment/'.$edit_data->segment_id); ?>
                                <div class="form-body">
                                    <h4 class="form-section text-primary" style="margin-top: 10px">News Segment Edit</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Title <span class="text-danger">*</span> </label>
                                                <?php echo form_input('segment_title', set_value('segment_title', $edit_data->segment_title),'class="form-control" maxlength="100" required'); ?>
                                                <small class="text-danger" style="font-size: 11px"> <?php if(form_error('segment_title')){ echo form_error('segment_title'); } ?> </small>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="invisible w-100">show</label>
                                                <input class="form-check-input" style="margin-top: 2.3rem; accent-color: #009da0;" type="checkbox" name="segment_title_show" id="c1" <?php if($edit_data->segment_title_show == 1) echo 'checked'; ?> >
                                                <label class="form-check-label form-control " for="c1">
                                                    Show Title
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Segment Tag <span class="text-danger">*</span> <span class="text-warning"> (Max: 50)</span> </label>
                                                <?php echo form_input('segment_tag', set_value('segment_tag', $edit_data->segment_tag),'class="form-control" maxlength="50" required'); ?>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-info">SEO Information </h6>
                                            <hr class="mt-0 mb-2">
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Title <span class="text-danger">*</span> </label>
                                                <?php echo form_input('segment_seo_title', set_value('segment_seo_title', $edit_data->segment_seo_title),'class="form-control" maxlength="100" '); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label>Keyword </label>
                                                <?php echo form_input('segment_seo_keyword', set_value('segment_seo_keyword', $edit_data->segment_seo_keywords), 'class="form-control tokenfield2"'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label> Description </label>
                                                <?php 
                                                    $text_seo_data = array(
                                                        'name'        => 'segment_seo_details', 'value'=> set_value('segment_seo_details', $edit_data->segment_seo_details), 'rows' => '2', 'cols' => '10','class' => 'form-control', 'maxlength' => "200"
                                                    );
                                                    echo form_textarea($text_seo_data);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-info">Banner & Date Range </h6>
                                            <hr class="mt-0 mb-2">
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" style="accent-color: #009da0;" type="checkbox" name="banner_show" id="imggg"  <?php if($edit_data->banner_show == 1) echo 'checked'; ?>>
                                                    <label class="form-check-label " for="imggg"> Banner <span class="text-warning">(Max: 100KB)</span></small> </label>
                                                </div>
                                                <?php
                                                    $Fdata = array('name' => 'user_avatar', 'class' => 'form-control', 'id' => 'input');
                                                    echo form_upload($Fdata);
                                                ?>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Start Date <span class="text-danger">*</span> </label>
                                                <input type="date" class="form-control" name="start_date" value="<?= $edit_data->segment_start_date; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>End Date <span class="text-danger">*</span> </label>
                                                <input type="date" class="form-control" name="end_date" value="<?= $edit_data->segment_end_date; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" class="form-control select2" >
                                                    <option value="">Select One</option>
                                                    <option value="1" <?php if($edit_data->status == 1) echo 'selected'; ?>>Active </option>
                                                    <option value="0" <?php if($edit_data->status == 0) echo 'selected'; ?>>In-Active</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" >
                                        <div class="col-md-12">
                                            <h6 class="text-info">Background Information </h6>
                                            <hr class="mt-0 mb-2">
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" onchange="valueChanged()" style="accent-color: #009da0;" type="checkbox" name="segment_bg_status" id="c2" <?php if($edit_data->segment_bg_status == 1) echo 'checked'; ?> >
                                                <label class="form-check-label " for="c2">
                                                    Background ?
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="bg-show" <?php if($edit_data->segment_bg_status == 1) echo 'style="display: flex"; '; ?>>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Background Type</label>
                                                <select name="bg_type" id="bg_option" class="form-control select2" onchange="showDiv(this)" <?php if($edit_data->segment_bg_status == 1) echo 'required'; ?>>
                                                    <option value="">Select One</option>
                                                    <option value="1" <?php if($edit_data->segment_bg_type == 1) echo 'selected'; ?>>Image Background </option>
                                                    <option value="2" <?php if($edit_data->segment_bg_type == 2) echo 'selected'; ?>>Static Background</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Title Color</label>
                                                <input type="color" class="form-control" name="title_color" value="<?php echo $edit_data->segment_title_color; ?>" >
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Headline Color</label>
                                                <input type="color" class="form-control" name="headline_color" value="<?php echo $edit_data->segment_headline_color; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" style="accent-color: #009da0;" type="checkbox" name="news_subheadline_status" id="c3" <?php if($edit_data->segment_details_status == 1) echo 'checked'; ?> >
                                                    <label class="form-check-label " for="c3"> Subheadline </label>
                                                </div>
                                                <input type="color" class="form-control" name="subheadline_color" value="<?php echo $edit_data->segment_details_color; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" style="accent-color: #009da0;" type="checkbox" name="news_time_status" id="c4"  <?php if($edit_data->segment_time_status == 1) echo 'checked'; ?>>
                                                    <label class="form-check-label " for="c4"> News Time </label>
                                                </div>
                                                <input type="color" class="form-control" name="news_time" value="<?php echo $edit_data->segment_time_color; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Hover Color</label>
                                                <input type="color" class="form-control" name="hover_color" value="<?php echo $edit_data->segment_link_hover; ?>" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" id="bg_image" <?php if($edit_data->segment_bg_type == 1) echo 'style="display: flex"'; ?> >
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Background Image <span class="text-warning">(Max: 150KB)</span></small></label><br>
                                                <?php
                                                    $Fdata = array('name' => 'user_avatar_2', 'class' => 'form-control', 'id' => 'input2');
                                                    echo form_upload($Fdata);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Border Color</label>
                                                <input type="color" class="form-control" name="bg_bottom_color_img" value="<?php echo $edit_data->segment_bg_border; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="bg_color" <?php if($edit_data->segment_bg_type == 2) echo 'style="display: flex"'; ?>>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Background Color</label>
                                                <input type="color" class="form-control" name="bg_color" value="<?php echo $edit_data->segment_bg_color; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Border Color</label>
                                                <input type="color" class="form-control" name="bg_bottom_color" value="<?php echo $edit_data->segment_bg_border; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <hr>
                                        </div>
                                        <div class="col-md-12 text-right">
                                            <button type="submit" class="btn btn-raised btn-warning btn-lg"> Update </button>
                                        </div>
                                    </div>

                                </div>
                                <?php echo form_hidden('tbl_name', 'news_segment'); ?>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

