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
                            <?php echo form_open_multipart('add-news-segment'); ?>
                                <div class="form-body">
                                    <h4 class="form-section" style="margin-top: 10px">News Segment Setup</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Title <span class="text-danger">*</span> </label>
                                                <?php echo form_input('segment_title', set_value('segment_title'),'class="form-control" maxlength="100" required'); ?>
                                                <small class="text-danger" style="font-size: 11px"> <?php if(form_error('segment_title')){ echo form_error('segment_title'); } ?> </small>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="invisible w-100">show</label>
                                                <input class="form-check-input" style="margin-top: 2.3rem; accent-color: #009da0;" type="checkbox" name="segment_title_show" id="c1" checked>
                                                <label class="form-check-label form-control " for="c1">
                                                    Show Title
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Segment Tag <span class="text-danger">*</span> <span class="text-warning"> (Max: 50)</span> </label>
                                                <?php echo form_input('segment_tag', set_value('segment_tag'),'class="form-control" maxlength="50" required'); ?>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-warning">SEO Information </h6>
                                            <hr class="mt-0 mb-2">
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Title <span class="text-danger">*</span> </label>
                                                <?php echo form_input('segment_seo_title', set_value('segment_seo_title'),'class="form-control" maxlength="100" '); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label>Keyword </label>
                                                <?php echo form_input('segment_seo_keyword', set_value('segment_seo_keyword'), 'class="form-control tokenfield2"'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label> Description </label>
                                                <?php 
                                                    $text_seo_data = array(
                                                        'name'        => 'segment_seo_details', 'value'=> set_value('segment_seo_details'), 'rows' => '2', 'cols' => '10','class' => 'form-control', 'maxlength' => "200"
                                                    );
                                                    echo form_textarea($text_seo_data);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-warning">Banner & Date Range </h6>
                                            <hr class="mt-0 mb-2">
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" style="accent-color: #009da0;" type="checkbox" name="banner_show" id="imggg"  checked>
                                                    <label class="form-check-label " for="imggg"> Banner <span class="text-warning">(Max: 100KB)</span></small> </label>
                                                </div>
                                                <?php
                                                    $Fdata = array('name' => 'user_avatar', 'class' => 'form-control', 'id' => 'input');
                                                    echo form_upload($Fdata);
                                                ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Start Date <span class="text-danger">*</span> </label>
                                                <input type="date" class="form-control" name="start_date" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>End Date <span class="text-danger">*</span> </label>
                                                <input type="date" class="form-control" name="end_date" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" >
                                        <div class="col-md-12">
                                            <h6 class="text-warning">Background Information </h6>
                                            <hr class="mt-0 mb-2">
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" onchange="valueChanged()" style="accent-color: #009da0;" type="checkbox" name="segment_bg_status" id="c2">
                                                <label class="form-check-label " for="c2">
                                                    Background ?
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="bg-show">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Background Type</label>
                                                <select name="bg_type" id="bg_option" class="form-control select2" onchange="showDiv(this)" >
                                                    <option value="">Select One</option>
                                                    <option value="1">Image Background </option>
                                                    <option value="2">Static Background</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Title Color</label>
                                                <input type="color" class="form-control" name="title_color">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Headline Color</label>
                                                <input type="color" class="form-control" name="headline_color">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" style="accent-color: #009da0;" type="checkbox" name="news_subheadline_status" id="c3" >
                                                    <label class="form-check-label " for="c3"> Subheadline </label>
                                                </div>
                                                <input type="color" class="form-control" name="subheadline_color">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" style="accent-color: #009da0;" type="checkbox" name="news_time_status" id="c4" >
                                                    <label class="form-check-label " for="c4"> News Time </label>
                                                </div>
                                                <input type="color" class="form-control" name="news_time">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Hover Color</label>
                                                <input type="color" class="form-control" name="hover_color" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" id="bg_image">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Background Image <span class="text-warning">(Max: 150KB)</span></small> </label><br>
                                                <?php
                                                    $Fdata = array('name' => 'user_avatar_2', 'class' => 'form-control', 'id' => 'input2');
                                                    echo form_upload($Fdata);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Border Color</label>
                                                <input type="color" class="form-control" name="bg_bottom_color_img">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="bg_color">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Background Color</label>
                                                <input type="color" class="form-control" name="bg_color">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Border Color</label>
                                                <input type="color" class="form-control" name="bg_bottom_color">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <hr>
                                        </div>
                                        <div class="col-md-12 text-right">
                                            <button type="submit" class="btn btn-raised btn-success btn-lg"> Create </button>
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

