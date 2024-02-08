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
                <table id="table_news" class="table table-bordered dt-responsive nowrap align-middle" style="width:100%">
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
<div class="modal fade modal-xl" id="modal_news" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalgridLabel">Form {{ $data['title'] }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_news" action="javascript:void(0);" enctype="multipart/form-data">
                    <div class="row g-3">
                        <div class="col-ll-6">
                            <div>
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" id="news_title" name="news_title">
                            </div>
                        </div>
                        <div class="col-ll-6">
                            <div>
                                <label class="form-label">Content</label>
                                <textarea class="form-control" id="news_content" name="news_content" rows="3"></textarea>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-6">
                            <div>
                                <label class="form-label">Publish Date</label>
                                <input type="text" class="form-control" id="news_publish_date" name="news_publish_date" value="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label class="form-label">Expired Date</label>
                                <input type="text" class="form-control" id="news_expired_date" name="news_expired_date" value="">
                            </div>
                        </div>                     
                        <!--end col-->
                        <div class="col-lg-12">
                            <label for="genderInput" class="form-label">Status</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="news_status" id="news_status" value="0">
                                    <label class="form-check-label">Inactive</label>
                                </div>
                                <div class="form-check form-radio-outline form-radio-success form-check-inline">
                                    <input class="form-check-input" type="radio" name="news_status" id="news_status" value="1" checked>
                                    <label class="form-check-label">Active</label>
                                </div>
                            </div>
                        </div> 
                        <div class="col-lg-12 col-md-12 col-xs-12 padding-remove-side">
                            <label class="form-label">Image</label>
                            <div>
                                <a style="display:block;" class="files_link" href="#">
                                    <img id="files_preview" src="{{ URL::asset('/') }}storage/noimage.png" class="img-responsive" height="120px" width="240px" style="margin-bottom:5px;"/>
                                </a>
                                <div class="custom-file">
                                    <input class="form-control" id="uploads" name="uploads" type="file" tabindex="1">
                                    <!-- <label class="custom-file-label">Pilih Gambar</label> -->
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