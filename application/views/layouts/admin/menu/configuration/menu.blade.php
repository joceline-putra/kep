<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-2">
                        <h5 class="card-title mb-0">{{ $data['title'] }}s Data</h5>
                    </div>
                    <div class="col-lg-10">
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
                <table id="table_menu" class="table table-bordered dt-responsive nowrap align-middle" style="width:100%">
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
<div class="modal fade" id="modal_menu" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalgridLabel">Form {{ $data['title'] }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_menu" action="javascript:void(0);">
                    <div class="row g-3">                                                      
                        <div class="d-none col-lg-6">
                            <label class="form-label">Parent Menu</label>
                            <select id="menu_parent_id" name="menu_parent_id" class="form-select mb-3" aria-label="Default select example">
                                <option value="0" selected>Select</option>
                            </select>
                        </div>
                        <div class="col-ll-6">
                            <div>
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" id="menu_name" name="menu_name">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-6">
                            <div>
                                <label class="form-label">Icon</label>
                                <input type="text" class="form-control" id="menu_icon" name="menu_icon">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-6">
                            <div>
                                <label class="form-label">Link</label>
                                <input type="text" class="form-control" id="menu_link" name="menu_link" >
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label for="genderInput" class="form-label">Status Menu</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="menu_status" id="menu_status" value="0">
                                    <label class="form-check-label">Inactive</label>
                                </div>
                                <div class="form-check form-radio-outline form-radio-success form-check-inline">
                                    <input class="form-check-input" type="radio" name="menu_status" id="menu_status" value="1" checked>
                                    <label class="form-check-label">Active</label>
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