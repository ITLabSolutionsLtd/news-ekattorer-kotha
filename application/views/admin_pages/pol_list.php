<div class="content-wrapper"><!--Extended Table starts-->
    <section id="extended">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                    <!-- <h4 class="card-title text">Category List</h4> <hr> -->
                        <a href="<?php echo base_url()?>Admin/PollEntry" class="btn btn-info">Add Poll</a>
                    </div>
                    <div class="card-header">
                    <h4 class="card-title text">Poll List</h4> <hr>
                        
                    </div>
                    <div class="card-content">
                        <?php if($news_pol_info){ ?> 
                            <div class="card-body table-responsive">
                                <p class='text-success text-left'> Total Poll Data: <?php echo sprintf('%02d', COUNT($news_pol_info)); ?> </p>
                                <table class="table text-secondary">
                                    <thead>
                                        <tr class="bg-dark">
                                            <th>Poll Title</th>
                                            <th class="text-center">Starting Date</th>
                                            <th class="text-center">Ending Date</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Edit</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $count = 1;
                                            foreach ($news_pol_info as $row): {   
                                        ?>
                                        <tr>
                                           
                                            <td class="text-info"><?php echo $row-> pol_title; ?></td>
                                            <td class="text-center"><?php echo $row-> pol_start_date; ?></td>
                                            <td class="text-center"><?php echo $row-> pol_end_date; ?></td>
                                            <td class="text-center">
                                                <?php
                                                    if($row-> pol_end_date == '1'){
                                                        echo 'Normal';
                                                    }
                                                    if($row-> pol_end_date == '0'){
                                                        echo 'Inactive';
                                                    }
                                                    if($row-> pol_end_date == '2'){
                                                        echo 'Hide';
                                                    }
                                                ?>
                                            </td>

                                            <td class="text-center">
                                                <a href="<?php echo base_url()?>Admin/EditPoll/<?php echo $row-> pol_id; ?>"
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
