<?php
?>
<?php echo $header ?>
<link href="<?php echo base_url(); ?>assets/css/jkanban.min.css" rel="stylesheet">
<div class="container">
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">Operations</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">Notice Boards</li>
				</ol>
			</nav>
		</div>
		
		<div class="my-auto breadcrumb-right">
							<a href="<?= site_url('user/smme/Application') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-bell mr-2"></i></span><span class="btn-text">Status </span></button></a>
							<a href="<?= site_url('user/smme/Analytics/incprogress') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-bars mr-2"></i> </span><span class="btn-text">Monitoring & Reports </span></button></a>
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
						<div id="myKanban" style="overflow-x: scroll;"></div>
						<!--<div class="row" style="margin-top: 20px; margin-left: 15px;">
							<div class="col-xs-4" style="border: 1px solid #efefef; border-radius: 3px; padding: 8px">
								<input type="text" id="board_title" class="form-control" placeholder="Board Title" />
								<button class="btn btn-primary" id="addDefault" style="margin-top: 20px">Add "Default" board</button>
							</div>
						</div>-->
						<div style="display: none">
							<br />
							<button id="addToDo">Add element in "To Do" Board</button>
							<br />
							<button id="removeBoard">Remove "Done" Board</button>
							<br />
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

<?php echo $footer ?>
<script src="<?php echo base_url(); ?>assets/js/jkanban.min.js"></script>
<script>
	$(function () {
		var KanbanTest = new jKanban({
			element: "#myKanban",
			gutter: "10px",
			widthBoard: "365px",
			itemHandleOptions:{
				enabled: true,
			},
			click: function(el) {

			},
			dropEl: function(el, target, source, sibling){
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
					url: "/itrd/user/smme/Management/orderElements",
					data: {
						boardId: target.parentElement.getAttribute('data-id'),
						order: order
					}
				})
			},
			buttonClick: function(el, boardId) {
				console.log(el);
				console.log(boardId);

				// create a form to enter element
				var formItem = document.createElement("form");
				formItem.setAttribute("class", "itemform");
				formItem.innerHTML =
					'<div class="form-group"><textarea class="form-control ckeditor" rows="2" autofocus></textarea></div><div class="form-group"><button type="submit" class="btn btn-primary btn-xs pull-right">Submit</button><button type="button" id="elem" onclick="removeTask(this)" class="btn btn-default btn-xs pull-right">Cancel</button></div>';

				KanbanTest.addForm(boardId, formItem);
				formItem.addEventListener("submit", function(e) {
					e.preventDefault();
					var text = e.target[0].value;
					KanbanTest.addElement(boardId, {
						title: text
					});
					formItem.parentNode.removeChild(formItem);

					$.ajax({
						method: "POST",
						url: "/admin/smme/Smme/saveElement",
						data: {
							brdID: boardId,
							title: text,
							index: 1
						}
					})

				});
				document.getElementById("CancelBtn").onclick = function() {
					formItem.parentNode.removeChild(formItem);
				};

			},
			addItemButton: false,
			boards: JSON.parse('<?= $boards ?>')
		});

		$(".kanban-title-board").dblclick(function () {
			if (!$(this).find("#title-edit").is(":visible")) {
				let holder = $("#title-edit").clone()
				holder.show().find("input").val($(this).text())
				$(this).append(holder)
			}
		})

		$('.kanban-drag').find(".kanban-item").dblclick(function () {
			let holder = $("#title-edit-task").clone()
			if (!$(this).find("#title-edit-task").is(":visible")) {
				holder.show()
				holder.find("input").css("max-width", "200px")
				holder.find("input").val($(this).find("div").eq(1).text())
				$(this).append(holder)
			}
		})

		var toDoButton = document.getElementById("addToDo");
		toDoButton.addEventListener("click", function(event) {
			event.preventDefault()
			KanbanTest.addElement("_todo", {
				title: "Test Add"
			});
		});

		var addBoardDefault = document.getElementById("addDefault");
		addBoardDefault.addEventListener("click", function(event) {
			event.preventDefault()
			KanbanTest.addBoards([
				{
					id: $("#board_title").val(),
					title: $("#board_title").val(),
				}
			]);

			$.ajax({
				method: "POST",
				url: "/admin/smme/Smme/saveBoard",
				data: {
					title: $("#board_title").val(),
					smmeId: "<?= $smme_id ?>",
				}
			})
		});

		var removeBoard = document.getElementById("removeBoard");
		removeBoard.addEventListener("click", function(event) {
			event.preventDefault()
			KanbanTest.removeBoard("_done");
		});

		var removeElement = document.getElementById("removeElement");
		removeElement.addEventListener("click", function(event) {
			event.preventDefault()
			KanbanTest.removeElement("_test_delete");
		});

		var allEle = KanbanTest.getBoardElements("_todo");
		allEle.forEach(function(item, index) {
			//console.log(item);
		});

	})

	function closeTitle(elem) {
		let t = $(elem).prev("#title-edit-input").val()
		$(elem).parent().parent().text(t)
		$(elem).parent().remove()
	}

	function closeTitleTask(elem) {
		let t = $(elem).prev("#title-edit-input").val()
		$(elem).parent().parent().find("div").eq(1).text(t)
		$(elem).parent().remove()
	}

	function removeTask(elem) {
		$(elem).parent().parent().remove()
	}


</script>

