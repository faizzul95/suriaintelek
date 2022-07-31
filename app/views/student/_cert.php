<script src="framework/js/printThis.js"></script>

<div class="row">
    <div id="certContent"></div>
    <div class="col-12 mt-2">
        <button type="button" class="btn btn-danger float-end w-20" data-bs-dismiss="modal"> Close </button>
        <button id="printSlipBtn" type="button" class="btn btn-info float-end w-20 me-2" onclick="printData('certContent', this.id)"> <i class="fa fa-print"></i> Print </button>
        <button id="downloadSlipBtn" type="button" class="btn btn-success float-end w-20 me-2" onclick="saveCertImage('graduation_certificate')"> <i class="fa fa-download"></i> Download </button>
    </div>
</div>

<script>
    // get data array from general function
    function getPassData(baseUrl, token, data) {
        getStudentDetail(data.stud_id);
    }

    async function getStudentDetail(stud_id) {
        const res = await callApi('post', "student/studentCertByStudID", stud_id);
        if (isSuccess(res)) {
            const data = res.data;
            $('#certContent').html(data);
        } else {
            noti(res.status); // show error message
        }
    }

    function saveCertImage(fileName) {
        const generateBtnText = $('#downloadSlipBtn').html();
        loadingBtn('downloadSlipBtn', true, generateBtnText);
        html2canvas(document.querySelector("#certContent"), {
            useCORS: true,
        }).then(function(canvas) {
            var fileContents = canvas.toDataURL("image/png");
            const saveContent = (fileContents, fileName) => {
                const link = document.createElement('a');
                link.download = fileName;
                link.href = fileContents;
                link.click();
            }
            saveContent(fileContents, fileName + '.png');
            loadingBtn('downloadSlipBtn', false, generateBtnText);
        });
    }
</script>