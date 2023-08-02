<?php
function limit_text($text, $limit)
{
	if (strlen($text) > $limit) {
		$text = substr($text, 0, $limit);
		$text = substr($text, 0, - (strlen(strrchr($text, ' '))));
	}
	return $text;
}
?>

<?php
$start_date 	= ($this->input->post('starting_date')) ? $this->input->post('starting_date') : date('Y-m-d', strtotime('-7 days'));  /* 7 days ago */
$end_date 		= ($this->input->post('ending_date')) ? $this->input->post('ending_date') : date("Y-m-d");

$starting_date 	= array('name'	=> 'starting_date', 'id' => 'starting_date', 'value' => $start_date, 'maxlength' => 10, 'size' => 30, 'required' => 'required');
$ending_date 	= array('name'	=> 'ending_date', 'id'	=> 'ending_date', 'value' => $end_date, 'maxlength' => 10, 'size' => 30);

$publisherID	= ($this->input->post('userID')) ? $this->input->post('userID') : '';
$sortTypeValue	= ($this->input->post('sortType')) ? $this->input->post('sortType') : '';
?>

<div class="content-wrapper">
	<section class="inputs-icons">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title mb-0">News Search</h4>
						<hr>
					</div>
					<div class="card-content">
						<div class="px-3">
							<?php
							echo form_open_multipart('Admin/NewsReport');
							?>
							<div class="form-body">
								<div class="row mt-3">
									<div class="col-md-6 col-12">
										<div class="form-group">
											<label for="">Publisher</label>
											<div class="position-relative has-icon-left">
												<?php echo form_dropdown('userID', $all_user_list, $publisherID, 'class="form-control"'); ?>
												<div class="form-control-position"> <i class="ft-search info"></i> </div>
											</div>

										</div>
									</div>
									<div class="col-md-3 col-12">
										<div class="form-group">
											<label for="">Form Date</label>
											<div class="position-relative has-icon-left">
												<?php
												echo form_input(
													array(
														'type' => 'date', 'src' => '../../images/date_picker/cal.gif', 'id' => "starting_date",
														'value' => $starting_date['value'], 'name' => "starting_date", 'required' => "required", 'onclick' => "javascript:NewCssCal('starting_date')"
													),
													'',
													'class="form-control"'
												);
												?>
												<div class="form-control-position"> <i class="ft-search info"></i> </div>
											</div>
										</div>
									</div>

									<div class="col-md-3 col-12">
										<div class="form-group">
											<label for="">To Date</label>
											<div class="position-relative has-icon-left">
												<?php
												echo form_input(array(
													'type' => 'date', 'src' => '../../images/date_picker/cal.gif', 'id' => "ending_date", 'value' => $ending_date['value'],
													'name' => "ending_date", 'required' => "required", 'onclick' => "javascript:NewCssCal('ending_date')"
												), '', 'class="form-control"');
												?>
												<div class="form-control-position"> <i class="ft-search info"></i> </div>
											</div>
										</div>
									</div>

									<div class="col-md-6 col-12">
										<div class="form-group">
											<label for="">Sort by</label>
											<div class="position-relative has-icon-left">
												<?php echo form_dropdown('sortType', $sortType, $sortTypeValue, 'class="form-control"'); ?>
												<div class="form-control-position"> <i class="ft-search info"></i> </div>
											</div>

										</div>
									</div>

									<div class="col-md-3 col-12">
										<div class="form-group">
											<label for="" style="visibility: hidden;">Reset</label>
											<div class="position-relative has-icon-left">
												<!-- <button type="submit" class="btn btn-light" style="width: 100%">Search</button> -->
												<?php echo form_reset('', 'Reset', 'class="btn btn-danger" style="width: 100%"'); ?>
												<div class="form-control-position"></div>
											</div>
										</div>
									</div>

									<div class="col-md-3 col-12">
										<div class="form-group">
											<label for="" style="visibility: hidden;">Reset</label>
											<div class="position-relative has-icon-left">
												<!-- <button type="submit" class="btn btn-light" style="width: 100%">Search</button> -->
												<?php echo form_submit('upload', 'Search', 'class="btn btn-success" style="width: 100%"'); ?>
												<div class="form-control-position"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php echo form_close(); ?>
						</div>

						<?php
						// if($news_list_info){
						//      foreach ($news_list_info as $row): 
						// 	{
						//         echo $row-> news_id.'</br>';
						//     }
						//     endforeach;
						// }
						?>
					</div>
					<?php
					if ($news_list_info) { ?>

						<div class="card-content">
							<div class="card-header">
								<h6 class="card-title mb-0">News Report</h6>
								<hr>
							</div>
							<div class="card-body table-responsive">

								<p class='text-success text-left'> Total Data Found :
									<?php echo sprintf('%02d', COUNT($news_list_info)); ?>
								</p>
								<table class="table text-white">
									<thead>
										<tr class="bg-dark">
											<th class="text-center">SN</th>
											<!-- <th></th> -->
											<th>Headline</th>
											<th class="text-center">Approver</th>
											<th class="text-center">Status</th>
											<th class="text-center">Reader</th>
											<th class="text-center">Edit</th>

										</tr>
									</thead>
									<tbody>
										<?php
										$count = 1;
										foreach ($news_list_info as $row) : {
												$folder_name = ceil($row->news_id / 1000);
										?>
												<tr>

													<td class="text-center">
														<?php echo sprintf('%02d', $count) ?>
													</td>

													<td>
														<strong class="text-info">
															<?php echo $row->cat_name; ?>
														</strong> <br>
														<small>
															<?php echo stripslashes($row->news_headline); ?>
														</small> <br>
														<small style="font-weight:0;font-style: italic;font-size: 12px">
															<i class="fa fa-user"></i>
															<?php echo nbs(2) . $row->publisher_name; ?>
														</small>
													</td>


													<td class="text-center"><span class="text-info"><?php echo nbs(1) . $row->approver_name; ?></span> <br>

														<small style="font-weight:0;font-style: italic;font-size: 11px">
															<?php
															echo date('d-m-Y', strtotime($row->news_mod_date)) . ' Time: ' . date('H:i', strtotime($row->news_mod_time));
															?>
														</small>

													</td>

													<td class="text-center" style="font-weight: 0; font-size: 14px">
														<small class="text-info">
															<?php echo nbs(0) . get_news_status($row->news_status); ?>
														</small><br>
														<small style="font-weight:0;font-style: italic;font-size: 11px">
															<?php
															echo date('d-m-Y', strtotime($row->news_pub_date)) . ' Time: ' . date('H:i', strtotime($row->news_pub_time));
															?>
														</small>
													</td>

													<td class="text-center">
														<?php echo $row->news_reader; ?>
													</td>

													<?php
													if ($user_type == 2 && $row->news_approver != '') {
														echo '<td><p class="text-success">Approved</p></td>';
													} else { 
														if ($row->cat_id == '5') { ?>
															<td class="text-center">
																<a href="<?php echo base_url() ?>Admin/EditOpinion/<?php echo $row->news_id; ?>" class="success p-0" data-original-title="" title=""><i class="ft-edit-2 font-medium-3 mr-2"></i></a>
															</td>
														<?php
														} else { ?>
															<td class="text-center">
																<a href="<?php echo base_url() ?>Admin/EditNews/<?php echo $row->news_id; ?>" class="success p-0" data-original-title="" title=""><i class="ft-edit-2 font-medium-3 mr-2"></i></a>
															</td>
														<?php
														}
														
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
						</div>
					<?php } else { ?>
						<!-- <p class='message-alert text-center'> Sorry ! No Information Found. </p> -->
					<?php } ?>
				</div>
			</div>
		</div>
	</section>
</div>
<?php
function get_news_status($status)
{
	if ($status == 0) $value = 'Inactive';
	else if ($status == 1) $value = 'Lead News';
	else if ($status == 2) $value = 'Top News';
	else if ($status == 3) $value = 'Breaking News';
	else if ($status == 4) $value = 'Hide';
	else if ($status == 5) $value = 'Normal';
	else if ($status == 6) $value = 'Selective News';
	else if ($status == 10) $value = 'Live Update';
	else $value = '---';

	return $value;
}
?>