<div class="content-wrapper">
    <!--Extended Table starts-->
    <section id="extended">
        <div class="row">
            <div class="col-sm-12">
                <div class="content-header">Member List</div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-content">
                        <?php if ($secetary_info) { ?>
                            <div class="card-header">
                                <h4 class="card-title">Secretary</h4>
                                <hr>
                            </div>
                            <div class="card-body table-responsive">

                                <table class="table default-ordering" id="myTable">
                                    <thead>
                                        <tr class="">
                                            <th>Profile</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Designation</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="row_position">
                                        <?php
                                        $count = 1;
                                        foreach ($secetary_info as $row) : {
                                        ?>
                                                <tr id="<?php echo $row->id ?>">
                                                    <td class="text-center"><img src="<?php echo base_url() . 'images/member/thumb/' . $row->id . $row->img_ext; ?>" style="width: 50px; height: 50px"></td>
                                                    <td class="text-center text-primary"><?php echo $row->member_name; ?></td>
                                                    <td class="text-center text-primary"><?php echo $row->member_designation; ?></td>
                                                    <td class="text-center text-primary"><?php echo $row->member_email; ?></td>
                                                    <td class="text-center "><a class="text-success" href="<?php echo base_url() ?>admin/EditMember/<?php echo $row->id ?>"><i class="ft-edit-3"></i></a></td>

                                                </tr>

                                        <?php }
                                            $count++;
                                        endforeach;
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-content">
                        <?php if ($reporter_info) { ?>
                            <div class="card-header">
                                <h4 class="card-title">Reporter</h4>
                                <hr>
                            </div>
                            <div class="card-body table-responsive">

                                <table class="table default-ordering" id="myTable">
                                    <thead>
                                        <tr class="">
                                            <th>Profile</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Designation</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="row_position">
                                        <?php
                                        $count = 1;
                                        foreach ($reporter_info as $row) : {
                                        ?>
                                                <tr id="<?php echo $row->id ?>">
                                                    <td class="text-center"><img src="<?php echo base_url() . 'images/member/thumb/' . $row->id . $row->img_ext; ?>" style="width: 50px; height: 50px"></td>
                                                    <td class="text-center text-primary"><?php echo $row->member_name; ?></td>
                                                    <td class="text-center text-primary"><?php echo $row->member_designation; ?></td>
                                                    <td class="text-center text-primary"><?php echo $row->member_email; ?></td>
                                                    <td class="text-center "><a class="text-success" href="<?php echo base_url() ?>admin/EditMember/<?php echo $row->id ?>"><i class="ft-edit-3"></i></a></td>
                                                </tr>

                                        <?php }
                                            $count++;
                                        endforeach;
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-content">
                        <?php if ($photo_section_info) { ?>
                            <div class="card-header">
                                <h4 class="card-title">Photo Section</h4>
                                <hr>
                            </div>
                            <div class="card-body table-responsive">

                                <table class="table default-ordering" id="myTable">
                                    <thead>
                                        <tr class="">
                                            <th>Profile</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Designation</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="row_position">
                                        <?php
                                        $count = 1;
                                        foreach ($photo_section_info as $row) : {
                                        ?>
                                                <tr id="<?php echo $row->id ?>">
                                                    <td class="text-center"><img src="<?php echo base_url() . 'images/member/thumb/' . $row->id . $row->img_ext; ?>" style="width: 50px; height: 50px"></td>
                                                    <td class="text-center text-primary"><?php echo $row->member_name; ?></td>
                                                    <td class="text-center text-primary"><?php echo $row->member_designation; ?></td>
                                                    <td class="text-center text-primary"><?php echo $row->member_email; ?></td>
                                                    <td class="text-center "><a class="text-success" href="<?php echo base_url() ?>admin/EditMember/<?php echo $row->id ?>"><i class="ft-edit-3"></i></a></td>

                                                </tr>

                                        <?php }
                                            $count++;
                                        endforeach;
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-content">
                        <?php if ($office_staff_info) { ?>
                            <div class="card-header">
                                <h4 class="card-title">Office Staff</h4>
                                <hr>
                            </div>
                            <div class="card-body table-responsive">

                                <table class="table default-ordering" id="myTable">
                                    <thead>
                                        <tr class="">
                                            <th>Profile</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Designation</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="row_position">
                                        <?php
                                        $count = 1;
                                        foreach ($office_staff_info as $row) : {
                                        ?>
                                                <tr id="<?php echo $row->id ?>">
                                                    <td class="text-center"><img src="<?php echo base_url() . 'images/member/thumb/' . $row->id . $row->img_ext; ?>" style="width: 50px; height: 50px"></td>
                                                    <td class="text-center text-primary"><?php echo $row->member_name; ?></td>
                                                    <td class="text-center text-primary"><?php echo $row->member_designation; ?></td>
                                                    <td class="text-center text-primary"><?php echo $row->member_email; ?></td>
                                                    <td class="text-center "><a class="text-success" href="<?php echo base_url() ?>admin/EditMember/<?php echo $row->id ?>"><i class="ft-edit-3"></i></a></td>
                                                </tr>

                                        <?php }
                                            $count++;
                                        endforeach;
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>




    </section>
</div>