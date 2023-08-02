<style>tbody tr:hover { background: #2b2d3c } .table td {vertical-align: middle; }</style>
<div class="content-wrapper">
    <section id="extended">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Daily Report</h4> <hr class="mb-0">
                    </div>
                    <div class="card-content">
                        <?php if($daily_news_report){ ?> 
                            <div class="card-body ">
                                <div class="d-flex justify-content-between align-items-center pb-2">
                                    <p class="text-warning d-inline-block m-0">Today: <strong> <?php echo date('d M Y, l')?> </strong>  </p>
                                    <form action="<?php echo base_url('daily-report')?>" method="get" class="d-flex justify-content-between align-items-center">
                                        <input type="date" class="form-control" name="date" id="dt" value="<?php if($date) echo $date; ?>">
                                        <button type="submit" class="btn btn-light m-0 ml-2"> <i class="fas fa-filter"></i> </button>
                                    </form>
                                </div>
                                <table class="table table-striped text-center">
                                    <thead>
                                        <tr class="bg-info ">
                                            <th class="text-left">Uploader Info</th>
                                            <th>No. of News</th>
                                            <th>News</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $count = 1;
                                            foreach ($daily_news_report as $row): { ?>
                                                <tr>
                                                    <td class="text-left">
                                                        <div class="ml-3 text-info"> <?php echo $row->user_full_name ?> <br> <span class="text-sm"> <span> 👨🏻 </span>  <span class="text-italic text-muted"> <small><?php echo $row->username ?></small> </span></span> </div>
                                                    </td>
                                                    <td class="text-secondary"><strong><?php echo $row->news_no; ?></strong></td>
                                                    <td> <a class="btn btn-warning btn-sm text-light mb-0" href="<?php echo base_url(); ?>Admin/NewsReport?&userID=<?php echo $row->id; ?>&starting_date=<?php echo $date; ?>&ending_date=<?php echo $date; ?>" target="_blank"> <i class="fas fa-eye"></i>  </a> </td>
                                                </tr>
                                            <?php  }
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


<script>
    document.getElementById('dt').max = new Date(new Date().getTime() - new Date().getTimezoneOffset() * 60000).toISOString().split("T")[0];
</script>