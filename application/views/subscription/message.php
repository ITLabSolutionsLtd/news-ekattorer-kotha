<link rel="stylesheet" href="<?php echo base_url('assets/web/CSS/message.css')?>">

<?php
    if($message == 'success'){?>
        <div class="message-section">
            <div class="message-section bg-color green ">
                <div class="container">
                    <div class="content-wrapper">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <p>
                                    <h1 class="font arrange-content left-pad">শ্যামল সিলেট এর নিউজলেটার এ <br />আপনাকে স্বাগতম
                                    </h1>
                                </p>
                                <p class="description left-pad"> অনুগ্রহ করে আপনার ই-মেইল ভেরিফাই করুন <br /> ধন্যবাদ.</p>
                                <div class="left-pad">
                                    <a href="<?php echo base_url()?>" class="btn btn-success">প্রচ্ছদ</a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 ">
                                <center>
                                    <img src="<?php echo base_url('assets/web/images/newsletter.jpg')?>" class="hidden-xs hidden-sm laptop arrange-content" alt="evernote image">
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }
    else if($message == 'exist'){?>
        <div class="message-section">
            <div class="message-section bg-color green ">
                <div class="container">
                    <div class="content-wrapper">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <p>
                                    <h1 class="font arrange-content left-pad">শ্যামল সিলেট এর নিউজলেটার
                                    </h1>
                                </p>
                                <p class="description left-pad"> আপনার ই-মেইল পূর্বে সাবস্ক্রাইব করা হয়েছে <br /> ধন্যবাদ.</p>
                                <div class="left-pad">
                                    <a href="<?php echo base_url()?>" class="btn btn-info">প্রচ্ছদ</a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 ">
                                <center>
                                    <img src="<?php echo base_url('assets/web/images/newsletter.jpg')?>" class="hidden-xs hidden-sm laptop arrange-content" alt="evernote image">
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }
    else{ ?>
        <div class="message-section error-message">
            <div class="message-section bg-color green ">
                <div class="container">
                    <div class="content-wrapper">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <p>
                                    <h1 class="font arrange-content left-pad"> দুঃখিত!
                                    </h1>
                                </p>
                                <p class="description left-pad"> পূনরায় চেষ্টা করুন <br /> ধন্যবাদ.</p>
                                <div class="left-pad">
                                    <a href="<?php echo base_url()?>" class=" btn btn-default design ">প্রচ্ছদ</a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 ">
                                 <img src="<?php echo base_url('assets/web/images/newsletter.jpg')?>"  class="hidden-xs hidden-sm laptop arrange-content" alt="evernote image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }
?>
                