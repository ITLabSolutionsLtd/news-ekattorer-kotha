<style>
    .alert-warning {
        color: #000000;
        background-color: #ffc200c2;
        border-color: #ffecb5;
    }
    .ui-widget {
        font-family: unset;
        left: unset !important;
        right: 3.5%;
    }
    @media(max-width: 768px){
        .more-cat h5 {
            margin-top: 5px;
        }
        .more-cat h5 a {
            font-size: 1.1rem;
            font-weight: bold;
        }
    }
</style>

<?php $default_image  = base_url('images/shyamal-sylhet.jpg') ?>
<div class="main-content news-page">
    <section class="mb-3">
        <div class="container">
            <div class="row pt-3">
                <div class="col-md-12">
                    <div class="bc-icons-2">
                        <ol class="breadcrumb blue-grey lighten-4">
                            <li class="breadcrumb-item"><a class="black-text" href="<?php echo base_url(); ?>">প্রচ্ছদ</a></li>
                            <li class="breadcrumb-item active">বিষয় </li>
                            <li class="breadcrumb-item active"><?php echo $topic_subject_item; ?> </li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                
                <div class="col-md-12">
                    <div class="row py-3 more-cat">
                        
                        <?php
                            if($topic_news_list){
                                $count = 0;
                                foreach($topic_news_list as $row){ 
                                    $folder_name = ceil($row->news_id/1000); 
                                    $count++;
                                    ?>
                                    <div class="col-lg-3 col-md-6 col-6 mb-4 mb-lg-0 d-flex" >
                                        <div class="card rounded shadow-sm border-0">
                                            <div class="card-body <?php if(!$isMobile) echo 'p-2 pb-1'; else echo 'p-1'; ?>">
                                                <img class="lazy" data-src="<?php echo ($row->img_ext) ? base_url('images/news/' . $folder_name . '/thumb'.'/' . $row->news_id . $row->img_ext) : $default_image ?>" class="img-fluid d-block mx-auto mb-3" width="100%" >
                                               
                                                <h5><a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>" class="text-dark"><?php echo stripslashes($row->news_headline); ?></a></h5>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>