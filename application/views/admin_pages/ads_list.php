<?php 
	function limit_text($text, $limit)
	{
		if(strlen($text)>$limit)
		{
			$text = substr( $text,0,$limit );
			$text = substr( $text,0,-(strlen(strrchr($text,' '))) );
		}
		return $text;
	}
?>

<style>
    .img-show-div{
        width: 180px;
        float: left;

        text-align: center; 
        overflow: hidden;
    }
    .img-show-div img{
        width: 100%;
        max-height: 45px; 
    }
    .img-show-div a{
        width: 100%;
        float: left;
        max-height: 45px;
        overflow: hidden;
    }
    
    .table th, .table td {
        vertical-align: middle;
    }
</style>

<div class="content-wrapper"><!--Extended Table starts-->
    <section id="extended">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Advertise List</h4> <hr class="mb-0">
                    </div>
                    <div class="card-content">

                        <?php
                            if($advertise_info_banner == '' && $advertise_info_lb == '' && $advertise_info_rac == ''){ ?>
                                <tr> <td> <p class='message-alert text-center mt-3 text-warning'> Sorry ! No Information Found. </p> </td> </tr>  <?php
                            }
                        ?>

                        <?php if($advertise_info_banner){ ?> 
                            <div class="card-body table-responsive">
                                <div class="alert alert-primary">
                                    <h3 class="mb-0 text-center font-weight-bold">BANNER ADVERTISE <small class="fs-1">(400x100)</small></h3>
                                </div>
                                <table class="table text-white">
                                    <thead>
                                        <tr class="bg-dark text-center">
                                            <th>Position</th>
                                            <th>Image</th>
                                            <th>Ads Title</th>
                                            <th>Active Date</th>
                                            <th>Status</th>
                                            <th>Category</th>
                                            <th>Edit</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>

                                        

                                        <?php 
                                            $count = 1;
                                            foreach ($advertise_info_banner as $row): {  
                                        ?>
                                        <tr class="text-center">
                                            <td><?php echo "#".sprintf('%02d', $count); ?></td>
                                            <td class="text-info">
                                                <div class="img-show-div">
                                                    <a href="<?php echo base_url().'images/add/'.$row-> add_id.$row-> img_ext; ?>" target="_blank" class="fluffychicken" title="<?php echo stripslashes($row->add_title)?>">
                                                        <img src="<?php echo base_url().'images/add/'.$row-> add_id.$row-> img_ext; ?>" alt="advertise" />
                                                    </a>
                                                </div>
                                            </td>
                                            
                                            <td><?php echo $row-> add_title;  ?></td>
                                            <!-- <td class="text-info"><?php echo $row-> cat_name; ?></td> -->
                                            <td class="text-muted text-sm"> <?php echo date('d-M-Y', strtotime($row-> add_start_date)) ?> <span class="text-danger"><strong>To</strong></span> <?php echo date('d-M-Y', strtotime($row-> add_end_date)); ?></td>
                                        
                                            <td class="text-muted">
                                                <small>
                                                    <?php
                                                        if($row-> add_status==1)
                                                            echo 'Normal';
                                                        else if($row-> add_status==0)
                                                            echo 'Inactive';
                                                        else
                                                            echo 'Hide';
                                                    ?>
                                                </small>
                                            </td>

                                            <td class="text-muted">
                                                <?php  echo ($row->cat_name) ? $row->cat_name : "-"; ?>
                                                
                                            </td>
                                            
                                            <td class="text-center">
                                                <a href="<?php echo base_url()?>Admin/SetAdSlot/<?php echo $row-> position; ?>"
                                                    class="success p-0" data-original-title="" title=""> <i class="ft-edit font-small-3 mr-2"></i>
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
                        
                        ?>
                    </div>
                    <div class="card-content">
                        <?php if($advertise_info_lb){ ?> 
                            <div class="card-body table-responsive">
                                <div class="alert alert-success">
                                    <h3 class="mb-0 text-center font-weight-bold">LEADERBOARD ADVERTISE <small class="fs-1">(740x100)</small></h3>
                                </div>
                                <table class="table text-white">
                                    <thead>
                                        <tr class="bg-dark text-center">
                                            <th>Position</th>
                                            <th>Image</th>
                                            <th>Ads Title</th>
                                            <th>Active Date</th>
                                            <th>Status</th>
                                            <th>Edit</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $count = 1;
                                            foreach ($advertise_info_lb as $row): {  
                                        ?>
                                        <tr class="text-center">
                                            <td><?php echo "#".sprintf('%02d', $count); ?></td>
                                            <td class="text-info">
                                                <div class="img-show-div">
                                                    <a href="<?php echo base_url().'images/add/'.$row-> add_id.$row-> img_ext; ?>" target="_blank" class="fluffychicken" title="<?php echo stripslashes($row->add_title)?>">
                                                        <img src="<?php echo base_url().'images/add/'.$row-> add_id.$row-> img_ext; ?>" alt="advertise" />
                                                    </a>
                                                </div>
                                            </td>
                                            
                                            <td><?php echo $row-> add_title;  ?></td>
                                            <!-- <td class="text-info"><?php echo $row-> cat_name; ?></td> -->
                                            <td class="text-muted text-sm"> <?php echo date('d-M-Y', strtotime($row-> add_start_date)) ?> <span class="text-danger"><strong>To</strong></span> <?php echo date('d-M-Y', strtotime($row-> add_end_date)); ?></td>
                                          
                                            <td class="text-muted">
                                                <small>
                                                    <?php
                                                        if($row-> add_status==1)
                                                            echo 'Normal';
                                                        else if($row-> add_status==0)
                                                            echo 'Inactive';
                                                        else
                                                            echo 'Hide';
                                                    ?>
                                                </small>
                                            </td>

                                           
                                            
                                            <td class="text-center">
                                                <a href="<?php echo base_url()?>Admin/SetAdSlot/<?php echo $row-> position; ?>"
                                                    class="success p-0" data-original-title="" title=""> <i class="ft-edit font-small-3 mr-2"></i>
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
                        <?php } ?>
                        
                    </div>
                   
                    <div class="card-content">
                        <?php if($advertise_info_rac){ ?> 
                            <div class="card-body table-responsive">
                                <div class="alert alert-info">
                                    <h3 class="mb-0 text-center font-weight-bold">RACTANGULER ADVERTISE <small class="fs-1">(300x250)</small></h3>
                                </div>
                                <table class="table text-white">
                                    <thead>
                                        <tr class="bg-dark text-center">
                                            <th>Position</th>
                                            <th>Image</th>
                                            <th>Ads Title</th>
                                            <th>Active Date</th>
                                            <th>Status</th>
                                            <th>Edit</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $count = 1;
                                            foreach ($advertise_info_rac as $row): {  
                                        ?>
                                        <tr class="text-center">
                                            <td><?php echo "#".sprintf('%02d', $count); ?></td>
                                            <td class="text-info">
                                                <div class="img-show-div">
                                                    <a href="<?php echo base_url().'images/add/'.$row-> add_id.$row-> img_ext; ?>" target="_blank" class="fluffychicken" title="<?php echo stripslashes($row->add_title)?>">
                                                        <img src="<?php echo base_url().'images/add/'.$row-> add_id.$row-> img_ext; ?>" alt="advertise" />
                                                    </a>
                                                </div>
                                            </td>
                                            
                                            <td><?php echo $row-> add_title;  ?></td>
                                            <!-- <td class="text-info"><?php echo $row-> cat_name; ?></td> -->
                                            <td class="text-muted text-sm"> <?php echo date('d-M-Y', strtotime($row-> add_start_date)) ?> <span class="text-danger"><strong>To</strong></span> <?php echo date('d-M-Y', strtotime($row-> add_end_date)); ?></td>
                                            
                                            <td class="text-muted">
                                                <small>
                                                    <?php
                                                        if($row-> add_status==1)
                                                            echo 'Normal';
                                                        else if($row-> add_status==0)
                                                            echo 'Inactive';
                                                        else
                                                            echo 'Hide';
                                                    ?>
                                                </small>
                                            </td>

                                        
                                            
                                            <td class="text-center">
                                                <a href="<?php echo base_url()?>Admin/SetAdSlot/<?php echo $row-> position; ?>"
                                                    class="success p-0" data-original-title="" title=""> <i class="ft-edit font-small-3 mr-2"></i>
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
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
