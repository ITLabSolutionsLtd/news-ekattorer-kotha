<style>
    .content-wrapper{
        font-family: 'solaimanlipi', sans-sarif; 
    }
    .table th, .table td {
        vertical-align: unset;
    }
</style>
<div class="content-wrapper"><!--Extended Table starts-->
    <section id="extended">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                    <h4 class="card-title">Category List</h4> <hr>
                    </div>
                    <div class="card-content">
                        <?php if($category_info){ ?> 
                            <div class="card-body table-responsive">
                                <p class='text-success text-left'> Total Data Found : <?php echo sprintf('%02d', COUNT($category_info)); ?> </p>
                                <table class="table text-white">
                                    <thead>
                                        <tr class="bg-dark">
                                            <th class="text-center">SN</th>
                                            <!-- <th></th> -->
                                            <th>Category Bangla</th>
                                            <th>Category English</th>
                                            <th class="text-center">Last Modify</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Edit</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $count = 1;
                                            foreach ($category_info as $row): {  
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo sprintf('%02d', $count) ?></td>
                                            <td><?php echo $row-> cat_name; ?></td>
                                            <td><?php echo $row-> cat_key_name; ?></td>
                                            <td class="text-center"> <small><?php echo date('d M Y H:i', strtotime($row-> cat_dom)); ?></small> </td>
                                           
                                            <td class="text-center">
                                                
                                                <?php
                                                    
                                                    $status = $row->cat_status;
                                                    if($status == 1)
                                                    { ?>
                                                        <a href="<?php echo base_url()?>Admin/edit_cat_status/<?php echo $row->cat_id.'/'.$row->cat_status; ?>" id="confirm-text" class="btn btn-success btn-sm m-0">Active</a>
                                                    <?php }
                                                    else
                                                    { ?>
                                                        <a href="<?php echo base_url()?>Admin/edit_cat_status/<?php echo $row->cat_id.'/'.$row->cat_status; ?>" id="confirm-text" class="btn btn-danger btn-sm m-0">Inactive</a>
                                                    <?php }
                                                ?>
                                            
                                        
                                            </td>
                                            <td class="text-center">
                                                <a href="<?php echo base_url()?>Admin/EditCategory/<?php echo $row-> cat_id; ?>"
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