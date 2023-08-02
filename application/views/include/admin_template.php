<?php $this->load->view('include/admin_leftbar') ?>
<?php $this->load->view('include/admin_header');  ?>
<div class="main-panel">
    <div class="main-content">
        <?php
        $this->load->view($content);
        ?>
    </div>
</div>
<?php $this->load->view('include/admin_footer') ?>