<?php
?>
<?php echo $header ?>
<link href="<?php echo base_url(); ?>assets/css/timeline.min.css" rel="stylesheet">
<div class="container">
    <div class="modal fade" id="editCategoryItemModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryItemLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editCategoryItemLabel">Manage Assets</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            </button>
          </div>
          <form id="category-edit-form">
          <div class="modal-body">
            <div class="col-sm-12">
                <input type="hidden" id="editCategoryItemId" name="categoryId" placeholder="Id" class="form-control item_id"/>
                <label>Add New Asset</label>
                <input type="text" id="editCategoryItemName" name="categoryName" placeholder="Name" class="form-control item_name"/>
            </div>
            <br />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" id="submit_item_edit" onclick="editCategoryItem()"  class="btn btn-primary submit_item_edit">Save changes</button>
          </div>
          </form>
        </div>
      </div>
    </div>    
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">Resurces</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('admin/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item" aria-current="page"><a href="<?= site_url('admin/FacilityManagement/index') ?>">Resources</a></li>
					<li class="breadcrumb-item active" aria-current="page">Facility Management</li>
				</ol>
			</nav>
		</div>
		<div class="my-auto breadcrumb-right">
							<a href="<?=site_url('admin/smme/Application')?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-bell mr-2"></i></span><span class="btn-text">Status </span></button></a>
							<a href="<?=site_url('admin/Home/profile') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
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
                                    <label>New Asset</label>
                                    <input type="text" id="item_name" name="categoryName" placeholder="Asset Name" class="form-control"/>
                                </div>                    
                                <div class="col-sm-12 mg-t-15">
                                    <button class="btn btn-primary" onclick="createCategoryItem()" id="create">Create</button>
                                </div>
                            </div>
							<div class="row">
								<div class="col-sm-12">
									<div class="table-responsive card-body">
										<table class="table text-md-nowrap dataTable no-footer" id="example1" role="grid" aria-describedby="example1_info">
											<thead>
											<tr>
												<th scope="col">pid</th>
												<th scope="col">Asset List</th>
												<th scope="col">Actions</th>
											</tr>
											</thead>
											<tbody id="category_items_tbody">
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
		loadCategoryItems();
	});
    $('#editCategoryItemModal').on('show.bs.modal', function (e) {
        if (e.namespace === 'bs.modal') {
            var edit_button = $(e.relatedTarget);
            var item_row = edit_button.parents("tr");
            var item_id = item_row.find(".item_id").val();
            var item_name = item_row.find(".item_name").text();
            $(this).find(".item_id").val(item_id);
            $(this).find(".item_name").val(item_name);
        }
    });

	function editCategoryItem() {
        let item_id = $("#editCategoryItemId").val();
        let item_new_name = $("#editCategoryItemName").val();
        if(item_new_name == "") {
          alert("Please enter valid name!");
          return;
        }
        let url = window.location.href.split("/");
        let smmeId = url[url.length - 1];       
        $.ajax({
            method: "post",
            url: '<?= base_url() ?>admin/FacilityManagement/updateCategoryItem',
            data: {
                item_id: item_id,
                item_new_name: item_new_name
            },
            success:function(data) {
              loadCategoryItems();
              $('#editCategoryItemModal').modal('hide');
              $('.modal-backdrop').remove();
            }
        })
	}
    function createCategoryItem() {
        let item_name = $("#item_name").val();
        if(item_name == "") {
            alert("Please enter valid name!")
        } else {
            var category_id = <?= $category_id ?>;
            $.ajax({
                method: "post",
                url: '<?= base_url() ?>admin/FacilityManagement/createCategoryItem',
	            data: {
	                category_id: category_id,
                  item_name: item_name
	            },
                success:function(data) {
                  loadCategoryItems();
                  $("#item_name").val('');
                }
            })
        }
    }
    function deleteCategoryItem(item_id) {
        $.ajax({
            method: "post",
            url: '<?= base_url() ?>admin/FacilityManagement/deleteCategoryItem/'+item_id,
            success:function(data) {
              loadCategoryItems();
            }
        })
    }
	function loadCategoryItems() {
    var category_id = <?= $category_id ?>;
		$.ajax({
			method: "post",
			url: '<?= base_url() ?>admin/FacilityManagement/getCategoryItems/' + category_id,
            success:function(data) {
            	updateCategoryItemsTable(data);
            }
		})
	}
	function updateCategoryItemsTable(categoriesData) {
		var categories = JSON.parse(categoriesData);
		var viewCategoryItemsUrl = '<?= base_url() ?>admin/FacilityManagement/viewCategoryItems/';
		categoryItemsTable = "";
		if(categories.length) {
			for(var categoriesIdx = 0; categoriesIdx < categories.length; categoriesIdx++) {
	    		var category = categories[categoriesIdx];
				categoryItemsTable += "<tr>" + 
                                "<td> <span>" + (categoriesIdx+1) + "</span>" +
                                    "<input type='hidden' class='item_id' value=" + category['facility_item_id'] + " /></td>" +
								"<td class='item_name'>" + category['facility_item_name'] + "</td>" + 
								"<td>" + 
									"<a><i class='fa fa-edit' data-toggle='modal' data-target='#editCategoryItemModal' style='color: blue; margin-left: 15px; cursor: pointer'></i></a>" +
									"<a><i class='fa fa-trash' onclick='deleteCategoryItem("+category['facility_item_id']+")' style='color: blue; margin-left: 15px; cursor: pointer'></i></a>" +
								"</td></tr>";
			}
			$('#category_items_tbody').empty();
			$('#category_items_tbody').append(categoryItemsTable);
		} else {
			$('#category_items_tbody').empty();
			$('#category_items_tbody').append("<tr>No data to display!</tr>");			
		}
	}	
</script>
