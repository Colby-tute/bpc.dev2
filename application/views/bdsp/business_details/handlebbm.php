<?php
?>
<?php echo $header ?>
<link href="<?php echo base_url(); ?>assets/css/jkanban.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/bootstrap-datepicker.min.css" rel="stylesheet">

<div class="container">
    <div class="modal fade" id="editQuestionModal" tabindex="-1" role="dialog" aria-labelledby="editQuestionLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editQuestionLabel">Edit Question</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            </button>
          </div>
          <form id="task-edit-form">
          <div class="modal-body">
            <div class="col-sm-12">
                <input type="hidden" id="editQuestionId" name="title" placeholder="Id" class="form-control question_id"/>
                <label>Question</label>
                <input type="text" id="editQuestionText" name="questionText" placeholder="Question" class="form-control question_text"/>
            </div><br />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" id="submit_question_edit" onclick="editQuestion()"  class="btn btn-primary submit_question_edit">Save changes</button>
          </div>
          </form>
        </div>
      </div>
    </div>    
    <div class="breadcrumb-header justify-content-between">
        <div>
            <h4 class="content-title mb-2">Business Building Model Assessment</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url('bdsp/Home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="<?= site_url('bdsp/BusinessDetails/bbm') ?>">Business Building Model</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $user->tbl_users_firstname ?> <?= $user->tbl_users_lastname ?> / MSME-<?= $user->tbl_users_user_uniqueid ?></li>
                </ol>
            </nav>

        </div>
        <div class="my-auto breadcrumb-right">
							<a href="<?= site_url('bdsp/BusinessDetails/bbm') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-arrow-circle-left mr-2"></i></span><span class="btn-text">Go Back </span></button></a>
							<a href="<?= site_url('bdsp/Profile/view_profile/'.$this->session->userdata('id_user')) ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
						</div>
    </div>
    <div class="">
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="border">
                        <div class="bg-gray-300 nav-bg">
                            <nav class="nav nav-tabs">
                                <?php 
                                foreach($phases as $key => $phase) : 
                                    $activeTab = "";
                                    if($key == 0)
                                        $activeTab = " active";
                                    ?>                                  
                                    <a class="nav-link<?= $activeTab ?>" data-toggle="tab" onclick="selectPhase(<?= $phase->id ?>);"><?= $phase->phase ?></a>
                                <?php endforeach; ?>
                            </nav>
                        </div>
                        <div class="bg-gray-300 nav-bg">
                            <nav class="nav nav-tabs">
                            <?php foreach($subphases as $key => $subphase) : 
                                $activeTab = "";
                                if($key == 0)
                                    $activeTab = " active";
                                ?>
                                <a class="nav-link<?= $activeTab ?>" data-toggle="tab" onclick="selectSubPhase(<?= $subphase->id ?>);"><?= $subphase->phase ?></a>
                            <?php endforeach; ?>
                            </nav>
                        </div>
                        <div class="card-body tab-content">
                            <div class="tab-pane active show" id="tabCont">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>Milestone Question</label>
                                        <input type="text" id="question_text" name="questionText" placeholder="Question" class="form-control"/>
                                    </div>                                    
                                    <div class="col-sm-12 mg-t-15">
                                        <button class="btn btn-primary" onclick="createQuestion()" id="create">Create Milestone</button>
                                    </div>
                                </div>
                                <div class="row">                                        
                                    <div class="col-sm-11 text-right">                           
                                        <h3><span class="badge badge-primary" style="color: white;font-size: 12px; line-height: 2" id="questionProgress"></span></h3>
                                    </div>
                                </div>                         
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="table-responsive card-body">
                                            <table id="questions_table" class="table key-buttons text-md-nowrap">
                                                <thead>
                                                <tr>
                                                    <th scope="col">PID</th>
                                                    <th scope="col">Milestone Question</th>
                                                    <th scope="col">Answered</th>
                                                    <th scope="col">Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody id="questions_tbody">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button class="btn btn-primary" onclick="partiallyComplete()" style="margin-left: 15px" id="btnPartiallyComplete">Complete Partially </button>
                                        <button class="btn btn-primary" onclick="completeAll()" id="btnComplete" style="margin-left: 15px;">Complete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
<?= $footer; ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
    var phase = 1;
    var subPhase = 1;
    $(document).ready(function () {
        loadQuestions();
    });
    $('#editQuestionModal').on('show.bs.modal', function (e) {
        if (e.namespace === 'bs.modal') {
            var edit_button = $(e.relatedTarget);
            var question_row = edit_button.parents("tr");
            var question_id = question_row.find(".question_id").val();
            var question_text = question_row.find(".question_text").text();
            $(this).find(".question_id").val(question_id);
            $(this).find(".question_text").val(question_text);
        }
    });
       
    function selectPhase(phaseId)
    {
        phase = phaseId;
        loadQuestions();
    }
    function selectSubPhase(subphaseId)
    {
        subPhase = subphaseId;
        loadQuestions();
    }
    function createQuestion() {
        let questionText = $("#question_text").val();
        let url = window.location.href.split("/");
        let smmeId = url[url.length - 1];
        if(questionText == "" || smmeId == "") {

            alert("Please enter valid question!")
        } else {
            setLoader(true);
            $.ajax({
                method: "post",
                url: '<?= base_url() ?>bdsp/BusinessDetails/processQuestions/'+smmeId,
                data: {
                    questionAction: "createQuestion",
                    questionText: questionText,
                    phaseId: phase,
                    subPhaseId: subPhase,
                    smmeId: smmeId
                },
                success:function(data) {
                  loadQuestions();
                  $("#question_text").val('');
                  setLoader(false);
                }
            })
        }
    }
    function deleteQuestion(questionId) {
        setLoader(true);
        let url = window.location.href.split("/");
        let smmeId = url[url.length - 1];
        $.ajax({
            method: "post",
            url: '<?= base_url() ?>bdsp/BusinessDetails/processQuestions/'+smmeId,
            data: {
                questionAction: "deleteQuestion",
                questionId: questionId,
            },
            success:function(data) {
              loadQuestions();
              setLoader(false);
            }
        })
    }
    function loadQuestions() {
        setLoader(true);
        let url = window.location.href.split("/");
        let smmeId = url[url.length - 1];
        $.ajax({
            method: "post",
            url: '<?= base_url() ?>bdsp/BusinessDetails/processQuestions/'+smmeId,
            data: {
                questionAction: "getQuestions",
                phaseId: phase,
                subPhaseId: subPhase,
                smmeId: smmeId
            },
            success:function(data) {
                updateQuestionUITable(data);
                setLoader(false);
            }
        })
    }
    function editQuestion() {
        let questionId = $("#editQuestionId").val();
        let questionText = $("#editQuestionText").val();
        let url = window.location.href.split("/");
        let smmeId = url[url.length - 1];       
        $.ajax({
            method: "post",
            url: '<?= base_url() ?>bdsp/BusinessDetails/processQuestions/'+smmeId,
            data: {
                questionAction: "editQuestion",
                questionId: questionId,
                questionText: questionText,
            },
            success:function(data) {
              loadQuestions();
              $('#editQuestionModal').modal('hide');
              $('.modal-backdrop').remove();
            }
        })
    }   

    function partiallyComplete() {
        setLoader(true);
        var questionsTab = document.getElementById("questions_table");
        questionIds=[];
        for (var rowIdx = 0; rowIdx < questionsTab.rows.length - 1; rowIdx++) {
            answerStatus = $('#questions_table tbody tr:eq('+rowIdx+')').find('td:eq(2) input').is(':checked')
            if(answerStatus) {
                questionId = $('#questions_table tbody tr:eq('+rowIdx+')').find('td:eq(0) input').val();
                questionIds.push(questionId);
            }
        }
        if(questionIds.length) {
            let url = window.location.href.split("/");
            let smmeId = url[url.length - 1];
            $.ajax({
                method: "post",
                url: '<?= base_url() ?>bdsp/BusinessDetails/processQuestions/'+smmeId,
                data: {
                    questionAction: "partiallyComplete",
                    smmeId: smmeId,
                    questionIds: questionIds
                },
                success:function(data) {
                    loadQuestions(data);
                    setLoader(false);
                }
            })
        } else {
            setLoader(false);
            alert("Please select questions!")
        }
    }

    function completeAll() {
        let url = window.location.href.split("/");
        let smmeId = url[url.length - 1];
        $.ajax({
            method: "post",
            url: '<?= base_url() ?>bdsp/BusinessDetails/processQuestions/'+smmeId,
            data: {
                questionAction: "completeAll",
                phaseId: phase,
                subPhaseId: subPhase,
                smmeId: smmeId
            },
            success:function(data) {
                loadQuestions(data);
            }
        })
    }

    function updateQuestionUITable(questionsData) { 
        var questions = JSON.parse(questionsData)["questions"];
        questionsTable = "";
        questionProgressStatus = "Completed";
        questionProgressStyle = "green";
        isSubmitDisabled = true;
        pointerEvents = 'none';
        if(questions.length) {
            for(var questionIdx = 0; questionIdx < questions.length; questionIdx++) {
                var question = questions[questionIdx];
                isAnswered = parseInt(question['is_answered'],10) ? "checked" : "";
                questionsTable += "<tr>" + 
                                "<td> <span>" + (questionIdx+1) + "</span>" +
                                    "<input type='hidden' class='question_id' value=" + question['id'] + " /></td>" +
                                "<td class='question_text'>" + question['question_text'] + "</td>" +
                                "<td align='center'>" + 
                                    "<input type='checkbox' "+isAnswered+" class='form-check-input' id='exampleCheck1'>" +
                                "</td>" +
                                "<td>" + 
                                    "<i class='fa fa-edit'  data-toggle='modal' data-target='#editQuestionModal'  style='cursor: pointer'></i>" +
                                    "<i class='fa fa-trash' onclick='deleteQuestion("+question['id']+")' style='margin-left: 15px; cursor: pointer'></i>" +
                                "</td>" + 
                            "</tr>";
                if(question['is_answered'] == "0") {
                    questionProgressStatus = "Incomplete"
                    questionProgressStyle = "red"
                    isSubmitDisabled = false
                    pointerEvents = 'all'
                }
            }
            $('#questions_tbody').empty();
            $('#questions_tbody').append(questionsTable);
            document.getElementById('questionProgress').innerHTML = questionProgressStatus;
            document.getElementById('questionProgress').style.backgroundColor = questionProgressStyle;
            $('#btnComplete').prop('disabled', isSubmitDisabled);
            $('#btnPartiallyComplete').prop('disabled', isSubmitDisabled);
            document.getElementById('tabCont').style.pointerEvents = pointerEvents;
        } else {
            $('#questions_tbody').empty();
            $('#questions_tbody').append("<tr>No data to display!</tr>");           
        }
    }
    function setLoader(isLoading) {
        var loader = document.getElementById("global-loader");
        if (loader.style.display === "none" && isLoading) {
            loader.style.display = "block";
        } else if (loader.style.display === "block" && !isLoading) {
            loader.style.display = "none";
        }
    }
</script>
