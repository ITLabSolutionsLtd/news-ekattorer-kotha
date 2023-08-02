<div class="content-wrapper"><!--Extended Table starts-->
    <section id="extended">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                    <!-- <h4 class="card-title text">Category List</h4> <hr> -->
                        <a href="<?php echo base_url()?>Admin/MediaEntry" class="btn btn-info">Media Entry</a>
                    </div>
                    <div class="card-header">
                    <h4 class="card-title text">Media List</h4> <hr>
                        
                    </div>
                    <div class="card-content">
                        <?php if($news_media_info){ ?> 
                            <div class="card-body table-responsive">
                                <p class='text-success text-left'> Total Media: <?php echo sprintf('%02d', COUNT($news_media_info)); ?> </p>
                                <table class="table text-secondary">
                                    <thead>
                                        <tr class="bg-dark">
                                            <th>Logo</th>
                                            <th class="text-center">Type</th>
                                            <th class="text-center">Media (বাংলা)</th>
                                            <th class="text-center">Media (English)</th>
                                            <th class="text-center">Delete</th>  
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $count = 1;
                                            foreach ($news_media_info as $row): {   
                                        ?>
                                        <tr>
                                           
                                            <td class="text-info"> <img src="<?php echo base_url().'images/paper/'.$row-> media_id.$row -> img_ext; ?>" style="width: 50px; height: 50px" alt=""></td>
                                            <td class="text-center">
                                                <?php
                                                    if($row-> media_type==1)
                                                        echo 'TV';	
                                                    else if($row-> media_type==2)
                                                        echo 'Print';	
                                                    else if($row-> media_type==3)
                                                        echo 'Paper Link';
                                                    else if($row-> media_type==4)
                                                        echo 'Organization Link';
                                                    else
                                                        echo 'N/A';
                                                ?>
                                            </td>
                                            <td class="text-center"><?php echo $row-> media_name; ?></td>
                                            <td class="text-center"><?php echo $row-> media_en_name; ?></td>
                                            <td class="text-center">
                                                <a href="<?php echo base_url()?>Admin/delete_news_media/<?php echo $row-> media_id; ?>" id="delete" class="danger" data-original-title="" title="" >
                                                    <i class="ft-trash font-medium-3"></i>
                                                </a>
                                            </td>

                                        </tr>

                                        <?php }
                                            $count++;
                                            endforeach;   
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        <?php }
                        else{ ?>
				                <p class='message-alert text-center'> Sorry ! No Information Found. </p> <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
