<div class="content-wrapper">
    <!--Extended Table starts-->
    <section id="extended">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <!-- <h4 class="card-title text">Category List</h4> <hr> -->
                        <a href="<?php echo base_url() ?>Admin/ePaperSetup" class="btn btn-info">E-Paper Setup</a>
                    </div>
                    <div class="card-header">
                        <h4 class="card-title text">E-Paper List</h4>
                        <hr>

                    </div>
                    <div class="card-content">
                        <?php if ($ePaper_list) { ?>
                            <div class="card-body table-responsive">
                                <!-- <p class='text-success text-left'> Total Writer : <?php echo sprintf('%02d', COUNT($ePaper_list)); ?> </p> -->
                                <table class="table text-secondary">
                                    <thead>
                                        <tr class="bg-dark">
                                            <th>Subject</th>
                                            <th>Image</th>
                                            <th>PDF</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        foreach ($ePaper_list as $row) {
                                        ?>
                                            <tr>

                                                <td class="text-info"><?php echo $row->ep_subject; ?></td>
                                                <td><img src="<?php echo base_url('images/epaper/' . $row->ep_id . $row->img_ext) ?>" alt="" style="width: 50px; height: 50px; border-radius: 50%"></td>
                                                <td><a href="<?php echo base_url('file/epaper/' . $row->ep_id . $row->ep_file) ?>" target="_blank">PDF</a></td>



                                                <td class="text-center">
                                                    <?php
                                                    $status = '';
                                                    if ($row->ep_status == 1) {
                                                        $status = 'Enable';
                                                    }
                                                    if ($row->ep_status == 0) {
                                                        $status = 'Disable';
                                                    }
                                                    echo $status;
                                                    ?>

                                                </td>

                                                <td class="text-center">

                                                    <a href="<?php echo base_url() ?>Admin/EditePaper/<?php echo $row->ep_id; ?>" class="success p-0" data-original-title="" title=""><i class="ft-edit-2 font-medium-3 mr-2"></i>
                                                    </a>
                                                </td>

                                            </tr>

                                        <?php }


                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        <?php } else { ?>
                            <p class='message-alert text-center'> Sorry ! No Information Found. </p> <?php
                                                                                                    }
                                                                                                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>