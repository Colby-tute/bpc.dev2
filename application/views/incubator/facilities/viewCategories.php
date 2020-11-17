<?php
?>
<?php echo $header ?>
<link href="<?php echo base_url(); ?>assets/css/timeline.min.css" rel="stylesheet">
<div class="container">
    <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editCategoryLabel">Edit Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            </button>
          </div>
          <form id="category-edit-form">
          <div class="modal-body">
            <div class="col-sm-12">
                <input type="hidden" id="editCategoryId" name="categoryId" placeholder="Id" class="form-control category_id"/>
                <label>Category Name</label>
                <input type="text" id="editCategoryName" name="categoryName" placeholder="Name" class="form-control category_name"/>
            </div>
            <br />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" id="submit_category_edit" onclick="editCategory()"  class="btn btn-primary submit_category_edit">Save changes</button>
          </div>
          </form>
        </div>
      </div>
    </div>    
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">Resources</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('incubator/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">Facility Management</li>
				</ol>
			</nav>
		</div>
		<div class="my-auto breadcrumb-right">
							<a href="<?=site_url('incubator/Application')?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-bell mr-2"></i></span><span class="btn-text">Status </span></button></a>
							<a href="<?= site_url('incubator/Profile/view_profile/'.$this->session->userdata('id_user')) ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
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
                                <div class="col-sm-3">
                                    <label>Add New Category</label>
                                    <input type="text" id="category_name" name="categoryName" placeholder="Category Name" class="form-control"/>
                                </div>                    
                                <div class="col-sm-12 mg-t-15">
                                    <button class="btn btn-primary" onclick="createCategory()" id="create">Create</button>
                                </div>
                            </div>
							<div class="row">
								<div class="col-sm-12">
									<div class="table-responsive card-body">
										<table class="table text-md-nowrap dataTable no-footer" id="example1" role="grid" aria-describedby="example1_info">
											<thead>
											<tr>
												<th scope="col">PID</th>
												<th scope="col">Booking Item Category</th>
												<th scope="col">Actions</th>
											</tr>
											</thead>
											<tbody id="categories_tbody">
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
		loadCategories();
	});
    $('#editCategoryModal').on('show.bs.modal', function (e) {
        if (e.namespace === 'bs.modal') {
            var edit_button = $(e.relatedTarget);
            var category_row = edit_button.parents("tr");
            var category_id = category_row.find(".category_id").val();
            var category_name = category_row.find(".category_name").text();
            $(this).find(".category_id").val(category_id);
            $(this).find(".category_name").val(category_name);
        }
    });

	function editCategory() {
        let category_id = $("#editCategoryId").val();
        let category_new_name = $("#editCategoryName").val();
        if(category_new_name == "") {
          alert("Please enter valid name!");
          return;
        }
        let url = window.location.href.split("/");
        let smmeId = url[url.length - 1];       
        $.ajax({
            method: "post",
            url: '<?= base_url() ?>incubator/FacilityManagement/updateCategory/',
            data: {
                category_id: category_id,
                category_new_name: category_new_name
            },
            success:function(data) {
              loadCategories();
              $('#editCategoryModal').modal('hide');
              $('.modal-backdrop').remove();
            }
        })
	}
    function createCategory() {
        let category_name = $("#category_name").val();
        if(category_name == "") {
            alert("Please enter valid name!")
        } else {
            $.ajax({
                method: "post",
                url: '<?= base_url() ?>incubator/FacilityManagement/createCategory',
	            data: {
	                category_name: category_name
	            },
                success:function(data) {
                  loadCategories();
                  $("#category_name").val('');
                }
            })
        }
    }
    function deleteCategory(category_id) {
        $.ajax({
            method: "post",
            url: '<?= base_url() ?>incubator/FacilityManagement/deleteCategory/'+category_id,
            success:function(data) {
              loadCategories();
            }
        })
    }
	function loadCategories() {
		$.ajax({
			method: "post",
			url: '<?= base_url() ?>incubator/FacilityManagement/getCategories',
            success:function(data) {
            	updateCategoriesTable(data);
            }
		})
	}
	function updateCategoriesTable(categoriesData) {
		var categories = JSON.parse(categoriesData);
		var viewItemsUrl = '<?= base_url() ?>incubator/FacilityManagement/viewCategoryItems/';
		categoriesTable = "";
		if(categories.length) {
			for(var categoriesIdx = 0; categoriesIdx < categories.length; categoriesIdx++) {
	    		var category = categories[categoriesIdx];
				categoriesTable += "<tr>" + 
                                "<td> <span>" + (categoriesIdx+1) + "</span>" +
                                    "<input type='hidden' class='category_id' value=" + category['facility_category_id'] + " /></td>" +
								"<td class='category_name'>" + category['facility_category_name'] + "</td>" + 
								"<td>" + 
									"<a href='" + viewItemsUrl + category['facility_category_id'] +"'><i class='fa fa-eye' style='color: blue; margin-left: 5px; cursor: pointer'></i></a>" +
									"<a><i class='fa fa-edit' data-toggle='modal' data-target='#editCategoryModal' style='color: blue; margin-left: 15px; cursor: pointer'></i></a>" +
									"<a><i class='fa fa-trash' onclick='deleteCategory("+category['facility_category_id']+")' style='color: blue; margin-left: 15px; cursor: pointer'></i></a>" +
								"</td></tr>";
			}
			$('#categories_tbody').empty();
			$('#categories_tbody').append(categoriesTable);
		} else {
			$('#categories_tbody').empty();
			$('#categories_tbody').append("<tr>No data to display!</tr>");			
		}
	}	
</script>
