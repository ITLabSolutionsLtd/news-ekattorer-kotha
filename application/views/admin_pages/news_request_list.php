<div class="content-wrapper"><!--Extended Table starts-->
    <section id="extended">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                    <h4 class="card-title">Pending News</h4> <hr>
                    </div>
                    <div class="card-content">
                        <?php
                            if($requested_news){ ?>
                            
                            <div class="card-content">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">News Report</h6>
                                    <hr>
                                </div>
                                <div class="card-body table-responsive">
                                    
                                    <p class='text-success text-left'> Total Data Found :
                                        <?php echo sprintf('%02d', COUNT($requested_news)); ?>
                                    </p>
                                    <table class="table text-white">
                                        <thead>
                                            <tr class="bg-dark">
                                                <th class="text-center">SN</th>
                                                <!-- <th></th> -->
                                                <th>Headline</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Reader</th>
                                                <th class="text-center">Action</th>
                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $count = 1;
                                                foreach ($requested_news as $row): {
                                                    $folder_name = ceil($row-> news_id / 1000); 
                                            ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <?php echo sprintf('%02d', $count) ?>
                                                    </td>
                                                    <td>
                                                        <strong class="text-info">
                                                            <?php echo $row-> cat_name; ?>
                                                        </strong> <br>
                                                        <small>
                                                            <?php echo stripslashes($row-> news_headline); ?>
                                                        </small> <br>
                                                        <small style="font-weight:0;font-style: italic;font-size: 12px">
                                                            <i class="fa fa-user"></i>
                                                            <?php 
                                                                echo nbs(2).$row-> user_full_name; 
                                                            ?>
                                                        </small>
                                                    </td>
                                                    <td class="text-center" style="font-weight: 0; font-size: 14px">
                                                        <small class="text-info">
                                                            <?php echo nbs(0).get_news_status($row-> news_status); ?>
                                                        </small><br>
                                                        <small style="font-weight:0;font-style: italic;font-size: 11px">
                                                            <?php
                                                                echo date('d-m-Y', strtotime($row-> news_pub_date)); 
                                                            ?>
                                                        </small>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row-> news_reader; ?>
                                                    </td>
                                
                                                    <td class="text-center">
                                                        <a href="<?php echo base_url()?>Admin/NewsApproveEdit/<?php echo $row-> news_id; ?>" class="btn btn-primary btn-sm"><i class="fa fa-check"></i></a>
                                                        <a href="<?php echo base_url()?>Admin/EditNews/<?php echo $row-> news_id ;?>"class="btn btn-warning btn-sm"  title=""><i class="fa fa-edit"></i></a>
                                                    </td>
                                
                                                </tr>
                            
                                            <?php }
                                                $count++;
                                                endforeach;   
                                            ?>
                            
                                        </tbody>
                                        
                                    </table>
                                </div>               
                            </div>
                        <?php }
                        else{ ?>
                            <!-- <p class='message-alert text-center'> Sorry ! No Information Found. </p> -->
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</div>
<?php 
	function get_news_status($status){
		if($status == 0) $value = 'Inactive';
		else if($status == 1) $value = 'Lead News';
		else if($status == 2) $value = 'Top News';
		else if($status == 3) $value = 'Breaking News';
		else if($status == 4) $value = 'Hide';
		else if($status == 5) $value = 'Normal';
		else if($status == 6) $value = 'Selective News';
		else if($status == 10) $value = 'Live Update';
		else $value = '---';
		
		return $value;
	}
?>