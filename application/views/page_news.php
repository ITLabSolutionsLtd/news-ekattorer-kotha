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
                            <li class="breadcrumb-item"><a class="black-text" href="<?php echo base_url(); ?>">প্রচ্ছদ</a><i class="fa fa-angle-double-right mx-2" aria-hidden="true"></i></li>
                            <li class="breadcrumb-item active">আজকের পত্রিকা</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                
                <div class="col-md-12">
                    <div class="row py-3 more-cat">
                        <div class="col-lg-12">
                            <div class="more-title">
                                <h1><?php echo '<a>'.$page_name.'</a> এর খবর'; ?></h1>
                                <div class="datewise-find">
                                    <form action="<?php echo base_url('news-paper')?>" onsubmit="this.action = this.action + '/'+ this.page_id.value +'/' + this.date.value + '/' + this.page_name.value" method="post" style="display: inline-flex">
                                        <input type="hidden" name="page_id" value="<?php echo $page_id; ?>">
                                        <input type="hidden" name="page_name" value="<?php echo seoURL($page_name); ?>">
                                        <input type="text" name="date" id="date_of_birth" value="<?php if(!empty($date)) echo bn_convert(date('d/m/y',strtotime($date))); ?>" class="form-control" placeholder="তারিখ সিলেক্ট করুন.."  onkeydown="return false"/ autocomplete="off" required>
                                        <!-- <input type="text" name="date"  class="form-control"  id="date_of_birth" placeholder="তারিখ সিলেক্ট করুন.."  autocomplete="off" required> -->
                                        <button style="border: 0; width: 30%" ><i class="fa fa-search"></i></button>
                                    </form>
                                   
                                </div>
                            </div>
                        </div>
                        <?php
                            if($newspaper_news){
                                $count = 0;
                                foreach($newspaper_news as $row){ 
                                    $folder_name = ceil($row->news_id/1000); 
                                    $count++;
                                    ?>
                                    <div class="col-lg-3 col-md-3 col-6 mb-4 mb-lg-0 d-flex" >
                                        <div class="card rounded shadow-sm border-0">
                                            <div class="card-body <?php if(!$isMobile) echo 'p-4'; else echo 'p-1'; ?>">
                                                <img class="lazy" data-src="<?php echo ($row->img_ext) ? base_url('images/news/' . $folder_name . '/thumb'.'/' . $row->news_id.$row->img_ext.'?newst='.strtotime($row->news_mod_date.$row->news_mod_time)) : $default_image ?>" class="img-fluid d-block mx-auto mb-3" width="100%" >
                                               
                                                <h5><a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>" class="text-dark"><?php echo stripslashes($row->news_headline); ?></a></h5>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                            }
                            else{ ?>
                                <div class="col-md-12">
                                    <div class="alert alert-warning text-center mt-5" role="alert">
                                        দুঃখিত ! কোন তথ্য পাওয়া যায়নি। 
                                    </div>
                                </div>
                            <?php }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>