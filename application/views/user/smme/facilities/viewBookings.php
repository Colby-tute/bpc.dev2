<?php
?>
<?php echo $header ?>
<link href="<?php echo base_url(); ?>assets/css/timeline.min.css" rel="stylesheet">
<div class="container">  
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">Facility Management</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">My Bookings</li>
				</ol>
			</nav>
		</div>
		<div class="my-auto breadcrumb-right">
							<a href="<?= site_url('user/smme/FacilityManagement/createBooking') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-barcode mr-2"></i></span><span class="btn-text">Create A Booking </span></button></a>
							<a href="<?= site_url('user/smme/FacilityManagement/viewBookings') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-calendar mr-2"></i> </span><span class="btn-text">Manage Bookings </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
						</div>
	</div>
	<!-- breadcrumb -->

	<div class="row row-sm">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<div class="border">
						<div class="card-body iconfont text-left">
							<div class="row">
								<div class="col-sm-12">
									<div class="table-responsive card-body">
										<table class="table text-md-nowrap dataTable no-footer" id="example1" role="grid" aria-describedby="example1_info">
											<thead>
											<tr>
												<th scope="col">PID</th>
												<th scope="col">Item Category</th>
												<th scope="col">Item Name</th>
												<th scope="col">Booking Purpose</th>
												<th scope="col">Bookig Start Time</th>
												<th scope="col">Booking End Time</th>
												<th scope="col">Actions</th>
											</tr>
											</thead>
											<tbody id="bookings_tbody">
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /row -->
</div>
<?php echo $footer ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
<script type="text/javascript">
	$(document).ready(function () {
		loadBookings();
	});
    function deleteBooking(booking_id) {
        $.ajax({
            method: "post",
            url: '<?= base_url() ?>user/smme/FacilityManagement/deleteBooking/'+booking_id,
            success:function(data) {
              loadBookings();
            }
        })
    }
	function loadBookings() {
		var user_id = <?= $user_id ?>;
		$.ajax({
			method: "post",
			url: '<?= base_url() ?>user/smme/FacilityManagement/getBookings',
			data: {'user_id': user_id},
            success:function(data) {
            	updateBookingsTable(data);
            }
		})
	}
	function updateBookingsTable(bookingsData) {
		var bookings = JSON.parse(bookingsData);
		var editBookingUrl = '<?= base_url() ?>user/smme/FacilityManagement/editBooking/';
		bookingsTable = "";
		if(bookings.length) {
			for(var bookingsIdx = 0; bookingsIdx < bookings.length; bookingsIdx++) {
	    		var booking = bookings[bookingsIdx];
				bookingsTable += "<tr>" + 
                                "<td> <span>" + (bookingsIdx+1) + "</span>" +
                                    "<input type='hidden' class='category_id' value=" + booking['facility_booking_id'] + " /></td>" +
								"<td class='category_name'>" + booking['facility_category_name'] + "</td>" + 
								"<td class='category_name'>" + booking['facility_item_name'] + "</td>" + 
								"<td class='category_name'>" + booking['facility_booking_name'] + "</td>" + 
								"<td class='category_name'>" + booking['facility_booking_from'] + "</td>" + 
								"<td class='category_name'>" + booking['facility_booking_to'] + "</td>" + 
								"<td>" + 
									"<a href=" + editBookingUrl  + booking['facility_booking_id'] + "><i class='fa fa-edit' style='color: blue; margin-left: 5px; cursor: pointer'></i></a>" +
									"<i class='fa fa-trash' style='color: blue; margin-left: 5px; cursor: pointer' onclick='deleteBooking("+booking['facility_booking_id']+")' ></i>" +
								"</td></tr>";
			}
			$('#bookings_tbody').empty();
			$('#bookings_tbody').append(bookingsTable);
		} else {
			$('#bookings_tbody').empty();
			$('#bookings_tbody').append("<tr>No data to display!</tr>");			
		}
	}	
</script>
