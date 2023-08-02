<style>  h6 a{ color: unset;  } </style>        
<div class="content-wrapper">
    <?php if($user_type == 7){ ?>
        <div class="row">
            <div class="col-md-12 mt-3 text-right">
                <a href="<?php echo base_url('admin/clear_all_cache'); ?>" id="cache_clear" class="btn btn-warning btn-lg text-light">Clear All Cache</a>
            </div>
        </div>
    <?php } ?>
    <!--Statistics cards Starts-->
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-12">
            <div class="card gradient-blackberry">
                <a href="news-filter?news_id=&cat_id=&sub_cat_id=&news_status=&author_id=&page_id=&userID=&starting_date=<?php echo date('Y-m-d')?>&ending_date=<?php echo date('Y-m-d')?>&sortType=&upload=Search">
                    <div class="card-content">
                        <div class="card-body pt-2 ">
                            <div class="media">
                                <div class="media-body white text-left">
                                    <h3 class="font-large-1 mb-0"><?php echo $all_news; ?></h3>
                                    <span>Today's News</span>
                                </div>
                                <div class="media-right white text-right">
                                    <i class="fa fa-newspaper font-large-1"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-12">
            <div class="card gradient-ibiza-sunset">
                <div class="card-content">
                    <div class="card-body pt-2">
                        <div class="media">
                            <div class="media-body white text-left">
                                <h3 class="font-large-1 mb-0"><?php echo $all_category; ?></h3>
                                <span>Category</span>
                            </div>
                            <div class="media-right white text-right">
                                <i class="icon-bulb font-large-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-12">
            <div class="card gradient-green-tea">
                <div class="card-content">
                    <div class="card-body pt-2">
                        <div class="media">
                            <div class="media-body white text-left">
                                <h3 class="font-large-1 mb-0"><?php echo $all_users; ?></h3>
                                <span>Users</span>
                            </div>
                            <div class="media-right white text-right">
                                <i class="icon-users font-large-1"></i>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-12">
            <div class="card gradient-pomegranate">
                <a href="#">
                    <div class="card-content">
                        <div class="card-body pt-2">
                            <div class="media">
                                <div class="media-body white text-left">
                                    <h3 class="font-large-1 mb-0"><?php if(isset($visitors->day_visitor)) echo $visitors->day_visitor; ?></h3>
                                    <span>Today's Visitor</span>
                                </div>
                                <div class="media-right white text-right">
                                    <i class="icon-eye font-large-1"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!--Statistics cards Ends-->


    <div class="row match-height">
        <div class="col-xl-4 col-lg-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <?php foreach ($user_info_by_id as $row) {

                        ?>
                            <div class="row d-flex mb-3 py-2">

                                <div class="col align-self-center text-center"><img alt="User" class="bg-danger width-150 height-150 rounded-circle img-fluid" src="<?php if($row->img_ext){ echo base_url('images/users/thumb/'.$row->id.$row->img_ext); } else { echo base_url('assets/panel/images/user.png'); } ?>"></div>

                            </div>
                            <h4 class=" fw-bold text-center"> <?php echo $row->user_full_name; ?></h4>
                            <span class="font-medium-1 grey d-block text-center"><span><strong> Email : </strong></span> <?php echo $row->email ?></span> <br>
                            
                            <?php
                                if($row->user_mobile){ ?>
                                    <span class="font-medium-1 grey d-block text-center"><span><strong> Contact : </strong></span> <?php echo $row->user_mobile; ?></span> <br>
                                <?php }
                            ?>
                            
                            <span class="font-medium-1 grey d-block text-center"><span><strong> Address : </strong></span> <?php echo $row->user_address; ?></span> <br>

                            
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Admin/User</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <?php
                        foreach ($user_list_info as $key => $row) {
                            if ($key < 5) { ?>
                                <div class="media mb-1">
                                    <a>
                                        <img class="media-object d-flex mr-3 bg-primary height-50 width-50 rounded-circle" src="<?php if($row->img_ext){ echo base_url('images/users/thumb/'.$row->id.$row->img_ext); } else { echo base_url('assets/panel/images/user.png'); } ?>">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="font-medium-1 mt-1 mb-0"><?php echo $row->username ?></h4>
                                        <p class="text-muted font-small-3"><?php echo $row->email ?></p>
                                    </div>

                                </div>
                        <?php }
                        }
                        ?>


                        <?php
                        if ($user_type == 7) { ?>
                            <div class="action-buttons mt-2 text-center">
                                <a href="<?php echo site_url() ?>auth/register" class="btn btn-raised gradient-blackberry py-2 px-4 white mr-2">Add New</a>
                            </div>
                        <?php } ?>


                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Recent News</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <?php
                        if ($latest_news_info) {
                            if ($user_type == 2) {
                                foreach ($latest_news_info as $row) { ?>
                                    <h6><a> <i class="font-small-1 fa fa-circle"></i> <?php echo stripslashes($row->news_headline) ?> </a>
                                        <hr class="my-1">
                                    </h6>
                                <?php

                                }
                            } else {
                                foreach ($latest_news_info as $row) { ?>
                                    <h6><a href="<?php echo base_url() ?>Admin/EditNews/<?php echo $row->news_id; ?>"> <i class="text-success font-small-1 mr-2 fa fa-circle"></i> <?php echo stripslashes($row->news_headline); ?> </a>
                                        <hr class="my-1">
                                    </h6>
                        <?php   }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END : End Main Content-->
</div>

<script>
    $(document).on("click", "#cache_clear", function(e) {
        e.preventDefault();
        var link = $(this).attr("href");
        swal({
          title: 'Are you sure?',
          text: "You won't revert this caching files",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#0CC27E',
          cancelButtonColor: '#FF586B',
          confirmButtonText: 'Yes',
          cancelButtonText: "No"
        }).then(function(isConfirm) {
          if (isConfirm) {
            window.location.href = link;
          }
        }).catch(swal.noop);
    });
</script>

        