<?php
    foreach($spc_user_data as $row){

        // if ($use_username) {
        $username = array(
            'name'	=> 'username',
            'id'	=> 'username',
            'value' => $row-> username,
            'maxlength'	=> $this->config->item('username_max_length', 'tank_auth'),
            'size'	=> 30,
        );
        // }
        $email = array(
            'name'	=> 'email',
            'id'	=> 'email',
            'value' => $row-> email,
            'maxlength'	=> 80,
            'size'	=> 30,
        );

        $contact = array(
            'type'          => 'number',
            'min'           => '0',
            'name'	        => 'contact_no',
            'id'	        => 'contact',
            'value'	        => $row->user_mobile,
            'maxlength'	    => 15,
            'size'	        => 30,
            'autocomplete'  => 'off'
        );

        $password = array(
            'name'	=> 'new_password',
            'id'	=> 'password',
            'value' => '',
            'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
            'size'	=> 30,
        );
        $confirm_password = array(
            'name'	=> 'confirm_new_password',
            'id'	=> 'confirm_password',
            'value' => '',
            'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
            'size'	=> 30,
        );
        $captcha = array(
            'name'	=> 'captcha',
            'id'	=> 'captcha',
            'maxlength'	=> 8,
        );

        $user_full_name = array(
            'name'	=> 'user_full_name',
            'id'	=> 'user_full_name',
            'value' => $row-> user_full_name,
            'maxlength'	=> 100,
            'size'	=> 30,
        );

        $user_address = array(
            'name'	=> 'user_address',
            'id'	=> 'user_address',
            'value' => $row-> user_address,
            'maxlength'	=> 150,
            'size'	=> 30,
            'rows'	=> 5,
            'cols'	=> 22,
        );

        $user_type2 = array(
            'name'	=> 'user_type2',
            'id'	=> 'user_type2',
            'value' => $row-> user_type,
            'maxlength'	=> 8,
            'size'	=> 30,
        );

        $id = array(
            'name'  =>  'id',
            'value' => $row-> id,
        );

        if($row->user_full_name){
            $user_name = $row->user_full_name;
        }
        else{
            $user_name = 'Default';
        }
        

        if($row->img_ext){
            $img_lg     =   base_url('images/users/'.$row->id.$row->img_ext);
            $img        =   base_url('images/users/thumb/'.$row->id.$row->img_ext);
        }else{

            $img_lg     =   base_url('assets/panel/images/user.png');
            $img        =   base_url('assets/panel/images/user.png');
        }

        if($user_type == 7 OR $user_type == 5)	            $allUserType [''] = 'Select a user type';
        if($user_type == 7)                                 $allUserType ['7'] = 'Super Admin';
        if($user_type == 7 || $user_name == $this_user)     $allUserType ['5'] = 'Admin';
        if($user_type == 7 OR $user_type == 5)	            $allUserType ['3'] = 'News Editor';
        if($user_type == 7 OR $user_type == 5)	            $allUserType ['2'] = 'Reporter';
        if($user_type == '')                                $allUserType ['1'] = '';

    }
    

?>
<div class="content-wrapper">
    <section id="basic-form-layouts">
        <div class="row">
            <div class="col-sm-12">
            <div class="content-header">User Module</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <div class="px-3">
                            <?php echo form_open_multipart('auth/edit_user_data/'.$id['value']);?>
                                
                                <div class="form-body">
                                    <h4 class="form-section" style="margin-top: 10px"><i class="fas fa-newspaper"></i>Edit User</h4>

                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php echo form_label('User Type *', $user_type2['id']); ?>
                                                <?php  echo form_dropdown('user_type2',$allUserType,$user_type2['value'], 'class="form-control"'); ?>
                                                <small class="text-danger" style="font-size: 11px">
                                                    <?php if(form_error('user_type2')){ echo form_error('user_type2'); } ?>
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php echo form_label('Username *', $username['id']); ?>
                                                <?php echo form_input($username ,$username['value'] ,'class="form-control"'); ?>
                                                <small class="text-danger" style="font-size: 11px">
                                                    <?php if(form_error($username['name'])) { echo form_error($username['name']); } ?>
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <?php echo form_label('User Full Name *', $user_full_name['id']); ?>
                                                <?php echo form_input($user_full_name ,$row-> user_full_name,'class="form-control"'); ?>
                                                <small class="text-danger" style="font-size: 11px">
                                                    <?php if(form_error($user_full_name['name'])) { echo form_error($user_full_name['name']); } ?>
                                                </small>
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php echo form_label('User Address *', $user_address['id']); ?>
                                                <?php echo form_input($user_address,'','class="form-control"'); ?>
                                                <small class="text-danger" style="font-size: 11px">
                                                    <?php if(form_error($user_address['name'])) { echo form_error($user_address['name']); } ?>
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php echo form_label('Email Address', $email['id']); ?>
                                                <?php echo form_input($email,'' ,'class="form-control"'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php echo form_label('Contact No.', $contact['id']); ?>
                                                <?php echo form_input($contact,'' ,'class="form-control"'); ?>
                                            </div>
                                        </div>
                                        

                                    </div>
                                    <!--- END OF CLASS ROW ---->
                            
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php echo form_label('New Password *', $password['id']); ?>
                                                <?php echo form_password($password, '','class="form-control"'); ?>
                                                <small class="text-danger" style="font-size: 11px">
                                                    <?php if(form_error($password['name'])){ echo form_error($password['name']); } ?>
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php echo form_label('New Confirm Password *', $confirm_password['id']); ?>
                                                <?php echo form_password($confirm_password, '','class="form-control"'); ?>
                                                <small class="text-danger" style="font-size: 11px">
                                                    <?php if(form_error($confirm_password['name'])){ echo form_error($confirm_password['name']); } ?>
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="projectinput1">Profile Image <small class="text-warning">(100x100)</small> </label>

                                                <?php
                                                    $file_data = array('name' => 'user_avatar', 'id'=>'img_file', 'accept' => '.png, .jpg, .jpeg', 'onChange'=> 'img_pathUrl(this)');
                                                    echo form_upload($file_data);
                                                ?>
                                            </div>
                                        </div>

                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <a href="<?php echo $img_lg; ?>" download="<?php echo $user_name; ?>">
                                                    <img src="<?php echo $img; ?>" id="img_url" style="width: 50px; height: 50px; margin-top: 1rem;">
                                                </a>
                                                
                                            </div>
                                        </div>

                                    
                                    </div>

                                    <!--- END OF CLASS ROW ---->
                                </div>
                            
                                
                                <div class="form-actions">
                                    <?php echo form_reset('reset ', 'Reset','class="btn btn-raised btn-raised btn-warning mr-1"'); ?>
                                    <?php echo form_submit('register', 'Update','class="btn btn-raised btn-raised btn-primary"'); ?>
                                </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    function img_pathUrl(input){
        $('#img_url')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
    }
</script>