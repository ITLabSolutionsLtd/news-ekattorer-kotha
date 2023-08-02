<?php 
    $default_image  = base_url('images/default-ekattorer-kotha.jpg') ;
    $thumb = '/thumb'.'/' ;
    $small = '/small'.'/' ;
?>

<style>
    
.pagination {
    border-radius: 40px;
    display: inline-block;
}
.pagination li {
  display: inline-block;
  list-style: none;
}
.pagination li.active a{
    background: #ff4040;
    color: #fff; 
}

.pagination li a {
  display: block;
  width: 40px;
  height: 40px;
  line-height: 40px;
  background-color: #fff;
  text-align: center;
  text-decoration: none;
  color: #252525;
  border-radius: 4px;
  margin: 5px;
  box-shadow: inset 0 5px 10px rgba(0, 0, 0, 0.1), 0 2px 5px rgba(0, 0, 0, 0.5);
  transition: all 0.3s ease;
}
.pagination li a:hover, .pagination li a.active {
  color: #fff;
  background-color: #ff4242;
}
.pagination li:first-child a {
  border-radius: 40px 0 0 40px;
}
.pagination li:last-child a {
  border-radius: 0 40px 40px 0;
}
</style>

<div class="main-content news-author">
    <div class="container">
       <div class="row py-4">
           <div class="col-md-3">
                <div class="media profile-head">
                    <div class="profile ">
                        <a href="<?php if($author_info->img_ext) echo base_url('images/writer/'.$author_info->writer_id.$author_info->img_ext); else echo base_url('images/writer/writer.jpg'); ?>" download>
                            <img src="<?php if($author_info->img_ext) echo base_url('images/writer/thumb/'.$author_info->writer_id.$author_info->img_ext); else echo base_url('images/writer/writer.jpg'); ?>" class=" mb-2  img-fluid">
                        </a>
                    </div>
                    <div class="media-body " >
                        <h4 class="mt-0 mb-0"><?php echo $author_info->writer_name; ?></h4>
                        <p class="small"><i class="fas fa-briefcase"> </i> <?php echo html_entity_decode($author_info->writer_designation); ?></p>
                        <?php if($author_info->writer_bio){ ?>
                            <p class="font-italic mb-0"><?php echo strip_tags($author_info->writer_bio); ?></p>    
                        <?php }?>
                    </div>
                </div>
           </div>
           <div class="col-md-9">
                <?php
                    if($author_wise_news){?>
                        <div class="row pb-3 author-news">
                        
                            <?php
                                $count = 0;
                                foreach($author_wise_news as $row){ $count++; $folder_name = ceil($row->news_id/1000); $url = 0;  if($row->cat_id == 5) $url = 'opinion/'; else $url = 'details/';  ?>
                                    <div class="col-xs-12 col-sm-3">
                                        <div class="card">
                                            <img class="lazy" data-src="<?php echo ($row->img_ext) ? base_url('images/news/' . $folder_name  . '/' . $row->news_id . $row->img_ext) : $default_image ?>" style="height: 100%;" />
                                            <div class="overlay">
                                                <div class="card-category"><a href="<?php echo base_url($row->cat_key_name); ?>"><?php echo $row->cat_name; ?></a></div>
                                                <div class="card-description">
                                                    <h2><a href="<?php echo base_url($url.$row->news_id.'/'.seoURL($row->news_headline)); ?>"> <?php echo stripslashes($row->news_headline); ?> </a></h2>
                                                </div>
                                                <a class="card-link" href="<?php echo base_url($url.$row->news_id); ?>"></a>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                            ?>
                            

                        </div>
                        <?php if ($author_wise_news) {
                                    echo '<div class="pagi text-center">'.$this->pagination->create_links().'</div>';
                                } ?>
                    <?php }
                ?>
           </div>
       </div>
       
        
    </div>
</div>