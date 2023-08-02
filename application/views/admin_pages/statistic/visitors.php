<link rel="stylesheet" href="<?php echo base_url('assets/app-assets/vendors/datepicker/bootstrap-datepicker.min.css')?>">
<script src="<?php echo base_url('assets/app-assets/vendors/datepicker/bootstrap-datepicker.min.js')?>"></script>
<style>
    .datepicker.dropdown-menu {
        background-color: #fff !important;
    }
    .datepicker tbody tr:hover {
        background: #fff !important;
    }
</style>


<style>tbody tr:hover { background: #2b2d3c }</style>
<div class="content-wrapper">
    <section id="extended">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Daily Visitors Report</h4> <hr class="mb-0">
                    </div>
                    <div class="card-content">

                        <div class="card-body ">
                            <div class="d-flex justify-content-between align-items-center pb-2">
                                <p class="text-warning d-inline-block m-0">Today: <strong> <?php echo date('d M Y, l')?> </strong>  </p>
                                <form action="<?php echo base_url('daily-visitors-list')?>" method="get" class="d-flex justify-content-between align-items-center">
                                    <div class="input-group input-daterange m-0">
                                        <input type="date" class="form-control" name="from_date" value="<?php if($from_date) echo $from_date; ?>" placeholder="From Date" required autocomplete="off">
                                        <div class="input-group-addon text-dark px-2 d-flex align-items-center">-</div>
                                        <input type="date" class="form-control" name="to_date" value="<?php if($to_date) echo $to_date; ?>" placeholder="To Date" required autocomplete="off">
                                    </div>
                                    <button type="submit" class="btn btn-light m-0 ml-2"> <i class="fas fa-filter"></i> </button>
                                </form>
                            </div>
                            <?php if($daily_visitors_list){ ?> 
                                <table class="table table-stripped text-center">
                                    <thead>
                                        <tr class="bg-info">
                                            <th class="text-left">Date</th>
                                            <th></th>
                                            <th>No. of Visitors</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $count = 1;
                                            foreach ($daily_visitors_list as $row): { ?>
                                                <tr class="text-sm">
                                                    <td class="text-left text-secondary"> <h5 class="mb-0"> <?php echo '<i class="fa fa-calendar text-secondary" style="font-size: 14px"></i> '.date(' d M Y', strtotime($row->day_date)); ?> </h5></td>
                                                    <td>-</td>
                                                    <td class="text-warning fs-3"><strong><?php echo sprintf('%02d', $row->day_visitor); ?></strong></td>
                                                </tr>
                                            <?php  }
                                            endforeach;   
                                        ?>
                                    </tbody>
                                </table>
                            <?php echo '<div class="pagi text-center">'.$this->pagination->create_links().'</div>'; ?>
                            <?php }  ?>
                        </div>
                        
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $('.input-daterange input').each(function() {
        $(this).datepicker();
    });
</script>