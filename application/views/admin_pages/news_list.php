<?php 
	function limit_text($text, $limit){
		if(strlen($text) > $limit){
			$text = substr( $text,0,$limit );
			$text = substr( $text,0,-(strlen(strrchr($text,' '))) );
		}
		return $text;
	}
?>
<div class="content-wrapper"><!--Extended Table starts-->
    <section id="extended">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                    <h4 class="card-title">News fetch data</h4> <hr>
                    </div>
                    <div class="card-content">
                        <?php if($news_list_info){ ?> 
                            <div class="card-body table-responsive">
                                <p class='text-success text-left'> Total Data Found : <?php echo sprintf('%02d', COUNT($news_list_info)); ?> </p>
                                <table class="table text-white">
                                    <thead>
                                        <tr class="bg-dark">
                                            <th class="text-center">SN</th>
                                            <!-- <th></th> -->
                                            <th>Headline</th>
                                            <th class="text-center"><span class="text-info">Approver</span>/Publisher</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Reader</th>
                                            <th class="text-center">Edit</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $count = 1;
                                            foreach ($news_list_info as $row): {  
                                                $folder_name = ceil($row-> news_id / 1000); 
                                        ?>
                                        <tr>

                                            <td class="text-center"><?php echo sprintf('%02d', $count) ?></td>

                                            <td>
                                                <strong class="text-info"><?php echo $row-> cat_name; ?></strong> <br>
                                                <small><?php echo stripslashes($row-> news_headline); ?></small> <br>
                                                <small style="font-weight:0;font-style: italic;font-size: 12px">
                                                    <i class="fa fa-user"></i><?php echo nbs(2).$row-> user_full_name; ?> 
                                                </small>
                                            </td>
                                           
                                            <td class="text-center" style="font-weight: 0; font-size: 14px">
                                                <small class="text-info"><?php echo nbs(0).get_news_status($row-> news_status); ?></small><br>
                                                <small style="font-weight:0;font-style: italic;font-size: 11px">
                                                    <?php echo date('d-m-Y h:i', strtotime($row-> news_pub_date)); ?>
                                                </small>
                                            </td>

                                            <td class="text-center"><?php echo $row-> news_reader; ?></td>
                                            
                                            <td class="text-center">

                                                <a href="<?php echo base_url()?>Admin/EditNews/<?php echo $row-> news_id ;?>"
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