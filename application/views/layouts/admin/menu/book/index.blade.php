<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-2">
                        <h5 class="card-title mb-0">{{ $data['title'] }} Data</h5>
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
                <table id="table_book" class="table table-bordered dt-responsive nowrap align-middle" style="width:100%">
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
<div class="modal fade" id="modal_book" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalgridLabel">Form {{ $data['title'] }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_book" action="javascript:void(0);" enctype="multipart/form-data">
                    <div class="row g-3">      
                        <div class="col-md-12 col-xs-12 padding-remove-side">
                            <label class="form-label">Title</label>
                            <input name="book_title" id="book_title" type="text" class="form-control">
                        </div>
                        <div class="col-md-3 col-xs-3 padding-remove-side">
                            <label class="form-label">Grade</label>
                            <select id="book_grade" name="book_grade" class="form-control mb-3" aria-label="Default select">
                                <option value="0" selected>Select</option>
                            </select>       
                        </div>                        
                        <div class="col-md-3 col-xs-3 padding-remove-side">
                            <label class="form-label">Type</label>
                            <select id="book_type" name="book_type" class="form-control mb-3" aria-label="Default select">
                                <option value="0" selected>Select</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-xs-3 padding-remove-side">
                            <label class="form-label">Topic</label>
                            <select id="book_topic" name="book_topic" class="form-control mb-3" aria-label="Default select">
                                <option value="0" selected>Select</option>
                            </select>      
                        </div>
                        <div class="col-md-3 col-xs-3 padding-remove-side">
                            <label class="form-label">Publisher</label>
                            <select id="book_publisher" name="book_publisher" class="form-control mb-3" aria-label="Default select">
                                <option value="0" selected>Select</option>
                            </select>        
                        </div>
                        <div class="col-md-12 col-xs-12 padding-remove-side">
                            <label class="form-label">Short Description</label>
                            <textarea name="book_description" id="book_description" class="form-control"></textarea>
                        </div>
                        <div class="col-lg-12">
                            <label for="statusInput" class="form-label">Status</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="book_status" id="book_status" value="0">
                                    <label class="form-check-label">Inactive</label>
                                </div>
                                <div class="form-check form-radio-outline form-radio-success form-check-inline">
                                    <input class="form-check-input" type="radio" name="book_status" id="book_status" value="1" checked>
                                    <label class="form-check-label">Active</label>
                                </div>
                            </div>
                        </div> 
                        <div class="col-lg-6 col-md-6 col-xs-12 padding-remove-side">
                            <label class="form-label">License</label>
                            <select id="book_subscription" name="book_subscription" class="form-select mb-3" aria-label="Default select">
                                <option value="1" selected>Free</option>
                                <option value="2">Paid</option>
                            </select>  
                        </div>                 
                        <div class="col-lg-6 col-md-6 col-xs-12 padding-remove-side book-price">
                            <label class="form-label">Price</label>
                            <input name="book_price" id="book_price" type="text" class="form-control">
                        </div>                 
                        <div class="col-lg-12 col-md-12 col-xs-12 padding-remove-side">
                            <label class="form-label">PDF</label>
                            <div>
                                <div class="custom-file">
                                    <input class="form-control" id="uploads" name="uploads" type="file" tabindex="1">
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