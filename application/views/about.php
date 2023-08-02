<link rel="stylesheet" href="<?php echo base_url('assets/css/about-style.css') ?>">

<div class="popup gee-popup">
    <div class="popup-inner">
        <a class="close-button popup-close-button">
            &times;
        </a>
        <div class="popup-header">
            <h3 class="popup-title"></h3>
        </div>

    </div>
</div>

<div id='image'>
    <img style="width: 100%; max-height: 450px" src="https://99designs-blog.imgix.net/blog/wp-content/uploads/2017/01/neiman_marcus.gif?auto=format&q=60&fit=max&w=930" alt="">
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="title-tag">
                <h3><i class="fa fa-fire"></i> সম্পাদক মণ্ডলী</h3>
            </div>
        </div>

        <?php
        if ($secetary_info) {
            foreach ($secetary_info as $row) { ?>

                <div class=" col-sm-6 col-lg-3 ">
                    <div class="single_advisor_profile wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                        <!-- Team Thumb-->
                        <?php
                        if ($row->img_ext) {
                            $img = base_url() . 'images/member/thumb/' . $row->id . $row->img_ext;
                        } else {
                            $img = 'https://icon-library.com/images/default-user-icon/default-user-icon-4.jpg';
                        }
                        ?>
                        <div class="advisor_thumb"><img class="member-img" src="<?php echo $img; ?>" alt="">
                            <div class="social-info">
                                <a href="tel:<?php echo $row->member_phone; ?>" onclick="playSound();">
                                    <i class="fa fa-phone"></i>
                                </a>
                                <a href="mailto:<?php echo $row->member_email ?>"><i class="fa fa-envelope"></i></a>
                            </div>
                        </div>
                        <!-- Team Details-->
                        <div class="single_advisor_details_info">
                            <h6><strong><?php echo $row->member_name; ?></strong></h6>
                            <p class="designation"><?php echo $row->member_designation; ?></p>
                            <p class="designation"><?php if ($row->member_phone) echo '<i class="fa fa-phone "> ' . $row->member_phone ?></i></p>
                            <p class="designation"><?php if ($row->member_email) echo '<i class="fa fa-envelope "> ' . $row->member_email ?></i></p>

                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="title-tag">
                <h3><i class="fa fa-fire"></i> রিপোর্টিং</h3>
            </div>
        </div>

        <?php
        if ($reporter_info) {
            $count = 0;
            foreach ($reporter_info as $row) {
                $count++;

        ?>

                <div class="col-sm-6 col-lg-3">
                    <div class="single_advisor_profile wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                        <!-- Team Thumb-->
                        <?php
                        if ($row->img_ext) {
                            $img = base_url() . 'images/member/thumb/' . $row->id . $row->img_ext;
                        } else {
                            $img = 'https://icon-library.com/images/default-user-icon/default-user-icon-4.jpg';
                        }
                        ?>
                        <div class="advisor_thumb"><img class="member-img" src="<?php echo $img; ?>" alt="">
                            <div class="social-info">
                                <a href="tel:<?php echo $row->member_phone; ?>" onclick="playSound();">
                                    <i class="fa fa-phone"></i>
                                </a>
                            </div>
                        </div>
                        <!-- Team Details-->
                        <div class="single_advisor_details_info">
                            <h6><strong><?php echo $row->member_name; ?></strong></h6>
                            <p class="designation"><?php echo $row->member_designation; ?></p>
                            <p class="designation"><?php if ($row->member_phone) echo '<i class="fa fa-phone "> ' . $row->member_phone ?></i></p>
                            <p class="designation"><?php if ($row->member_email) echo '<i class="fa fa-envelope "> ' . $row->member_email ?></i></p>

                        </div>
                    </div>
                </div>
                <?php if ($isMobile) {
                    if ($count % 2 == 0) {
                        echo '<div class="row"></div>';
                    }
                } ?>
        <?php
            }
        }
        ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="title-tag">
                <h3><i class="fa fa-fire"></i> ফটো সেকশন</h3>
            </div>
        </div>

        <?php
        if ($photo_section_info) {
            foreach ($photo_section_info as $row) { ?>

                <div class="col-sm-6 col-lg-3 ">
                    <div class="single_advisor_profile wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                        <!-- Team Thumb-->
                        <?php
                        if ($row->img_ext) {
                            $img = base_url() . 'images/member/thumb/' . $row->id . $row->img_ext;
                        } else {
                            $img = 'https://icon-library.com/images/default-user-icon/default-user-icon-4.jpg';
                        }
                        ?>
                        <div class="advisor_thumb"><img class="member-img" src="<?php echo $img; ?>" alt="">
                            <div class="social-info">
                                <a href="tel:<?php echo $row->member_phone; ?>" onclick="playSound();">
                                    <i class="fa fa-phone"></i>
                                </a>
                                <a href="mailto:<?php echo $row->member_email ?>"><i class="fa fa-envelope"></i></a>
                            </div>
                        </div>
                        <!-- Team Details-->
                        <div class="single_advisor_details_info">
                            <h6><strong><?php echo $row->member_name; ?></strong></h6>
                            <p class="designation"><?php echo $row->member_designation; ?></p>
                            <p class="designation"><?php if ($row->member_phone) echo '<i class="fa fa-phone "> ' . $row->member_phone ?></i></p>
                            <p class="designation"><?php if ($row->member_email) echo '<i class="fa fa-envelope "> ' . $row->member_email ?></i></p>

                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="title-tag">
                <h3><i class="fa fa-fire"></i> অফিস স্টাফ</h3>
            </div>
        </div>

        <?php
        if ($office_staff_info) {
            foreach ($office_staff_info as $row) { ?>

                <div class=" col-sm-6 col-lg-3">
                    <div class="single_advisor_profile wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                        <!-- Team Thumb-->
                        <?php
                        if ($row->img_ext) {
                            $img = base_url() . 'images/member/thumb/' . $row->id . $row->img_ext;
                        } else {
                            $img = 'https://icon-library.com/images/default-user-icon/default-user-icon-4.jpg';
                        }
                        ?>
                        <div class="advisor_thumb"><img class="member-img" src="<?php echo $img; ?>" alt="">
                            <div class="social-info">
                                <a href="tel:<?php echo $row->member_phone; ?>" onclick="playSound();">
                                    <i class="fa fa-phone"></i>
                                </a>
                                <a href="mailto:<?php echo $row->member_email ?>"><i class="fa fa-envelope"></i></a>
                            </div>
                        </div>
                        <!-- Team Details-->
                        <div class="single_advisor_details_info">
                            <h6><strong><?php echo $row->member_name; ?></strong></h6>
                            <p class="designation"><?php echo $row->member_designation; ?></p>
                            <p class="designation"><?php if ($row->member_phone) echo '<i class="fa fa-phone "> ' . $row->member_phone ?></i></p>
                            <p class="designation"><?php if ($row->member_email) echo '<i class="fa fa-envelope "> ' . $row->member_email ?></i></p>

                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</div>