<style>
    .table th, .table td {
        padding: 0.75rem;
        vertical-align: unset;
        border-bottom: 1px solid #929496;
        font-family: 'solaimanlipi';
    }
    body.layout-dark .badge {
        width: 10px;
        height: 10px;
        padding: 0;
        border-radius: 50%;
    }
</style>
<div class="content-wrapper"><!--Extended Table starts-->
    <section id="extended">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Gallery Info</h4> 
                    </div>
                    <div class="card-content">
                        <?php if($news_gallery_info){ ?> 
                            <div class="card-body table-responsive">
                                <!-- <p class='text-success text-left'> Total Data Found : <?php echo sprintf('%02d', COUNT($news_gallery_info)); ?> </p> -->
                                <table class="table table-stripped">
                                    <thead>
                                        <tr>
                                            <th class="text-left">SN</th>
                                            <th>Title</th>
                                            <th class="text-center">File</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $count = 1;
                                            foreach ($news_gallery_info as $row): {  
                                        ?>
                                        <tr>
                                            <td><?php echo sprintf('%02d', $count) ?></td>
                                            <td class="text-info"><?php echo $row-> img_caption; ?></td>
                                            <td class="text-center">
                                                <a href="<?php echo base_url().'images/news_gallery/'.$row-> img_id.$row-> img_ext; ?>" class="fluffychicken" title="<?php echo stripslashes($row->img_caption)?>">
                                                    <img src="<?php echo base_url().'images/news_gallery/'.$row-> img_id.$row-> img_ext; ?>" alt="Gallery Image" class="media-object align-self-center bg-primary height-50 width-50 rounded-circle" />
                                                </a>
                                                <!-- <img src="" style="width: 50px; height: 50px"> -->
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                    if($row->gallery_status == 1){
                                                        echo '<span class="badge badge-pill badge-success"> <i class="fa fa-dot"></i> </span>';
                                                    }
                                                    else{
                                                        echo '<span class="badge badge-pill badge-danger"> <i class="fa fa-dot"></i> </span>';
                                                    }
                                                ?>
                                                
                                            </td>
                                           
                                        
                                            <td class="text-center">
                                                <a href="<?php echo base_url()?>Admin/EditGallery/<?php echo $row-> img_id; ?>" target="_blank"
                                                    class="success p-0" data-original-title="" title=""><i
                                                        class="ft-edit-2 font-medium-3 mr-2"></i>
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
