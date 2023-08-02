<style>tbody tr:hover { background: #2b2d3c }</style>
<div class="content-wrapper">
    <section id="extended">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Daily Categorywise Report</h4> <hr class="mb-0">
                    </div>
                    <div class="card-content">
                        <?php if($report){ ?> 
                            <div class="card-body ">
                                <div class="d-flex align-items-center pb-2">
                                    <form action="<?php echo base_url('daily-category-report')?>" method="get" class="d-flex justify-content-between align-items-center">
                                        <input type="date" class="form-control" name="date" id="dt" value="<?php if($date) echo $date; ?>">
                                        <button type="submit" class="btn btn-light m-0 ml-2 d-flex align-items-center"> <i class="fas fa-filter mr-1"> </i> Filter</button>
                                    </form>
                                </div>
                                <table class="table  text-center">
                                    <thead>
                                        <tr class=" ">
                                            <th class="text-left">Category Name</th>
                                            <th>No. of News</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $count = 1;
                                            foreach ($report as $row): { ?>
                                                <tr>
                                                    <td class="text-left">
                                                        <div class="ml-3 text-info"> <?php echo $row->cat_name ?> <br> <span class="text-sm"> <span class="text-italic text-muted"> <small><?php echo $row->cat_key_name ?></small> </span> </span> </div>
                                                    </td>
                                                    <td class="text-primary"><strong><?php echo $row->news_no; ?></strong></td>
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