<?= $header ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" rel="stylesheet">
<div class="container">
    <div class="breadcrumb-header justify-content-between">
        <div>
			<h4 class="content-title mb-2">Resources</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('bdsp/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="<?= site_url('bdsp/FacilityManagement/viewBookings') ?>">Facility Management</a></li>
					<li class="breadcrumb-item active" aria-current="page">Update Booking</li>
				</ol>
			</nav>
		</div>
         <div class="my-auto breadcrumb-right">
							<a href="<?= site_url('bdsp/FacilityManagement/viewBookings') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-arrow-circle-left mr-2"></i></span><span class="btn-text">Go Back </span></button></a>
							<a href="<?= site_url('bdsp/Profile/view_profile/'.$this->session->userdata('id_user')) ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
						</div>
        </div>
        <div class="main-content-app pd-b-0  main-content-calendar pt-0">
            <div class="card">
                <div class="card-body">
                    <form id="editBookingForm" action="<?= site_url("bdsp/FacilityManagement/submitEditBooking") ?>" method="post">
                    	<div class="row">
                    		<input type="hidden" name="user_id" value="<?= $user_id ?>">
                            <input type="hidden" name="booking_id" value="<?= $booking['facility_booking_id'] ?>">
                    		<div class="col-sm-6" style="margin-bottom: 15px;">
                    			<label class="form-label">
                    				Purpose
                    			</label>
                    			<input type="text" name="title" value="<?= $booking['facility_booking_name'] ?>" class="form-control">
                    		</div>
                        </div>    
                        <div class="row">
                    		<div class="col-sm-6" style="margin-bottom: 15px;">
                    			<label class="form-label">
                    				Category
                    			</label>
                    			<select class="form-control" id="category" name="category" onchange="handleCategoryChange(this)">
                                    <option value="">Select</option>
                    			</select>
                    		</div>
                    		<div class="col-sm-6" style="margin-bottom: 15px;">
                    			<label class="form-label">
                    				Item
                    			</label>
                    			<select class="form-control" id="item" name="item">
                                    <option value="">Select</option>
                    			</select>
                    		</div>
                        </div>    
                        <div class="row">
                    		<div class="col-sm-6" style="margin-bottom: 15px;">
                    			<label class="form-label">
                    				Start Date
                    			</label>
                    			<input class="form-control" type="text" id="start_date" name="start_date" />
                    		</div>
                    		<div class="col-sm-6" style="margin-bottom: 15px;">
                    			<label class="form-label">
                    				End Date
                    			</label>
                    			<input class="form-control" type="text" id="end_date" name="end_date" />
                    		</div>
                        </div>    
                        <div class="row">
                            <div class="col-sm-12">
                                <button class="btn btn-primary">Book</button>
                            </div>
                    	</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $footer ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('#start_date').datetimepicker({
            format: "Y-m-d H:i",
            value: '<?= $booking['facility_booking_from'] ?>'
        });
        $('#end_date').datetimepicker({
            format: "Y-m-d H:i",
            value: '<?= $booking['facility_booking_to'] ?>'
        });
    })

    var categories = <?= $categories ?>;
    categorySelector = document.getElementById('category');
    itemSelector = document.getElementById('item');
    clearSelector(categorySelector);
    for (i = 0; i < categories.length; i ++) {
        option = document.createElement('option');
        option.setAttribute('value', categories[i].facility_category_id);
        option.appendChild(document.createTextNode(categories[i].facility_category_name));
        categorySelector.appendChild(option);
    }
    var selectedCategory = <?= $booking['facility_category_id'] ?>;
    var selectedItem = <?= $booking['facility_item_id'] ?>;
    if(selectedCategory) {
        categorySelector.value = selectedCategory;
        $.ajax({
            method: "post",
            url: '<?= base_url() ?>bdsp/FacilityManagement/getCategoryItems/' + selectedCategory,
            success:function(data) {
                populateItems(data);
                itemSelector.value = selectedItem; 
            }
        });

    }

    function handleCategoryChange(category) {
        clearSelector(itemSelector);
        var category_id = category.value;
        $.ajax({
            method: "post",
            url: '<?= base_url() ?>bdsp/FacilityManagement/getCategoryItems/' + category_id,
            success:function(data) {
                populateItems(data);
            }
        }) 
    }
    function populateItems(itemsData) {
        items = JSON.parse(itemsData);
        if(items) {
            if(items.length == 0) {
                alert("No items under this category");
                return;
            }
            clearSelector(itemSelector);
            for (i = 0; i < items.length; i++) {
                option = document.createElement('option');
                option.setAttribute('value', items[i].facility_item_id);
                option.appendChild(document.createTextNode(items[i].facility_item_name));
                itemSelector.appendChild(option);
            }
        }
    }

    function clearSelector(selector) {
        var length = selector.options.length;
        for (i = length-1; i >= 0; i--) {
          selector.options[i] = null;
        }        
        option = document.createElement('option');
        option.setAttribute('value', "");
        option.appendChild(document.createTextNode("Select"));
        selector.appendChild(option);
    }

    function checkItemAvailability() {
        var item_id = itemSelector.value;
        var start_time = document.getElementById('start_date').value;
        var end_time = document.getElementById('end_date').value;

        if(item_id != "" && start_time != "" && end_time != "") {
            if(new Date(start_time) > new Date(end_time)) {
                alert('Start date-time cannot be later than end date-time');
                return;
            }
            $.ajax({
                method: "post",
                url: '<?= base_url() ?>bdsp/FacilityManagement/checkItemAvailability',
                data: {
                    'item_id': item_id,
                    'start_time': start_time,
                    'end_time': end_time
                },
                success:function(data) {
                    bookingData = JSON.parse(data);
                    if(bookingData.length > 0) {
                        for(var i = 0; i < bookingData.length; i++) {
                            if(bookingData[i].facility_booking_id == <?= $booking['facility_booking_id'] ?>) {
                                bookingData.splice(i, 1);
                                break;
                            }
                        }
                    }
                    if(bookingData.length == 0) {
                        document.forms["editBookingForm"].submit();   
                    } 
                    else {
                        var overlappingBookings = "Overlapping Booking\n";
                        for(var i = 0; i < bookingData.length; i++) {
                            overlappingBookings += bookingData[i].facility_booking_from +
                                                    "\t" + bookingData[i].facility_booking_to + "\n";
                        }     
                        overlappingBookings += "Please select different slot!";                 
                        alert(overlappingBookings);
                        return;
                    }
                }
            }) 
        } else {
            alert('Please select item , start date and end date to check availability')
        }
    }
</script>