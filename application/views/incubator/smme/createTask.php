<?php
?>
<?php echo $header ?>
<link href="<?php echo base_url(); ?>assets/css/jkanban.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/bootstrap-datepicker.min.css" rel="stylesheet">
<div class="container">
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">Notice Boards</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('incubator/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="<?= site_url('incubator/Operations/indexsmme') ?>">MSME Management</a></li>
					<li class="breadcrumb-item active" aria-current="page">Notice Boards</li>
				</ol>
			</nav>
		</div>
		
		<div class="my-auto breadcrumb-right">
						<a href="<?= site_url('incubator/Operations/indexsmme') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-arrow-circle-left mr-2"></i></span><span class="btn-text">Go Back </span></button></a>
							<a href="<?= site_url('incubator/Profile/view_profile/'.$this->session->userdata('id_user')) ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
						</div>
		
		
		
		
		
	</div>
	<div class="">
		<!-- row opened -->
		<div class="row row-sm">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="card-body iconfont text-left">
						<?php if ($this->session->flashdata('danger')) { ?>
							<div id="infoMessage" class="alert alert-danger"
								 style="margin-top: 25px;"><?php echo $this->session->flashdata('danger'); ?></div>
						<?php } ?>
						<?php echo form_open_multipart("#", 'class="login" id="board_form" data-toggle="validator"'); ?>
						<div id="myKanban" style="overflow-x: scroll"></div>
						<div class="row" style="margin-top: 20px; margin-left: 15px;">
							<div class="col-xs-4" style="border: 1px solid #efefef; border-radius: 3px; padding: 8px">
								<input type="text" id="board_title" class="form-control" placeholder="Notice board name"/>
								<button class="btn btn-primary" id="addDefault" style="margin-top: 20px">Add "Default" board
								</button>
							</div>
						</div>
						<div style="display: none">
							<br/>
							<button id="addToDo">Add element in "To Do" Board</button>
							<br/>
							<button id="removeBoard">Remove "Done" Board</button>
							<br/>
							<button id="removeElement">Remove "My Task Test"</button>
						</div>
						<?php echo form_close(); ?>
					</div>

				</div>
			</div>
		</div>
		<!-- row closed -->
	</div>
</div>

<div class="modal" id="element">
	<div class="modal-dialog modal_small" role="document">
		<div class="modal-content modal-content-demo">
			<div class="modal-body feedback_user_id">
				<label for="subject">Title</label>
				<input type="text" name="title" id="el_title" class="form-control" required="">
				<label for="subject">End Date</label>
				<input type="text" name="end_date" id="end_date" class="form-control" required="">
				<button class="btn btn-primary" style="margin-top: 15px" onclick="updateElement()" type="button">Edit
				</button>
			</div>
		</div>
	</div>
</div>

