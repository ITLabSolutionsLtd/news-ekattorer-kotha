<div class="content-wrapper">
    <section id="basic-form-layouts">
        <div class="row">
            <div class="col-sm-12">
                <div class="content-header">News Type</div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <div class="px-3">
                            <?php echo form_open_multipart('news-type-update/'.$edit_id); ?>
                                <div class="form-body">
                                    <h4 class="form-section" style="margin-top: 10px"><i class="fas fa-newspaper"></i>News Type Setup</h4>
                                    <div class="row bg-warning justify-content-center" style="margin-bottom: 20px; padding-top: 20px;">
                                        <div class="col-md-5">
                                            <?php if($user_type == 7) {?>
                                                <div class="form-group">
                                                    <label class="text-light" for="projectinput2">Type Name * </label>
                                                    <?php echo form_input('type_name', set_value('type_name', $edit_name),'class="form-control" '); ?>
                                                    <small class="text-danger" style="font-size: 11px">
                                                        <?php if(form_error('type_name')){ echo form_error('type_name'); } ?>
                                                    </small>
                                                </div>
                                            <?php } else { ?>
                                                <div class="form-group">
                                                    <label class="text-light" for="projectinput2">Type Name * </label>
                                                    <?php echo form_input('readonly', set_value('readonly', $edit_name),'class="form-control" readonly '); ?>
                                                    <?php echo form_hidden('type_name', $edit_name); ?>
                                                    <small class="text-danger" style="font-size: 11px">
                                                        <?php if(form_error('type_name')){ echo form_error('type_name'); } ?>
                                                    </small>
                                                </div>
                                            <?php } ?>
                                            
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="text-light" for="projectinput2">Status * </label>

                                                <?php 
                                                    $data = array('1' => 'Active', '0' => 'Inactive');
                                                    echo form_dropdown('type_status', $data , set_value('type_status', $edit_status),'class="form-control" '); 
                                                ?>
                                               
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label style="visibility: hidden">Page Position* :</label>
                                                <?php echo form_submit('upload', 'Update','class="btn btn-raised btn-raised btn-light" style="width: 100%"'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>


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