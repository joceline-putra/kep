<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-4">
                        <h5 class="card-title mb-0">{{ $data['title'] }}s Data</h5>
                    </div>
                    <div class="col-lg-8">
                        <div class="text-end">
                            <button id="btn_new" type="button" class="btn btn-secondary btn-label rounded-pill">
                                <i class="ri-add-circle-line label-icon align-middle rounded-pill fs-16 me-2"></i> 
                                New {{ $data['title'] }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-header">

                <div class="row">
                    <div class="col-md-6 col-xs-6 padding-remove-side">
                        <label class="form-label">Search</label>
                        <input name="filter_search" id="filter_search" type="text" class="form-control">
                    </div>                     
                    <div class="col-md-2 col-xs-2">
                        <label class="form-label">Status</label>
                        <select name="filter_status" id="filter_status" class="form-select">
                            <option value="1">Running</option>
                            <option value="0">Inactive</option>
                            <option value="2">Ended</option>
                            <option value="4">Archieve</option>                                                                                    
                            <option value="ALL" selected>All</option>
                        </select>
                    </div>            
                    <div class="col-md-2 col-xs-2">
                        <label class="form-label">Rows</label>
                        <select name="filter_length" id="filter_length" class="form-select">
                            <option value="10" selected>10 Rows</option>
                            <option value="25">25 Rows</option>
                            <option value="50">50 Rows</option>
                            <option value="100">100 Rows</option>
                        </select>
                    </div>                                                         
                </div>  
            </div>            
            <div class="card-body">              
                <table id="table_period" class="table table-bordered dt-responsive nowrap align-middle" style="width:100%">
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
<div class="modal fade" id="modal_period" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalgridLabel">Form {{ $data['title'] }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_contract" action="javascript:void(0);">
                    <div class="row g-3">
                        <div class="col-md-12 col-xs-12"> 
                            <div class="row g-3">                                  
                                <div class="col-md-6 col-xs-6 mb-3">
                                    <label class="form-label">Start Period</label>
                                    <input name="contract_start_date" id="contract_start_date" type="text" class="form-control" disabled>
                                </div>
                                <div class="col-md-6 col-xs-6 mb-3">
                                    <label class="form-label">End Period</label>
                                    <input name="contract_end_date" id="contract_end_date" type="text" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-12 col-xs-12 mb-3">
                                <label class="form-label">Entry On</label>
                                <input name="contract_date_created" id="contract_date_created" type="text" class="form-control" disabled>
                            </div>                            
                            <div class="col-lg-12 mb-3">
                                <label for="schoolInput" class="form-label">Status</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="contract_status" value="0">
                                        <label class="form-check-label">Inactive</label>
                                    </div>
                                    <div class="form-check form-radio-outline form-radio-success form-check-inline">
                                        <input class="form-check-input" type="radio" name="contract_status" value="1" checked>
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
                                <!-- <button id="btn_close" type="button" class="btn btn-warning btn-label rounded-pill">
                                    <i class="ri-close-line label-icon align-middle rounded-pill fs-16 me-2"></i> 
                                    Close
                                </button> -->
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </form>              
            </div>
        </div>
    </div>
</div>