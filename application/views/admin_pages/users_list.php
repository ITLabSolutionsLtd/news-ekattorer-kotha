<style>
    /* .st_fullname{
        font-size: 14px;
    } */
    .st_username {
        color: #1693cc;
        font-size: 12px;
        font-style: italic;
    }

    .st_date {
        font-size: 12px;
    }
</style>
<div class="content-wrapper">
    <!--Extended Table starts-->
    <section id="extended">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text">User list</h4>
                        <hr>
                    </div>
                    <div class="card-content">
                        <?php if ($user_list_info) { ?>
                            <div class="card-body table-responsive">
                                <p class='text-success text-left'> Total Users: <?php echo sprintf('%02d', COUNT($user_list_info)); ?> </p>
                                <table class="table text-secondary">
                                    <thead>
                                        <tr class="bg-dark">
                                            <th>SN</th>
                                            <th></th>
                                            <th>Info</th>
                                            <th class="text-center">User Type</th>
                                            <th class="text-center">Email/Mobile</th>
                                            <th class="text-center">Created/Modified</th>
                                            <?php
                                            if ($user_type == 7 || $user_type == 5) {
                                                echo '
                                                        <th class="text-center">Status</th>
                                                        <th class="text-center">Action</th>
                                                    ';
                                            }
                                            ?>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        foreach ($user_list_info as $row) : {
                                        ?>
                                                <tr>
                                                    <td><?php echo $count; ?></td>
                                                    <td> 
                                                        <?php if($row->img_ext){?>  <a href="<?php echo base_url('images/users/'.$row->id.$row->img_ext) ?>" target="_blank" >  <?php } ?>
                                                            <img <?php if($row->img_ext) { ?> src="<?php echo base_url('images/users/thumb/'.$row->id.$row->img_ext) ?>" <?php } else { ?> src="<?php echo base_url('assets/panel/images/user.png'); ?>" <?php } ?> style="width: 50px; height: 50px" class="rounded" > 
                                                        <?php if($row->img_ext){?>  </a> <?php } ?> 
                                                    </td>

                                                    <td><?php echo $row->user_full_name . '</br><div class="st_username"><i class="fa fa-user-circle "></i> ' . $row->username . '</div>'; ?></td>

                                                    <td class="text-center">
                                                        <?php
                                                        if ($row->user_type == 7) echo 'Super Admin';
                                                        else if ($row->user_type == 5) echo 'Admin';
                                                        else if ($row->user_type == 3) echo 'Editor';
                                                        else if ($row->user_type == 2) echo 'Reporter';
                                                        ?>
                                                    </td>

                                                    <td class="text-center"><i class="fa fa-envelope"></i><?php echo nbs(2) . $row->email . '</br>' . nbs(2) . $row->user_mobile; ?></td>

                                                    <td class="text-center st_date">
                                                        <?php echo date('d-m-Y h:i', strtotime($row->created)) . '</br>'; ?>
                                                        <?php echo date('d-m-Y h:i', strtotime($row->modified)); ?>
                                                    </td>
                                                    <?php
                                                    if ($user_type == 7 || $user_type == 5) { ?>
                                                        <?php
                                                        if ($user_type == 5 && $row->user_type == 5) { ?>
                                                            <td class="text-center text-info"> <span class="badge badge-success">Active</span> </td>
                                                        <?php } else { ?>
                                                            <td class='text-center'>
                                                                <?php

                                                                $status = $row->activated;
                                                                if ($status == 1) { ?>
                                                                    <a href="<?php echo base_url() ?>Admin/UpdateUserStatus/<?php echo $row->id . '/' . $row->activated ?>" id="status" class="btn btn-success btn-sm">Active</a>
                                                                <?php } else { ?>
                                                                    <a href="<?php echo base_url() ?>Admin/UpdateUserStatus/<?php echo $row->id . '/' . $row->activated ?>" id="status" class="btn btn-danger btn-sm">Inactive</a>
                                                                <?php }
                                                                ?>
                                                            </td>
                                                        <?php
                                                        }
                                                        ?>

                                                        <?php
                                                        if ($user_type == 5 && $row->user_type == 5 && $user_name != $row->username) { ?>
                                                            <td class="text-center text-info"> - </td>
                                                        <?php
                                                        } else { ?>
                                                            <td class="text-center"><a href="<?php echo site_url() ?>auth/change_user_data/<?php echo $row->id; ?>"><i class="fa fa-edit"></i></a></td>
                                                        <?php
                                                        }
                                                        ?>

                                                    <?php
                                                    }
                                                    ?>
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

<script>

</script>