<?php
	$news_id_name			=  ($this->input->get('news_id')) ? $this->input->get('news_id') : '';
	$category_info_name		=  ($this->input->get('cat_id')) ? $this->input->get('cat_id') : '';
	$sub_category_name		=  ($this->input->get('sub_cat_id') != '') ? $this->input->get('sub_cat_id') : '';
	$author_id				=  ($this->input->get('author_id') != '') ? $this->input->get('author_id') : '';
	$page_id				=  ($this->input->get('page_id') != '') ? $this->input->get('page_id') : '';
	$news_status_name		=  ($this->input->get('news_status')!='') ? $this->input->get('news_status') : '';

	$start_date 			=  ($this->input->get('starting_date')) ? $this->input->get('starting_date') : '';  /* 7 days ago */
	$end_date 				=  ($this->input->get('ending_date')) ? $this->input->get('ending_date') : '';

	$starting_date 			=  array('name'	=> 'starting_date', 'id' => 'starting_date', 'value' => $start_date, 'maxlength' => 10, 'size' => 30, 'required' => 'required');
	$ending_date 			=  array('name'	=> 'ending_date', 'id'	=> 'ending_date', 'value' => $end_date, 'maxlength' => 10, 'size' => 30);

	$publisherID			=  ($this->input->get('userID')) ? $this->input->get('userID') : '';
	$sortTypeValue			=  ($this->input->get('sortType')) ? $this->input->get('sortType') : '';
