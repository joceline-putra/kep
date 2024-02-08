<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-3">
                        <h5 class="card-title mb-0">{{ $data['title'] }}s Data</h5>
                    </div>
                    <div class="col-lg-9">
                        <div class="text-end">
                            <button id="btn_new" type="button" class="btn btn-secondary btn-label rounded-pill">
                                <i class="ri-add-circle-line label-icon align-middle rounded-pill fs-16 me-2"></i> 
                                New {{ $data['title'] }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="table_lesson" class="table table-bordered dt-responsive nowrap align-middle" style="width:100%">
                    <thead>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Grids in modals -->
<div class="modal fade" id="modal_lesson" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalgridLabel">Form {{ $data['title'] }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_lesson" action="javascript:void(0);" enctype="multipart/form-data">
                    <div class="row g-3"> 
                        <div class="col-md-12 col-xs-12 padding-remove-side">
                            <label class="form-label">Lesson Name</label>
                            <input name="lesson_name" id="lesson_name" type="text" class="form-control mb-3">
                        </div>      
                        <div class="col-md-4 col-xs-12 padding-remove-side">
                            <label class="form-label">Grade (Grade X, XI, XII)</label>
                            <select name="lesson_grade" id="lesson_grade" class="form-select mb-3">
                                <option value="0">Pilih</option>
                            </select>                                  
                        </div>
                        <div class="col-md-4 col-xs-12 padding-remove-side">
                            <label class="form-label">Department (IPA,IPS,E)</label>
                            <select name="lesson_grade_department" id="lesson_grade_department" class="form-select mb-3">
                                <option value="0">Pilih</option>
                            </select>                                  
                        </div>                               
                        <div class="col-lg-12">
                            <label for="statusInput" class="form-label">Status</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input name="lesson_status" class="form-check-input" id="lesson_status_0" type="radio" value="0"><label class="form-check-label">Inactive</label>
                                </div>
                                <div class="form-check form-radio-outline form-radio-success form-check-inline">
                                    <input name="lesson_status" class="form-check-input" id="lesson_status_1" value="1" type="radio" checked><label class="form-check-label">Active</label>
                                </div>
                            </div>
                        </div>                                                   
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button id="btn_save" type="button" class="btn btn-success btn-label rounded-pill">
                                    <i class="ri-save-line label-icon align-middle rounded-pill fs-16 me-2"></i> 
                                    Save
                                </button> 
                                <button id="btn_close" type="button" class="btn btn-warning btn-label rounded-pill">
                                    <i class="ri-close-line label-icon align-middle rounded-pill fs-16 me-2"></i> 
                                    Close
                                </button>                               
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_croppie" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div id="modal_croppie_canvas"></div>
            </div>
            <div class="modal-footer">
                <button id="modal_croppie_save" type="button" class="btn btn-primary"><span class="fas fa-crop"></span> Crop</button>                
                <button id="modal_croppie_cancel" type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fas fa-times"></span> Close</button>
            </div>
        </div>
    </div>
</div>