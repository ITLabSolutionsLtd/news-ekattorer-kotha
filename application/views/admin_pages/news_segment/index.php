<div class="content-wrapper">
    <section id="basic-form-layouts">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="content-header">NEWS SEGMENT</div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="content-header text-right"> <a class="btn btn-sm btn-primary" href="<?php echo base_url('add-news-segment'); ?>"> New Segment Setup </a> </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <?php if($list){ ?> 
                            <div class="card-body table-responsive">
                                <p class='text-primary text-left'> Total Data Found : <?php echo sprintf('%02d', COUNT($list)); ?> </p>
                                <table class="table default-ordering" id="myTable">
                                    <thead>
                                        <tr class="bg-dark">
                                            <th>SL</th>
                                            <th>Name</th> 
                                            <th class="text-center">Active Date</th>
                                            <th class="text-center">Last Modify</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Edit</th>
                                                 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $count = 0;
                                            foreach ($list as $row): { $count++;   ?>
                                            <tr class="dragdrop" id="<?php echo $row->segment_id ?>">
                                                <td><?php echo $count; ?> </td>
                                                <td><span> <?php echo $row-> segment_title; ?> <small> <span class="text-warning">/ <?php echo $row-> segment_tag; ?></span></small></span></td>

                                                <td class="text-center"><span><small> <?php echo date('d M Y', strtotime($row->segment_start_date)).' - '.date('d M Y', strtotime($row->segment_end_date)); ?> </small></span></td>

                                                <td class="text-center text-sm text-muted"> <small><?php if($row-> updated_at == null) echo date('d M Y H:i', strtotime($row-> created_at)); else echo date('d M Y H:i', strtotime($row-> updated_at));  ?></small> </td>
                                                
                                                <td class="text-center"> 
                                                    <?php
                                                        $status = $row->status;
                                                        if($status == 1)
                                                            echo  '<span class="badge badge-success">Active</span>';
                                                        else
                                                            echo  '<span class="badge badge-danger">Disable</span>';
                                                    ?>
                                                </td>
                                                
                                                <td class="text-center">
                                                    <a href="<?php echo base_url('edit-news-segment/'.$row->segment_id); ?>" class="success p-0"  >
                                                        <i class="ft-edit-2 font-medium-3 mr-2"></i>
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
				                <p class='alert alert-warning text-center mt-2 mx-2'> Sorry ! No Information Found. </p> <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>