?>
<div class="content-wrapper">
	<section class="inputs-icons">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title mb-0">Search</h4>
						<hr class="mb-0">
					</div>
					<div class="card-content">
						<div class="px-3">
							<?php
							echo form_open_multipart(base_url('news-filter'), array('method'=>'get'));
							?>
							<div class="form-body">
								<?php echo form_hidden('news_id')?>
								<div class="row mt-1">
									<div class="col-md-4 col-12">
										<div class="form-group">
											<?php if ($this->uri->segment(3) == "cat" || $this->uri->segment(3) == "") { ?>
												<label for="projectinput2">Select Category </label>
												<div class="position-relative has-icon-left">
													<?php if ($category_info) {
														echo form_dropdown('cat_id', $category_info, $category_info_name, ' onclick="ClearInput()" class="form-control cat" id="select1" ');
													} ?>
													<div class="form-control-position"> <i class="ft-search info"></i> </div>
												</div>
											<?php } ?>
										</div>
									</div>

									<div class="col-md-4">
                                        <div class="form-group">
                                            <label for="projectinput6">Sub Category</label>
											<div class="position-relative has-icon-left">
												<?php if ($sub_category_info) {
													echo form_dropdown('sub_cat_id', $sub_category_info, $sub_category_name, ' onclick="ClearInput()" class="form-control subcat" id="select2" ');
												}else{ ?>
													<select name="sub_cat_id" class="form-control subcat" id="select2">
														<option value="">Select One</option>
													</select>
												<?php } ?>
												<div class="form-control-position"> <i class="ft-search info"></i> </div>
											</div>
                                        </div>
                                    </div>

									<div class="col-md-4 col-12">
										<div class="form-group">
											<?php
											if ($this->uri->segment(3) == "type" || $this->uri->segment(3) == "") {
												$news_status = array(
													'' 	=> 'Select One',
													5	=> 'Normal',
													0 	=> 'Inactive',
													1 	=> 'Lead News',
													2 	=> 'Top News',
													6 	=> 'Selective News',
													7 	=> 'Breaking News',
												);
											?>
												<label for="projectinput2">Select Status</label>
												<div class="position-relative has-icon-left">
													<?php echo form_dropdown('news_status', $news_status, $news_status_name, ' onclick="ClearInput()" class="form-control" id="select3"'); ?>
													<div class="form-control-position"> <i class="ft-search info"></i> </div>
												</div>
											<?php } ?>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-4">
                                        <div class="form-group">
                                            <label for="projectinput6">Reporter / Writer</label>

											<div class="position-relative has-icon-left">
												<?php if ($writerList) {
													echo form_dropdown('author_id', $writerList, $author_id, ' class="form-control author"  ');
												}else{ ?>
													<select name="author_id" class="form-control author" >
														<option value="">Select One</option>
													</select>
												<?php } ?>
												<div class="form-control-position"> <i class="ft-search info"></i> </div>
											</div>
                                        </div>
                                    </div>

									<div class="col-md-4 col-12">
										<div class="form-group">
											<label for="projectinput2">News Page</label>
											<div class="position-relative has-icon-left">
												<?php  
													echo form_dropdown('page_id', $pageList, $page_id, 'class="form-control" ');
												?>
												<div class="form-control-position"> <i class="ft-search info"></i> </div>
											</div>
										</div>
									</div>

									<div class="col-md-4 col-12">
										<div class="form-group">
											<label for="">Uploader</label>
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
														'type' => 'date', 'value' => $starting_date['value'], 'name' => "starting_date", 
													), '', 'class="form-control"'
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
														'type' => 'date', 'value' => $ending_date['value'], 'name' => "ending_date",
													), '', 'class="form-control"');
												?>
												<div class="form-control-position"> <i class="ft-search info"></i> </div>
											</div>
										</div>
									</div>

									<div class="col-md-3 col-12">
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
											<div class="position-relative has-icon-left">
												<label style="visibility: hidden" for="projectinput2">Submit</label>
												<?php echo form_submit('upload', 'Search', 'class="btn btn-success" style="width: 100%"'); ?>
												<div class="form-control-position"></div>
											</div>
										</div>
									</div>


								</div>


							</div>
							<?php echo form_close(); ?>
						</div>
					</div>
					<?php
					if (isset($news_list_info)) { ?>

						<div class="card-content">
							<?php if ($news_list_info) { ?>
								<div class="card-body table-responsive">
									<div class="alert alert-info text-center" role="alert">
										<span class="text-light"> <strong>Total News Found : <?php echo sprintf('%02d', COUNT($news_list_info)); ?> </strong></span>
									</div>
									<table class="table">
										<thead>
											<tr class="bg-dark">
												<th class="text-center">SN</th>
												<th>Headline</th>
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

														<td class="text-center"><?php echo sprintf('%02d', $count) ?></td>

														<td>
															<strong class="text-info"><?php echo $row->cat_name; ?></strong> <br>
															<small><?php echo stripslashes($row->news_headline); ?></small> <br>
															<small style="font-weight:0;font-style: italic;font-size: 12px">
																<i class="fa fa-user"></i><?php echo nbs(2) . $row->user_full_name; ?>
															</small>
														</td>

														<td class="text-center" style="font-weight: 0; font-size: 14px">
															<small class="text-info"><?php echo nbs(0) . get_news_status($row->news_status); ?></small><br>
															<small style="font-weight:0;font-style: italic;font-size: 11px">
																<?php echo date('d-m-Y h:i', strtotime($row->news_pub_date)); ?>
															</small>
														</td>
														
														<td class="text-center"><?= $row->news_reader; ?></td>


														<td class="text-center">
															<?php
															if ($user_type == 2 && $row->news_approver != 0) {
																echo '<p class="text-success">Approved</p>';
															} else { 
																if ($row->cat_id == '5') {
																?>
																	<a href="<?php echo base_url() ?>Admin/EditOpinion/<?php echo $row->news_id; ?>" class="success p-0" data-original-title="" title=""><i class="ft-edit-2 font-medium-3 mr-2"></i></a>
																<?php
																} else {
																?>
																	<a href="<?php echo base_url() ?>Admin/EditNews/<?php echo $row->news_id; ?>" class="success p-0" data-original-title="" title=""><i class="ft-edit-2 font-medium-3 mr-2"></i></a>
																<?php
																}
																
															}
															?>
														</td>

													</tr>

											<?php }
												$count++;
											endforeach;
											?>

										</tbody>
									</table>
								</div>
							<?php }
							if(empty($news_list_info)){ ?>
									<div class=" card-body table-responsive text-center">
										<div class="alert alert-danger" role="alert">
											<strong class="text-light">No Data Found</strong>
										</div>
									</div>
							<?php }

							?>
						</div>
					<?php }
					?>
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
		else if ($status == 7) $value = 'Breaking News';
		else if ($status == 10) $value = 'Live Update';
		else $value = '---';

		return $value;
	}
?>