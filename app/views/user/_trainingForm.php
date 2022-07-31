<form id="formTraining" action="teacher/saveTrain" method="POST">

    <div class="row">
        <div class="col-lg-12">
            <label class="form-label"> Training Course <span class="text-danger">*</span></label>
            <input type="text" id="train_course" name="train_course" class="form-control" maxlength="255" onKeyUP="this.value = this.value.toUpperCase();" autocomplete="off" required>
        </div>
    </div>
    
    <div class="row mt-2">
        <div class="col-lg-12">
            <label class="form-label"> Course Details <span class="text-danger">*</span></label>
            <textarea type="text" id="train_description" name="train_description" class="form-control" maxlength="255" autocomplete="off" rows="3" required></textarea>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-lg-6">
            <label class="form-label"> Date Start <span class="text-danger">*</span></label>
            <input type="date" id="train_start_date" name="train_start_date" class="form-control" autocomplete="off" required>
        </div>

        <div class="col-lg-6">
            <label class="form-label"> Date Finish <span class="text-danger">*</span></label>
            <input type="date" id="train_end_date" name="train_end_date" class="form-control" autocomplete="off" required>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-lg-6">
            <label class="form-label"> Upload Cert <span class="text-danger">*</span></label>
            <input type="file" name="training_file" class="form-control" accept="image/x-png,image/jpeg,image/jpg, .pdf" required>
            <div class="alert alert-warning mt-2" role="alert">
                <span class="form-text text-muted"><b> A few notes before you upload certification </b></span>
                <span class="form-text text-muted">
                    <ul>
                        <li> Upload only file with extension jpeg, png and pdf. </li>
                        <li> Files size support <b><i style="color: red"> 5 MB only. </i> </b></li>
                        <li> Please wait for the upload to complete. </li>
                    </ul>
                </span>
            </div>
        </div>
        <div id="listFilesDiv" class="col-lg-6" style="display: none;">
            <label class="form-label"> Files </label>
            <div id="listFiles"></div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-lg-12">
            <span class="text-danger">* Indicates a required field</span>
            <center>
                <input type="hidden" id="user_id_training" name="user_id" placeholder="user_id" readonly>
                <input type="hidden" id="train_id" name="train_id" placeholder="train_id" readonly>
                <input type="hidden" id="files_id" name="files_id" placeholder="files_id" readonly>
                <button type="submit" id="submitBtn" class="btn btn-info"> <i class='fa fa-save'></i> Save </button>
            </center>
        </div>
    </div>
</form>

<script src="public/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js"></script>
<script>
    function getPassData(baseUrl, token, data) {
        var user_id = data.user_id;
        $('#user_id_training').val(user_id);

        if (data != null) {
            $('#listFilesDiv').show();
            
            const document = data.document;
            $('#files_id').val(document.files_id);
            var display = document.files_name + '<span id="upload' + document.files_id + '" class="float-end"><i class="fa fa-eye" style="color:blue" onclick="previewPDF(\'' + document.files_path + '\', \'' + document.files_extension + '\')"></i></span><hr>';

            listFiles = '<tr class="table-dark">\
                            <td colspan="3">\
                                Files \
                            </td>\
                            </tr>\
                            <tr>\
                            <td colspan="3">\
                                ' + display + '\
                            </td>\
                            </tr>';
        }

        $('#listFiles').append('<table class="table table-bordered table-sm">\
                    <tbody>\
                        ' + listFiles + '\
                    </tbody>\
                </table>');
    }

    $("#formTraining").submit(function(event) {
        event.preventDefault();

        const form = $(this);
        const url = form.attr('action');

        cuteAlert({
            type: 'question',
            title: 'Are you sure?',
            message: 'Form will be submitted!',
            closeStyle: 'circle',
            cancelText: 'Abort',
            confirmText: 'Yes, Confirm!',
        }).then(
            async (e) => {
                if (e == 'confirm') {
                    const res = await submitApi(url, form.serializeArray(), 'formTraining');
                    if (isSuccess(res)) {
                        var user_id = $('#user_id_training').val();
                        getListTrain(user_id);
                    }
                }
            }
        );
    });
</script>