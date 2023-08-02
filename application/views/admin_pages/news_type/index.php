<div class="content-wrapper">
    <section id="basic-form-layouts">
        <div class="row">
            <div class="col-sm-12">
                <div class="content-header">News Type</div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <?php if($user_type == 7) { ?>

                    <div class="card">
                        <div class="card-content">
                            <div class="px-3">
                                <?php echo form_open_multipart('news-type'); ?>
                                    <div class="form-body">
                                        <h4 class="form-section" style="margin-top: 10px"><i class="fas fa-newspaper"></i>News Type Setup</h4>
                                        <div class="row justify-content-center">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="projectinput2">Type Name * </label>
                                                    <?php echo form_input('type_name', set_value('type_name'),'class="form-control" '); ?>
                                                    <small class="text-danger" style="font-size: 11px">
                                                        <?php if(form_error('type_name')){ echo form_error('type_name'); } ?>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label style="visibility: hidden">Page Position* :</label>
                                                    <?php echo form_submit('upload', 'Save','class="btn btn-raised btn-raised btn-primary" style="width: 100%"'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>

                <?php } ?>


                <div class="card">
                    <div class="card-content">
                        <?php if($type_list){ ?> 
                            <div class="card-body table-responsive">
                                <p class='text-success text-left'> Total Data Found : <?php echo sprintf('%02d', COUNT($type_list)); ?> </p>
                                <table class="table default-ordering text-white" id="myTable">
                                    <thead>
                                        <tr class="bg-dark">
                                            <th>SL</th>
                                            <th>Name</th> 
                                            <th class="text-center">Last Modify</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Edit</th>
                                                 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $count = 1;
                                            foreach ($type_list as $row): {  
                                        ?>
                                            <tr class="dragdrop" id="<?php echo $row->news_type_id ?>">
                                                <td><?php echo $row-> news_type_id; ?> </td>
                                                <td><span> <?php echo $row-> type_name; ?></span></td>
                                                <td class="text-center text-sm text-muted"> <small><?php echo date('d M Y H:i', strtotime($row-> last_modify)); ?></small> </td>
                                                
                                                <td class="text-center"> 
                                                    <?php
                                                        $status = $row->type_status;
                                                        if($status == 1)
                                                            echo  '<span class="badge badge-success">Active</span>';
                                                        else
                                                            echo  '<span class="badge badge-danger">Disable</span>';
                                                    ?>
                                                </td>
                                                
                                                <td class="text-center">
                                                    <a href="<?php echo base_url('news-type-update/'.$row->news_type_id); ?>" class="success p-0"  >
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
				                <p class='message-alert text-center'> Sorry ! No Information Found. </p> <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>