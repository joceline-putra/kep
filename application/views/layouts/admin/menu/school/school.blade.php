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
                <table id="table_school" class="table table-bordered dt-responsive nowrap align-middle" style="width:100%">
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
<div class="modal fade" id="modal_school" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalgridLabel">Form School</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_school" action="javascript:void(0);">
                    <div class="row g-3">
                        <div class="row">                        
                            <div class="col-md-6 col-xs-6 mb-3">
                                <label class="form-label">School Name</label>
                                <input name="school_name" id="school_name" type="text" class="form-control">
                            </div>
                            <div class="col-md-6 col-xs-6 mb-3">
                                <label class="form-label">Date of Join</label>
                                <input name="school_date_created" id="school_date_created" type="text" class="form-control" disabled>
                            </div>      
                        </div>    
                        <div class="row">                                                         
                            <div class="col-md-12 col-xs-12 mb-3">
                                <label class="form-label">Address</label>
                                <input name="school_address" id="school_address" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row">                        
                            <div class="col-md-6 col-xs-6 mb-3">
                                <label class="form-label">City</label>
                                <select name="school_city" id="school_city" class="form-select">
                                    <option value="0" selected>Select</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-xs-6 mb-3">
                                <label class="form-label">State</label>
                                <input name="school_state" id="school_state" type="text" class="form-control" disabled>
                            </div>  
                        </div> 
                        <div class="row">                        
                            <div class="col-md-6 col-xs-6  mb-3">
                                <label class="form-label">Phone</label>
                                <input name="school_phone" id="school_phone" type="text" class="form-control">
                            </div>
                            <div class="col-md-6 col-xs-6 mb3">
                                <label class="form-label">Email</label>
                                <input name="school_email" id="school_email" type="text" class="form-control">
                            </div>      
                        </div>    
                        <div class="row">                                                                
                            <div class="col-lg-12 mb-3">
                                <label for="schoolInput" class="form-label">Status</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="school_status" id="school_status" value="0">
                                        <label class="form-check-label">Inactive</label>
                                    </div>
                                    <div class="form-check form-radio-outline form-radio-success form-check-inline">
                                        <input class="form-check-input" type="radio" name="school_status" id="school_status" value="1" checked>
                                        <label class="form-check-label">Active</label>
                                    </div>
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