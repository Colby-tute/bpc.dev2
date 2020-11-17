<?= $header ?>

<div class="container">
    <div class="breadcrumb-header justfify-content-between">
        <div class="my-auto">
            <div class="d-flex"><h4 class="content-title mb-0 my-auto">Add Question</h4></div>
        </div>
    </div>
    <div class="main-content-app pd-b-0  main-content-calendar pt-0">
        <div class="card">
            <div class="card-body">
                <form action="<?= site_url("incubator/Calendar/create") ?>" method="post">
                    <div class="row">
                        <input type="hidden" name="user_id" value="<?= $user_id ?>">
                        <div class="col-sm-6" style="margin-bottom: 15px;">
                            <label class="form-label">
                                Question
                            </label>
                            <input type="text" name="title" value="" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $footer ?>