<?php echo $footer ?>
<script src="<?php echo base_url(); ?>assets/js/jkanban.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.min.js"></script>
<script>
	let element_id;
	const path = "<?php echo base_url() ?>"
	$(function () {

		setTimeout(function () {
			$.each($(".kanban-board-header"), function () {
				let btn = $("<button>", {
					"class": "kanban-title-button btn btn-default btn-xs",
					onclick: "deleteBoard(this)",
					html: "<i class='fa fa-trash'></i>",
					type: "button",
					style: "padding-right: 0"
				})
				$(this).append(btn)
			})
		}, 200)

		var KanbanTest = new jKanban({
			element: "#myKanban",
			gutter: "10px",
			widthBoard: "365px",
			itemHandleOptions: {
				enabled: true,
				handleClass: "item_handle",
				customCssHandler: "drag_handler",
				customCssIconHandler: "drag_handler_icon",
				customHandler: "<span class='item_handle fa fa-bars'></span> <span class='item-text'>%s</span> " +
					"<span class='fa fa-trash' onclick='removeElement(this)' style='float: right; margin-left: 10px; cursor: pointer'></span>" +
					"<span class='fa fa-edit' data-target=\"#element\" onclick='loadElementId(this)' data-toggle=\"modal\" style='float: right; cursor: pointer'></span>"
			},
			click: function (el) {

			},
			dropEl: function (el, target, source, sibling) {
				//console.log(target.parentElement.getAttribute('data-id'));
				//console.log(el, target, source, sibling)
				console.log(target)

				let elems = $(target).find(".kanban-item")
				let order = []
				$.each(elems, function () {
					order.push($(this).data("eid"))
				})

				$.ajax({
					method: "POST",
					url: path+"/incubator/Smme/orderElements",
					data: {
						boardId: target.parentElement.getAttribute('data-id'),
						order: order,
						smme: '<?= $smme_id ?>'
					}
				})
			},
			buttonClick: function (el, boardId) {
				console.log(el);
				console.log(boardId);

				// create a form to enter element
				var formItem = document.createElement("form");
				formItem.setAttribute("class", "itemform");
				formItem.innerHTML =
					'<div class="form-group"><textarea class="form-control ckeditor" rows="2" autofocus></textarea></div><div class="form-group"><button type="submit" class="btn btn-primary btn-xs pull-right">Submit</button><button type="button" id="elem" onclick="removeTask(this)" class="btn btn-default btn-xs pull-right">Cancel</button></div>';

				KanbanTest.addForm(boardId, formItem);
				formItem.addEventListener("submit", function (e) {
					e.preventDefault();
					var text = e.target[0].value;
					KanbanTest.addElement(boardId, {
						title: text
					});
					formItem.parentNode.removeChild(formItem);

					$.ajax({
						method: "POST",
						url: path+"/incubator/Smme/saveElement",
						data: {
							brdID: boardId,
							title: text,
							index: 1
						}
					})

				});
				document.getElementById("CancelBtn").onclick = function () {
					formItem.parentNode.removeChild(formItem);
				};

			},
			addItemButton: true,
			boards: JSON.parse('<?= $boards ?>')
		});

		var toDoButton = document.getElementById("addToDo");
		toDoButton.addEventListener("click", function (event) {
			event.preventDefault()
			KanbanTest.addElement("_todo", {
				title: "Test Add"
			});
		});

		var addBoardDefault = document.getElementById("addDefault");
		addBoardDefault.addEventListener("click", function (event) {
			event.preventDefault()
			KanbanTest.addBoards([
				{
					id: $("#board_title").val(),
					title: $("#board_title").val(),
				}
			]);

			$.ajax({
				method: "POST",
				url: path+"/incubator/Smme/saveBoard",
				data: {
					title: $("#board_title").val(),
					smmeId: "<?= $smme_id ?>",
				}
			})
				.done(function () {
					let board = $(".kanban-board").last().find(".kanban-board-header")
					let btn = $("<button>", {
						"class": "kanban-title-button btn btn-default btn-xs",
						onclick: "deleteBoard(this)",
						html: "<i class='fa fa-trash'></i>",
						type: "button",
						style: "padding-right: 0"
					})
					$(board).append(btn)
				})
		});

		$('#end_date').datepicker({format: 'yyyy-mm-dd',});

		var removeBoard = document.getElementById("removeBoard");
		removeBoard.addEventListener("click", function (event) {
			event.preventDefault()
			KanbanTest.removeBoard("_done");
		});

		var removeElement = document.getElementById("removeElement");
		removeElement.addEventListener("click", function (event) {
			event.preventDefault()
			KanbanTest.removeElement("_test_delete");
		});

		var allEle = KanbanTest.getBoardElements("_todo");
		allEle.forEach(function (item, index) {
			//console.log(item);
		});

	})

	function removeElement(elem) {
		let element = $(elem).parent()
		$.ajax({
			method: "POST",
			url: path+"/incubator/Smme/deleteElement",
			data: {
				id: element.text(),
				boardId: element.parent().parent().data("id"),
				smmeId: '<?= $smme_id ?>'
			}
		})
			.done(function (res) {
				element.remove()
			})
	}

	function loadElementId(elem) {
		element_id = $(elem).parent()
		console.log(element_id)
	}

	function updateElement() {
		let element = element_id
		console.log(element)
		$.ajax({
			method: "POST",
			url: path+"/incubator/Smme/updateElement",
			data: {
				id: element.text(),
				end_date: $("#end_date").val(),
				title: $("#el_title").val(),
				boardId: element.parent().parent().data("id"),
				smmeId: '<?= $smme_id ?>'
			}
		})
			.done(function (res) {
				element.find('.item-text').text($("#el_title").val())
				$("#element").modal("hide")
				$("#el_title").val(null)
				$("#end_date").val(null)
			})
	}

	function deleteBoard(elem) {
		let board = $(elem).parent().parent()
		let id = board.data("id")
		$.ajax({
			method: "POST",
			url: path+"/incubator/Smme/deleteBoard",
			data: {
				boardId: id
			}
		})
			.done(function (res) {
				board.remove()
			})

	}

</script>
