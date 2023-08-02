    <!-- Theme customizer Starts-->
    <div class="customizer border-left-blue-grey border-left-lighten-4 d-none d-sm-none d-md-block"><a class="customizer-close"><i class="ft-x font-medium-3"></i></a><a id="customizer-toggle-icon" class="customizer-toggle bg-danger"><i class="ft-settings font-medium-4 fa fa-spin white align-middle"></i></a>
      <div data-ps-id="df6a5ce4-a175-9172-4402-dabd98fc9c0a" class="customizer-content p-3 ps-container ps-theme-dark">
        <h4 class="text-uppercase mb-0 text-bold-400">iNews</h4>
        <p>An Online News Portal Panel</p>
        <hr>
        <!-- Layout Options-->
        <h6 class="text-center text-bold-500 mb-3 text-uppercase">Layout Options</h6>
        <div class="layout-switch ml-4">
          <div class="custom-control custom-radio d-inline-block custom-control-inline light-layout">
            <input id="ll-switch" type="radio" name="layout-switch" checked class="custom-control-input">
            <label for="ll-switch" class="custom-control-label">Light</label>
          </div>
          <div class="custom-control custom-radio d-inline-block custom-control-inline dark-layout">
            <input id="dl-switch" type="radio" name="layout-switch" class="custom-control-input">
            <label for="dl-switch" class="custom-control-label">Dark</label>
          </div>
          <!-- <div class="custom-control custom-radio d-inline-block custom-control-inline transparent-layout">
            <input id="tl-switch" type="radio" name="layout-switch" class="custom-control-input">
            <label for="tl-switch" class="custom-control-label">Transparent</label>
          </div> -->
        </div>
        <hr>
        <!-- Sidebar Options Starts-->

        <div class="cz-bg-image row sb-bg-img">
          <div class="col-sm-2 mb-3"><img src="<?= base_url('assets/app-assets/img/sidebar-bg/01.jpg'); ?>" width="90" class="rounded sb-bg-01"></div>
          <div class="col-sm-2 mb-3"><img src="<?= base_url('assets/app-assets/img/sidebar-bg/02.jpg'); ?>" width="90" class="rounded sb-bg-02"></div>
          <div class="col-sm-2 mb-3"><img src="<?= base_url('assets/app-assets/img/sidebar-bg/03.jpg'); ?>" width="90" class="rounded sb-bg-03"></div>
          <div class="col-sm-2 mb-3"><img src="<?= base_url('assets/app-assets/img/sidebar-bg/04.jpg'); ?>" width="90" class="rounded sb-bg-04"></div>
          <div class="col-sm-2 mb-3"><img src="<?= base_url('assets/app-assets/img/sidebar-bg/05.jpg'); ?>" width="90" class="rounded sb-bg-05"></div>
          <div class="col-sm-2 mb-3"><img src="<?= base_url('assets/app-assets/img/sidebar-bg/06.jpg'); ?>" width="90" class="rounded sb-bg-06"></div>
        </div>
        <!-- Transparent BG Image Ends-->

        <!-- Sidebar BG Image Toggle Starts-->
        <div class="togglebutton toggle-sb-bg-img">
          <div class="switch"><span>Sidebar Bg Image</span>
            <div class="float-right">
              <div class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                <input id="sidebar-bg-img" type="checkbox" checked class="custom-control-input cz-bg-image-display">
                <label for="sidebar-bg-img" class="custom-control-label"></label>
              </div>
            </div>
          </div>
          <hr>
        </div>
        <!-- Sidebar BG Image Toggle Ends-->
        <!-- Compact Menu Starts-->
        <div class="togglebutton">
          <div class="switch"><span>Compact Menu</span>
            <div class="float-right">
              <div class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                <input id="cz-compact-menu" type="checkbox" class="custom-control-input cz-compact-menu">
                <label for="cz-compact-menu" class="custom-control-label"></label>
              </div>
            </div>
          </div>
        </div>
        <!-- Compact Menu Ends-->
        <p class="pt-5" style="top: 0">
          <center>
            <div style=" font-size: 22px">
              Developed by <a style="    color: #0288d1 !important;" href="https://itlabsolutions.com" target="_blank">IT Lab Solutions Ltd.</a>
            </div>
          </center>
        </p>
        <!-- Sidebar Width Ends-->
      </div>
    </div>
    <!-- Theme customizer Ends-->
    </div>

    <!-- BEGIN VENDOR JS -->
    <script src="<?= base_url('assets/app-assets/vendors/js/core/jquery-3.2.1.min.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/app-assets/js/jquery-ui.min_1.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/app-assets/vendors/js/core/popper.min.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/app-assets/vendors/js/core/bootstrap.min.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/app-assets/vendors/js/perfect-scrollbar.jquery.min.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/app-assets/vendors/js/jquery.matchHeight-min.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/app-assets/vendors/js/screenfull.min.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/app-assets/vendors/js/sweetalert2.min.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/app-assets/vendors/tokenhead/bootstrap-tokenfield.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/app-assets/vendors/tokenhead/scrollspy.js'); ?>" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- BEGIN VENDOR JS-->


    <?php
        if($this->uri->segment(2) == 'WriterSetup' || $this->uri->segment(2) == 'EditWriter'){ ?>
            <script src="<?= base_url('assets/app-assets/vendors/summernote/summernote.min.js'); ?>" type="text/javascript"></script>
            <script>
              $('#summernote').summernote({
                placeholder: 'write here...',
                height: 150,
              });
            </script>
        <?php }
    ?>

    <script>
      $(".accordion-row").on("click",
          function() {
            var id = $(this).data().id;
            $('.accordion'+id).show();
      });
      $(".undo-row").on("click",
          function() {
            var id = $(this).data().id;
            $('.accordion'+id).hide();
      });
    </script>

    <script>
      $(".aut").change(function() {
          var aut = $('.aut').val();
          var rep = $('.rep').val();
          if (aut != '') {
            $(".rep").attr("disabled", "disabled");
          }
          else {
            $(".rep").removeAttr("disabled");
          }
      }).trigger("change");
      $(".rep").change(function() {
          var aut = $('.aut').val();
          var rep = $('.rep').val();
          if (rep != '') {
            $(".aut").attr("disabled", "disabled");
          }
          else {
            $(".aut").removeAttr("disabled");
          }
      }).trigger("change");
    </script>
    


    <!-- BEGIN PAGE VENDOR JS-->
    <script src="<?= base_url('assets/app-assets/vendors/js/datatable/datatables.min.js'); ?>" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->


    <!-- BEGIN APEX JS-->
    <script src="<?= base_url('assets/app-assets/js/app-sidebar.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/app-assets/js/customizer.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/app-assets/js/chosen.jquery.js'); ?>" type="text/javascript"></script>
   
    <!-- END APEX JS-->
    <script src="<?= base_url('assets/app-assets/js/dashboard1.js'); ?>" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- END PAGE LEVEL JS-->

    <?php
    if ($this->uri->segment(2) == 'ePaperSetup') { ?>
      <script src="<?= base_url('assets/app-assets/vendors/dropzone/dropzone.min.js'); ?>" type="text/javascript"></script>
    <?php }
    ?>

    <?php 
      if($this->uri->segment(1) == 'news-upload' || $this->uri->segment(1) == 'opinion-upload' || $this->uri->segment(2) == 'EditOpinion' || $this->uri->segment(2) == 'EditNews'){ ?>
      <script>
          var editor = CKEDITOR.replace('editor1');
          CKFinder.setupCKEditor(editor);
      </script>
    <?php } ?>


    <script>
      $(".row_position").sortable({
        stop: function() {
          var selectedData = new Array();
          $('.row_position>tr').each(function() {
            selectedData.push($(this).attr("id"));
          });
          updateOrder(selectedData);
        }
      });

      function updateOrder(data) {
        $.ajax({
          url: "<?php echo base_url('Admin/updateRank'); ?>",
          type: 'post',
          data: {
            position: data
          },
          success: function(result) {
            alert('OK');
          }
        })
      }
    </script>


    <script>
      $(".position").sortable({
        
        stop: function() {
          var selectedData = new Array();
          $('.position>.dragdrop').each(function() {
            selectedData.push($(this).attr("id"));
          });
          updateOrderData(selectedData);
        }
      });

      function updateOrderData(data) {
        $.ajax({
          url: "<?php echo base_url('Admin/updatePagePosition'); ?>",
          type: 'post',
          data: {
            position: data
          },
          success: function(result) {
            swal(
              'Done',
              'Position Updated',
              'success'
            )
          }
        })
      }
    </script>




    <script>
      $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
      });
    </script>


    <!-- Sweet alert for success message  -->
    <?php if ($this->session->userdata('success_message')) {
      $msg = $this->session->userdata('success_message');
    ?>
      <script>
        swal(
          'Done',
          '<?php echo $msg; ?>',
          'success'
        )
      </script>
    <?php }
    $this->session->unset_userdata('success_message') ?>



    <?php if ($this->session->userdata('error_message')) {
      $msg = $this->session->userdata('error_message');
    ?>
      <script>
        swal(
          'Error!',
          '<?php echo $msg; ?>',
          'error',
          confirmButtonColor: '#FF586B',
        )
      </script>

    <?php }
    $this->session->unset_userdata('error_message') ?>


    <!-- Sweetalert for confirm update  -->
    <script>
      $(document).on("click", "#confirm-text", function(e) {
        e.preventDefault();
        var link = $(this).attr("href");
        swal({
          title: 'Are you sure to update?',
          text: "",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#0CC27E',
          cancelButtonColor: '#FF586B',
          confirmButtonText: 'Yes',
          cancelButtonText: "No"
        }).then(function(isConfirm) {
          if (isConfirm) {
            window.location.href = link;
            swal(
              'Changed!',
              'Status Changed Successfully',
              'success'
            );
          }
        }).catch(swal.noop);
      });
    </script>
    <script>
      $(document).on("click", "#confirm-change", function(e) {
        e.preventDefault();
        var link = $(this).attr("href");
        swal({
          // title: 'Are you sure to update?',
          text: "Are you sure to change setting ?",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#0CC27E',
          cancelButtonColor: '#FF586B',
          confirmButtonText: 'Yes',
          cancelButtonText: "No"
        }).then(function(isConfirm) {
          if (isConfirm) {
            window.location.href = link;
            swal(
              'Changed!',
              'Changed Successfully',
              'success'
            );
          }
        }).catch(swal.noop);
      });
    </script>
    <!-- Sweetalert for confirm update  -->
    <!-- End Sweet alert  -->


    <script>
      $(document).on("click", "#delete", function(e) {
        e.preventDefault();
        var link = $(this).attr("href");
        swal({
          // title: 'Are you sure ?',
          text: "Are you sure to Remove ? ",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#0CC27E',
          cancelButtonColor: '#FF586B',
          cancelButtonText: "No, cancel",
          confirmButtonText: 'Yes',

        }).then(function(isConfirm) {
          if (isConfirm) {
            window.location.href = link;
            swal(
              'Changed!',
              'Remove Successfully',
              'success'
            );
          }
        }).catch(swal.noop);
      });
    </script>

    <script>
      $(document).on("click", "#status", function(e) {
        e.preventDefault();
        var link = $(this).attr("href");

        swal({
          // title: 'Are you sure ?',
          text: "Are you want to change status ? ",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#0CC27E',
          cancelButtonColor: '#FF586B',
          cancelButtonText: "No, cancel",
          confirmButtonText: 'Yes',

        }).then(function(isConfirm) {
          if (isConfirm) {
            window.location.href = link;
            swal(
              'Changed!',
              'Status Changed Successfully',
              'success'
            );
          }
        }).catch(swal.noop);

      });
    </script>

    <script>
      $('.reporter_auto').tokenfield({
        autocomplete: {
          delay: 100
        },
        showAutocompleteOnFocus: true
      })
    </script>
    <script>
      $('.tokenfield1').tokenfield({
        autocomplete: {
          delay: 100
        },
        showAutocompleteOnFocus: true
      })
    </script>

    <script>
      $('.tokenfield2').tokenfield({
        autocomplete: {
          // source: ['red', 'blue', 'green', 'yellow', 'violet', 'brown', 'purple', 'black', 'white'],
          delay: 100
        },
        showAutocompleteOnFocus: true
      })
    </script>

    <script>
      $(document).ready(function() {
        $('.cat').change(function() {
          var cat_id = $('.cat').val();
          if (cat_id != '') {
            $.ajax({
              url: "<?php echo base_url(); ?>Admin/fetch_subcat",
              method: "POST",
              data: {
                cat_id: cat_id
              },
              success: function(data) {
                $('.subcat').html(data);
              }
            });
          } else {
            $('.subcat').html('<option value="">Select One</option>');
          }
        });
      });
    </script>

    <!-- Fetch Author By Category  -->
    <script>
      $(document).ready(function() {
        $('.cat').change(function() {
          var cat_id = $('.cat').val();

         
            $.ajax({
              url: "<?php echo base_url(); ?>Admin/fetch_author_by_cat",
              method: "POST",
              data: {
                cat_id: cat_id
              },
              success: function(data) {
                $('.author').html(data);
              }
            });
          
        });
      });
    </script>

    <!-- Fetch Author By Category  -->

   
        <script>
          $('.switch').click(function(){
            var id = $(this).val();
            if (confirm("Are You Sure")) {
              $.ajax({
                  url: "<?php echo base_url(); ?>Admin/edit_status_share",
                  type: "post",
                  data: {
                    id: id
                  },
                  success: function(data){
                      $('.switch').removeClass('selected');
                      location.reload();
                  }
              });
            }
            
          });
        </script>
        

        <script>
          $('.select2').select2({
            // placeholder: 'Select an option'
          });
        </script>



        <script src="<?= base_url('assets/panel/js/custom.js'); ?>" ></script>

        <?php
          if($this->uri->segment(2) == 'AdsList' || $this->uri->segment(2) == 'GalleryList'){ ?>
            <script src="<?= base_url('assets/app-assets/vendors/lightbox/jquery.magnific-popup.min.js'); ?>"></script>
            <script>
              $(document).ready(function() {
                  $('.fluffychicken').magnificPopup({ 
                    type: 'image'
                  });
              });
            </script>
          <?php }
        ?>
        

    </body>
    <!-- END : Body-->

    </html>