<style>
    .table th, .table td {
        vertical-align: middle;
    }
</style>
<div class="content-wrapper">
    <!--Extended Table starts-->
    <section id="extended">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <!-- <h4 class="card-title text">Category List</h4> <hr> -->
                        <a href="<?php echo base_url() ?>Admin/WriterSetup" class="btn btn-info">Add Writer</a>
                    </div>
                    <div class="card-header">
                        <h4 class="card-title text">Writer List</h4>
                        <hr>

                    </div>
                    <div class="card-content">
                        <?php if ($news_writer_list) { ?>
                            <div class="card-body table-responsive">
                                <!-- <p class='text-success text-left'> Total Writer : <?php echo sprintf('%02d', COUNT($news_writer_list)); ?> </p> -->
                                <table class="table text-secondary">
                                    <thead>
                                        <tr class="bg-dark">
                                            <th>Writer Name</th>
                                            <th></th>
                                            <th class="text-center">Info</th>
                                            <th class="text-center">Contact</th>
                                            <th class="text-center">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        foreach ($news_writer_list as $row) : {
                                        ?>
                                                <tr>

                                                    <td class="text-info">
                                                        <img class="rounded" width="50" src="<?php if($row->img_ext){ echo base_url('images/writer/thumb/'.$row->writer_id.$row->img_ext); }?>" alt="">
                                                        <?php echo $row->writer_name; ?>
                                                    </td>
                                                    <?php
                                                    if ($row->writer_type == 1) {
                                                        $writer_type = 'Author';
                                                    }
                                                    if ($row->writer_type == 2) {
                                                        $writer_type = 'Opinion Writer';
                                                    }
                                                    ?>
                                                    <?php $status =   ($row-> writer_status == 1) ?  '<span class="badge badge-success badge-sm">Active</span>': '<span class="badge badge-warning badge-sm">Inactive</span>' ?> 
                                                    <td class="text-center"><?php echo $status; ?>  </td>
                                                    <td class="text-center"><?php echo $writer_type; ?>  </td>
                                                    <td class="text-center"><?php if($row->writer_email && $row->writer_contact ){ echo $row->writer_email . '</br>' . $row->writer_contact; } else { echo $row->writer_email . $row->writer_contact; } ?></td>

                                                    

                                                    <td class="text-center">
                                                        <a href="<?php echo base_url() ?>Admin/EditWriter/<?php echo $row->writer_id; ?>" class="success p-0" data-original-title="" title=""><i class="ft-edit-2 font-medium-3 mr-2"></i>
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