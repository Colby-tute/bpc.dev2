<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<?= $header; ?>
<style type="text/css">
	.main-modal-calendar-event .modal-content {
		border-width: 0;
		position: relative;
		background-color: #285cf7;
	}

	.ql-wrapper-demo .ql-container {
		height: 150px;
	}

	.border-bottom {
		border-bottom: 1px solid #e2e8f5 !important;
		padding-bottom: 0px !important;
	}

	.main-modal-calendar-event .event-type {
		color: #FFF;
		font-size: 18px;
		font-weight: 500;
		margin-bottom: 0;
		line-height: 1;
	}

	.main-modal-calendar-event .event-title {
		color: #1c273c;
		margin-bottom: 15px;
		line-height: 1;
	}

	.event-desc p {
		margin-bottom: 0px;
	}
</style>
<!-- Container opened -->
<div class="container">

	<!-- breadcrumb -->

	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">Calendar</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('incubator/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">Calendar</li>
				</ol>
			</nav>

		</div>
		<!-- <div class="d-flex my-auto breadcrumb-right">
			<button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-envelope"></i> </span><span class="btn-text">Email </span></button>
			<button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-print"></i> </span><span class="btn-text">Print </span></button>
			<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-download"></i> </span><span class="btn-text">Export </span></button>
		</div> -->
	</div>
	<!-- breadcrumb -->

	<div class="main-content-app pd-b-0  main-content-calendar pt-0">
		<!-- row -->
		<div class="row row-sm">
			<div class="col-lg-12 col-xl-4">
				<div class=" card card--calendar p-0 mg-b-20">
					<?php if ($this->session->flashdata('danger')) { ?>
						<div id="infoMessage" class="alert alert-danger"
							 style="margin: 0px;"><?php echo $this->session->flashdata('danger'); ?></div>
					<?php } else if ($this->session->flashdata('success')) { ?>
						<div id="infoMessage" class="alert alert-success"
							 style="margin: 0px;"><?php echo $this->session->flashdata('success'); ?></div>
					<?php }
					?>
					<?php //print_r($userdt);
					if (!empty($userdt)) { ?>
						<div class="p-4 n4 border-bottom">
							<h2 class="main-content-title mg-b-15 tx-16">Edit Event</h2>
						</div>
						<?php echo form_open_multipart("incubator/Calendar/Update/" . $userdt[0]->tbl_calender_id, 'class="login" data-toggle="validator"');

						foreach ($userdt as $key => $td) {
							?>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group" style="margin: 5px 15px;">
										<label class="form-label" style="margin: 10px auto;">Incubator / BDSP</label>
										<select id="tbl_calender_user_unique_id" name="tbl_calender_user_unique_id"
												class="form-control">
											<option value="">Select</option>
											<optgroup label="Incubator">
												<?php
												foreach ($inc as $k => $in) { ?>
													<option value="<?php echo $in->tbl_users_user_uniqueid; ?>"<?php if ($in->tbl_users_user_uniqueid == $td->tbl_calender_user_unique_id) {
														echo "selected";
													}
													?>>
														<?php echo $in->tbl_users_firstname . ' ' . $in->tbl_users_lastname; ?></option>
												<?php } ?>
											</optgroup>
											<optgroup label="BDSP">
												<?php
												foreach ($bdsp as $key => $dbs) { ?>
													<option value="<?php echo $dbs->tbl_users_user_uniqueid; ?>"<?php if ($dbs->tbl_users_user_uniqueid == $td->tbl_calender_user_unique_id) {
														echo "selected";
													} ?>><?php echo $dbs->tbl_users_firstname . ' ' . $dbs->tbl_users_lastname; ?></option>
												<?php } ?>
											</optgroup>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group" style="margin: 5px 15px;">
										<label class="form-label" style="margin: 10px auto;">SMME</label>
										<select id="tbl_calender_smme_unique_id" name="tbl_calender_smme_unique_id"
												class="form-control">
											<option value="">Select</option>
											<?php
											foreach ($smme as $ke => $value) { ?>
												<option value="<?php echo $value->tbl_users_user_uniqueid; ?>"<?php if ($value->tbl_users_user_uniqueid == $td->tbl_calender_smme_unique_id) {
													echo "selected";
												} ?>><?php echo $value->tbl_users_firstname . ' ' . $value->tbl_users_lastname; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group" style="margin: 5px 15px;">
										<label class="form-label" style="margin: 10px auto;">Start Date</label>

										<input class="form-control" name="tbl_calender_start_datetime"
											   id="datetimepicker2" type="text"
											   value="<?php echo $td->tbl_calender_start_datetime; ?>" required="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group" style="margin: 5px 15px;">

										<label class="form-label" style="margin: 10px auto;">End Date</label>
										<input type="text" class="form-control" name="tbl_calender_end_datetime"
											   id="datetimepicker" value="<?php echo $td->tbl_calender_end_datetime; ?>"
											   required="">
									</div>
								</div>
							</div>
							<div class="form-group" style="margin: 5px 15px;">
								<div class="row">
									<div class="col-md-12">
										<label class="form-label" style="margin: 10px auto;">Event Title</label>
										<input type="text" class="form-control" name="tbl_calender_title"
											   id="tbl_calender_title" value="<?php echo $td->tbl_calender_title ?>"
											   required="">
									</div>
								</div>
							</div>
							<!-- <div class="form-group" style="margin: 5px 15px;">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label" style="margin: 10px auto;">Short Desc</label>
                                                </div>
                                                <div class="col-md-9">
                                                 <textarea class="form-control ckeditor" name="tbl_calender_short_desc" id="tbl_calender_short_desc" required=""><?php echo $td->tbl_calender_short_desc ?></textarea>
                                                </div>
                                            </div>
                                        </div> -->
							<div class="form-group" style="margin: 5px 15px;">
								<div class="row">
									<div class="col-md-12">
										<label class="form-label" style="margin: 10px auto;">Event Details</label>
										<div class="ql-wrapper ql-wrapper-demo bg-gray-200">
											<div id="quillEditor">
												<?php echo $td->tbl_calender_short_desccription ?>
											</div>
										</div>
										<textarea name="tbl_calender_short_desccription" class="form-control ckeditor"
												  id="tbl_calender_short_desccription"
												  style="display:none;"/><?php echo $td->tbl_calender_short_desccription ?></textarea>
									</div>
								</div>
							</div>
							<div class="form-group" style="margin: 5px 15px;">
								<div class="row">
									<div class="col-md-6">
										<label class="form-label" style="margin: 10px auto;">Event Location</label>
										<input type="text" class="form-control" name="tbl_calender_location"
											   id="tbl_calender_location"
											   value="<?php echo $td->tbl_calender_location ?>">
									</div>
									<div class="col-md-6">
										<label class="form-label" style="margin: 10px auto;">Event Type</label>
										<input type="text" class="form-control" name="tbl_calender_calender_type"
											   id="tbl_calender_calender_type"
											   value="<?php echo $td->tbl_calender_calender_type ?>">
									</div>
								</div>
							</div>


							<div class="card-footer">
								<button class="btn btn-primary waves-effect waves-light sub">Update</button>
								&nbsp;
								<a href="<?= site_url('incubator/calendar') ?>"
								   class="btn btn-warning waves-effect waves-light">Clear</a>
							</div>

						<?php }

					} else { ?>
						<div class="p-4 n4 border-bottom">
							<h2 class="main-content-title mg-b-15 tx-16">Add New Event</h2>
						</div>
						<?php
						echo form_open_multipart("incubator/Calendar/add", 'class="login" data-toggle="validator"');
						?>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group" style="margin: 5px 15px;">
									<label class="form-label" style="margin: 10px auto;">Incubator / BDSP</label>
									<select id="tbl_calender_user_unique_id" name="tbl_calender_user_unique_id"
											class="form-control">
										<option value="">Select</option>
										<optgroup label="Incubator">
											<?php
											foreach ($inc as $k => $in) { ?>
												<option value="<?php echo $in->tbl_users_user_uniqueid; ?>"><?php echo $in->tbl_users_firstname . ' ' . $in->tbl_users_lastname; ?></option>
											<?php } ?>
										</optgroup>
										<optgroup label="BDSP">
											<?php
											foreach ($bdsp as $key => $dbs) { ?>
												<option value="<?php echo $dbs->tbl_users_user_uniqueid; ?>"><?php echo $dbs->tbl_users_firstname . ' ' . $dbs->tbl_users_lastname; ?></option>
											<?php } ?>
										</optgroup>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group" style="margin: 5px 15px;">
									<label class="form-label" style="margin: 10px auto;">SMME</label>
									<select id="tbl_calender_smme_unique_id" name="tbl_calender_smme_unique_id"
											class="form-control">
										<option value="">Select</option>
										<?php
										foreach ($smme as $ke => $value) { ?>
											<option value="<?php echo $value->tbl_users_user_uniqueid; ?>"><?php echo $value->tbl_users_firstname . ' ' . $value->tbl_users_lastname; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group" style="margin: 5px 15px;">
									<label class="form-label" style="margin: 10px auto;">Start Date</label>
									<input class="form-control" name="tbl_calender_start_datetime" id="datetimepicker2"
										   type="text" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group" style="margin: 5px 15px;">
									<label class="form-label" style="margin: 10px auto;">End Date</label>

									<input class="form-control" name="tbl_calender_end_datetime" id="datetimepicker"
										   type="text" required="">

								</div>
							</div>
						</div>
						<div class="form-group" style="margin: 5px 15px;">
							<div class="row">
								<div class="col-md-12">
									<label class="form-label" style="margin: 10px auto;">Event Title</label>
									<input type="text" class="form-control" name="tbl_calender_title"
										   id="tbl_calender_title" required="">
								</div>
							</div>
						</div>
						<!-- <div class="form-group" style="margin: 5px 15px;">
							<div class="row">
								<div class="col-md-3">
									<label class="form-label" style="margin: 10px auto;">Short Desc</label>
								</div>
								<div class="col-md-9">
								 <textarea class="form-control ckeditor" name="tbl_calender_short_desc" id="tbl_calender_short_desc" required=""></textarea>
								</div>
							</div>
						</div> -->
						<div class="form-group" style="margin: 5px 15px;">
							<div class="row">
								<div class="col-md-12">
									<label class="form-label" style="margin: 10px auto;">Event Detail</label>
									<div class="ql-wrapper ql-wrapper-demo bg-gray-200">
										<div id="quillEditor"></div>
									</div>
									<textarea name="tbl_calender_short_desccription" class="form-control ckeditor"
											  id="tbl_calender_short_desccription" style="display:none;"/></textarea>
								</div>
							</div>
						</div>
						<div class="form-group" style="margin: 5px 15px;">
							<div class="row">
								<div class="col-md-6">
									<label class="form-label" style="margin: 10px auto;">Event Location</label>
									<input type="text" class="form-control" name="tbl_calender_location"
										   id="tbl_calender_location">
								</div>
								<div class="col-md-6">
									<label class="form-label" style="margin: 10px auto;">Event Type</label>
									<input type="text" class="form-control" name="tbl_calender_calender_type"
										   id="tbl_calender_calender_type">
								</div>
							</div>
						</div>

						<div class="card-footer">
							<button class="btn btn-primary waves-effect waves-light sub">Submit</button>
							&nbsp;
							<a href="<?= site_url('incubator/calendar') ?>"
							   class="btn btn-warning waves-effect waves-light">Clear</a>
						</div>
						<?php
					}
					?>
					<?php echo form_close(); ?>
				</div>
			</div>
			<div class="col-lg-12 col-xl-8">
				<div class="main-content-body main-content-body-calendar card p-4 n4">
					<div class="main-calendar" id="calendar">
					</div>
				</div>
			</div>
		</div>
		<!-- /row -->
	</div>
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->

<!-- Modal -->
<div aria-hidden="true" class="modal main-modal-calendar-schedule" id="modalSetSchedule" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title">Create New Event</h6>
				<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="calendar.html" id="mainFormCalendar" method="post" name="mainFormCalendar">
					<div class="form-group">
						<input class="form-control" placeholder="Add title" type="text">
					</div>
					<div class="form-group d-flex align-items-center">
						<label class="rdiobox mg-r-60"><input checked name="etype" type="radio" value="event"> <span>Event</span></label>
						<label class="rdiobox"><input name="etype" type="radio" value="reminder"> <span>Reminder</span></label>
					</div>
					<div class="form-group mg-t-30">
						<label class="tx-13 mg-b-5 tx-gray-600">Start Date</label>
						<div class="row row-xs">
							<div class="col-7">
								<input class="form-control" id="mainEventStartDate" placeholder="Select date"
									   type="text" value="">
							</div><!-- col-7 -->
							<div class="col-5">
								<select class="select2-modal main-event-time" data-placeholder="Select time"
										id="mainEventStartTime">
									<option label="Select time">
										Select time
									</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="tx-13 mg-b-5 tx-gray-600">End Date</label>
						<div class="row row-xs">
							<div class="col-7">
								<input class="form-control" id="EventEndDate" placeholder="Select date" type="text"
									   value="">
							</div><!-- col-7 -->
							<div class="col-5">
								<select class="select2-modal main-event-time" data-placeholder="Select time"
										id="EventEndTime">
									<option label="Select time">
										Select time
									</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<textarea class="form-control ckeditor" placeholder="Write some description (optional)"
								  rows="2"></textarea>
					</div>
					<div class="d-flex mg-t-15 mg-lg-t-30">
						<button class="btn btn-main-primary pd-x-25 mg-r-5" type="submit">Save</button>
						<a class="btn btn-light" data-dismiss="modal" href="">Discard</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Modal -->

<!-- Modal -->
<div aria-hidden="true" class="modal main-modal-calendar-event" id="modalCalendarEvent" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<p class="event-type"></p>
				<nav class="nav nav-modal-event" style="float:right;">
					<a class="nav-link event-id" href="javascript:void(0)"><i class="icon ion-md-create"></i></a>
					<!-- <a class="nav-link" href="#"><i class="icon ion-md-trash"></i></a> -->
					<a class="nav-link" data-dismiss="modal">
						<i class="icon ion-md-close"></i></a>
				</nav>
			</div>
			<div class="modal-body">
				<div class="row row-sm">
					<div class="col-sm-6">
						<label class="tx-13 tx-gray-600 mg-b-2">Start Date</label>
						<p class="event-start-date"></p>
					</div>
					<div class="col-sm-6">
						<label class="tx-13 mg-b-2">End Date</label>
						<p class="event-end-date"></p>
					</div>
					<div class="col-sm-12">
						<label class="tx-13 tx-gray-600 mg-b-2">Event Title</label>
						<p class="event-title"></p>
					</div>
				</div>

				<label class="tx-13 tx-gray-600 mg-b-2">Event Detail</label>
				<div class="event-desc tx-gray-900 mg-b-30"></div><!-- <button class="btn btn-success wd-80 " data-dismiss="modal">Edit</button>
                            <a class="btn btn-secondary wd-80" data-dismiss="modal">Close</a> -->
			</div>
		</div>
	</div>
</div>
<!-- /Modal -->

<!-- Footer opened -->
<?= $footer; ?>
<!-- Fullcalendar js -->
<script src="http://vbi.bedco.org.ls/itrd/assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/fullcalendar/fullcalendar.min.js"></script>

<!-- App calendar js -->


<!-- Eva-icons js -->
<script type="text/javascript">
	$(function () {
		'use strict'
		// Datepicker found in left sidebar of the page

		// Initialize fullCalendar
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay,listWeek'
			},
			navLinks: true,
			selectable: false,
			selectLongPressDelay: 100,
			editable: false,
			nowIndicator: true,
			defaultView: 'listMonth',
			views: {
				agenda: {
					columnHeaderHtml: function (mom) {
						return '<span>' + mom.format('ddd') + '</span>' + '<span>' + mom.format('DD') + '</span>';
					}
				},
				day: {
					columnHeader: false
				},
				listMonth: {
					listDayFormat: 'ddd DD',
					listDayAltFormat: false
				},
				listWeek: {
					listDayFormat: 'ddd DD',
					listDayAltFormat: false
				},
				agendaThreeDay: {
					type: 'agenda',
					duration: {
						days: 3
					},
					titleFormat: 'MMMM YYYY'
				}
			},
			eventSources: [
				{
					events: function (start, end, timezone, callback) {
						$.ajax({
							url: '<?php echo base_url() ?>incubator/Calendar/get_events',
							dataType: 'json',
							data: {
								// our hypothetical feed requires UNIX timestamps
								start: start.unix(),
								end: end.unix()
							},
							success: function (msg) {
								//alert("success");
								console.log(msg);
								var events = msg.events;
								callback(events);
							}
						});
					}
				},
			],
			eventAfterAllRender: function (view) {
				if (view.name === 'listMonth' || view.name === 'listWeek') {
					var dates = view.el.find('.fc-list-heading-main');
					dates.each(function () {
						var text = $(this).text().split(' ');
						var now = moment().format('DD');
						$(this).html(text[0] + '<span>' + text[1] + '</span>');
						if (now === text[1]) {
							$(this).addClass('now');
						}
					});
				}
				console.log(view.el);
			},
			eventRender: function (event, element) {
				if (event.description) {
					element.find('.fc-list-item-title').append('<span class="fc-desc">' + event.description + '</span>');
					element.find('.fc-content').append('<span class="fc-desc">' + event.description + '</span>');
				}
				var eBorderColor = (event.source.borderColor) ? event.source.borderColor : event.borderColor;
				element.find('.fc-list-item-time').css({
					color: eBorderColor,
					borderColor: eBorderColor
				});
				element.find('.fc-list-item-title').css({
					borderColor: eBorderColor
				});
				element.css('borderLeftColor', eBorderColor);
			},
		});
		var azCalendar = $('#calendar').fullCalendar('getCalendar');
		// change view to week when in tablet
		if (window.matchMedia('(min-width: 576px)').matches) {
			azCalendar.changeView('agendaWeek');
		}
		// change view to month when in desktop
		if (window.matchMedia('(min-width: 992px)').matches) {
			azCalendar.changeView('month');
		}
		// change view based in viewport width when resize is detected
		azCalendar.option('windowResize', function (view) {
			if (view.name === 'listWeek') {
				if (window.matchMedia('(min-width: 992px)').matches) {
					azCalendar.changeView('month');
				} else {
					azCalendar.changeView('listWeek');
				}
			}
		});
		// display current date
		var azDateNow = azCalendar.getDate();
		azCalendar.option('select', function (startDate, endDate) {
			$('#modalSetSchedule').modal('show');
			$('#mainEventStartDate').val(startDate.format('LL'));
			$('#EventEndDate').val(endDate.format('LL'));
			$('#mainEventStartTime').val(startDate.format('LT')).trigger('change');
			$('#EventEndTime').val(endDate.format('LT')).trigger('change');
		});
		// Display calendar event modal
		azCalendar.on('eventClick', function (calEvent, jsEvent, view) {
			var modal = $('#modalCalendarEvent');
			modal.modal('show');
			modal.find('.event-type').text(calEvent.calender_type);
			modal.find('.event-title').text(calEvent.title);
			modal.find('.event-id').val(calEvent.id);
			if (calEvent.description) {
				modal.find('.event-desc').html(calEvent.description);
				modal.find('.event-desc').prev().removeClass('d-none');
			} else {
				modal.find('.event-desc').text('');
				modal.find('.event-desc').prev().addClass('d-none');
			}
			modal.find('.event-start-date').text(moment(calEvent.start).format('LLL'));
			modal.find('.event-end-date').text(moment(calEvent.end).format('LLL'));
			//styling
			modal.find('.modal-header').css('backgroundColor', (calEvent.source.borderColor) ? calEvent.source.borderColor : calEvent.borderColor);
		});
		// Enable/disable calendar events from displaying in calendar
		$('.main-nav-calendar-event a').on('click', function (e) {
			e.preventDefault();
			if ($(this).hasClass('exclude')) {
				$(this).removeClass('exclude');
				$(this).is(':first-child') ? azCalendar.addEventSource(azCalendarEvents) : '';
				$(this).is(':nth-child(2)') ? azCalendar.addEventSource(azBirthdayEvents) : '';
				$(this).is(':nth-child(3)') ? azCalendar.addEventSource(azHolidayEvents) : '';
				$(this).is(':nth-child(4)') ? azCalendar.addEventSource(azOtherEvents) : '';
			} else {
				$(this).addClass('exclude');
				$(this).is(':first-child') ? azCalendar.removeEventSource(1) : '';
				$(this).is(':nth-child(2)') ? azCalendar.removeEventSource(2) : '';
				$(this).is(':nth-child(3)') ? azCalendar.removeEventSource(3) : '';
				$(this).is(':nth-child(4)') ? azCalendar.removeEventSource(4) : '';
			}
			azCalendar.render();
			if (window.matchMedia('(max-width: 575px)').matches) {
				$('body').removeClass('main-content-left-show');
			}
		});

		var highlightedDays = ['2018-5-10', '2018-5-11', '2018-5-12', '2018-5-13', '2018-5-14', '2018-5-15', '2018-5-16'];
		var date = new Date();
		$('.fc-datepicker').datepicker({
			showOtherMonths: true,
			selectOtherMonths: true,
			dateFormat: 'yy-mm-dd',
			beforeShowDay: function (date) {
				var m = date.getMonth(),
						d = date.getDate(),
						y = date.getFullYear();
				for (var i = 0; i < highlightedDays.length; i++) {
					if ($.inArray(y + '-' + (m + 1) + '-' + d, highlightedDays) != -1) {
						return [true, 'ui-date-highlighted', ''];
					}
				}
				return [true];
			}
		});
		var generateTime = function (element) {
			var n = 0,
					min = 30,
					periods = [' AM', ' PM'],
					times = [],
					hours = [12, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
			for (var i = 0; i < hours.length; i++) {
				times.push(hours[i] + ':' + n + n + periods[0]);
				while (n < 60 - min) {
					times.push(hours[i] + ':' + ((n += min) < 10 ? 'O' + n : n) + periods[0])
				}
				n = 0;
			}
			times = times.concat(times.slice(0).map(function (time) {
				return time.replace(periods[0], periods[1])
			}));
			//console.log(times);
			$.each(times, function (index, val) {
				$(element).append('<option value="' + val + '">' + val + '</option>');
			});
		}
		generateTime('.main-event-time');
	})
</script>


<script type="text/javascript">
	$(document).ready(function () {


		$(".sub").on("click", function () {

			//alert($('#quillEditor .ql-editor').html());
			$('#tbl_calender_short_desccription').val($('#quillEditor .ql-editor').html());
		});
		$(".ql-toolbar").hide();

	});
</script>

<script type="text/javascript">
	$(document).ready(function () {

		$('#datetimepicker').datetimepicker({
			format: 'yyyy-mm-dd hh:ii',
			autoclose: true
		});
		$('#datetimepicker2').datetimepicker({
			format: 'yyyy-mm-dd hh:ii',
			autoclose: true
		});

		$("#modalCalendarEvent .event-id").on("click", function () {
			var event_id = $(this).val();
			window.location.replace("<?php echo base_url(); ?>incubator/Calendar/edit/" + event_id + "");
			//alert($('#quillEditor .ql-editor').html());
		});
	});
</script>
