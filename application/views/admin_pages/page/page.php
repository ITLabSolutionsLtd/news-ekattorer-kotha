<style>
    /* .accordion {
        display: none;
    } */

    .table th, .table td {
        padding: 0.75rem;
        vertical-align: unset;
        border-bottom: 1px solid #929496;
    }
</style>
<div class="content-wrapper">
    <section id="basic-form-layouts">
        <div class="row">
            <div class="col-sm-12">
            <div class="content-header">Page</div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <div class="px-3">
                            
                            <?php echo form_open_multipart('Admin/page'); ?>
                                <div class="form-body">
                                    <h4 class="form-section" style="margin-top: 10px"><i class="fas fa-newspaper"></i>News Page Setup</h4>
                                    
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="projectinput2">Page Name (BN) * </label>
                                                <?php echo form_input('page_name_bn', set_value('page_name_bn'),'class="form-control" '); ?>
                                                <small class="text-danger" style="font-size: 11px">
                                                    <?php if(form_error('page_name_bn')){ echo form_error('page_name_bn'); } ?>
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="projectinput2">Page Name (EN) * </label>
                                                <?php echo form_input('page_name', set_value('page_name'),'class="form-control" onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 32" '); ?>
                                                <small class="text-danger" style="font-size: 11px">
                                                    <?php if(form_error('page_name')){ echo form_error('page_name'); } ?>
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
                                    <!--- END OF CLASS ROW ---->
                                </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
                <div class="card">
                    
                    <div class="card-content">
                        <?php if($page_list){ ?> 
                            <div class="card-body table-responsive">
                                <p class='text-success text-left'> Total Data Found : <?php echo sprintf('%02d', COUNT($page_list)); ?> </p>
                                <table class="table default-ordering text-white" id="myTable">
                                    <thead>
                                        <tr class="bg-dark">
                                            <th></th>
                                            <th>Name (BN)</th> 
                                            <th>Name (EN)</th> 
                                            <th class="text-center">Last Modify</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Edit</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody class="position">
                                        <?php 
                                            $count = 1;
                                            foreach ($page_list as $row): {  
                                        ?>
                                            <tr class="dragdrop" id="<?php echo $row->page_id ?>">

                                                <td class="text-center" >
                                                    <i class="icon-cursor-move"></i>
                                                </td>
                                                <td><?php echo $row-> name_bn; ?> </td>
                                                <td><span class="text-muted text-sm"> <?php echo $row-> name; ?></span></td>
                                                <td class="text-center text-sm text-muted"> <small><?php echo date('d M Y H:i', strtotime($row-> last_modify)); ?></small> </td>
                                                
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
                                                    <a  class="success p-0 accordion-row" data-id="<?php echo $row->page_id; ?>" >
                                                        <i class="ft-edit-2 font-medium-3 mr-2"></i>
                                                    </a>
                                                </td>
                                                
                                            </tr>
                                            <tr class="accordion<?php echo $row->page_id; ?>"    style="background: #a3a3a3; display:none">
                                                
                                                <?php echo form_open_multipart('Admin/UpdatePage/'.$row->page_id); ?>
                                                    

                                                    <td>
                                                        <div class="form-group mb-0">
                                                            <?php echo form_input('page_name_bn', set_value('page_name_bn', $row->name_bn),'class="form-control" required '); ?>
                                                            <small class="text-danger" style="font-size: 11px">
                                                                <?php if(form_error('page_name_bn')){ echo form_error('page_name_bn'); } ?>
                                                            </small>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="form-group mb-0">
                                                            <?php echo form_input('page_name', set_value('page_name', $row->name),'class="form-control" onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57)" required '); ?>
                                                            <small class="text-danger" style="font-size: 11px">
                                                                <?php if(form_error('page_name')){ echo form_error('page_name'); } ?>
                                                            </small>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="form-group mb-0">
                                                            
                                                            <?php 
                                                                $status = array('1' => 'Active', '2' => 'Disable');
                                                                echo form_dropdown('status', $status, set_value('page_position', $row->status),'class="form-control" '); 
                                                            ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group mb-0">
                                                            <button type="button" class="btn btn-warning mb-0 undo-row"  data-id="<?php echo $row->page_id; ?>" >Undo</button>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group mb-0">
                                                            
                                                            <?php echo form_submit('upload', 'Save','class="btn btn-raised btn-raised btn-primary mb-0" style="width: 100%"'); ?>
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                </form>

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