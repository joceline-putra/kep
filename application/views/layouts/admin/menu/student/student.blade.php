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
                <table id="table_user" class="table table-bordered dt-responsive nowrap align-middle" style="width:100%">
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
<div class="modal fade" id="modal_user" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalgridLabel">Form {{ $data['title'] }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_user" action="javascript:void(0);">
                    <div class="row g-3">  
                        <div class="col-lg-6 col-md-6 col-xs-12 padding-remove-side">
                            <label class="form-label">Photo</label>
                            <div>
                                <a style="display:block;" class="files_link" href="#">
                                    <img id="files_preview" src="{{ URL::asset('/') }}uploads/noimage.png" class="img-responsive" height="120px" width="240px" style="margin-bottom:5px;"/>
                                </a>
                                <div class="custom-file">
                                    <input class="form-control" id="uploads" name="uploads" type="file" tabindex="1">
                                    <!-- <label class="custom-file-label">Pilih Gambar</label> -->
                                </div>
                            </div>
                        </div>                            
                        <div class="col-lg-6">
                            <label class="form-label">School</label>
                            <select id="user_school" name="user_school" class="form-select mb-3" aria-label="Default select">
                                <option value="0" selected>Select</option>
                            </select>
                        </div>                                                
                        <div class="col-lg-6">
                            <label class="form-label">Grades</label>
                            <select id="user_grade" name="user_grade" class="form-select mb-3" aria-label="Default select">
                                <option value="0" selected>Select</option>
                            </select>
                        </div>
                        <div class="col-md-12 col-xs-12">
                            <label class="form-label">City</label>
                            <select name="user_city" id="user_city" class="form-select">
                                <option value="0">Choice</option>
                            </select>
                        </div>                         
                        <div class="col-ll-6">
                            <div>
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="user_fullname" name="user_fullname">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label for="genderInput" class="form-label">Gender</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="user_gender" id="user_gender" value="Laki-laki">
                                    <label class="form-check-label">Laki-Laki</label>
                                </div>
                                <div class="form-check form-radio-outline form-radio-success form-check-inline">
                                    <input class="form-check-input" type="radio" name="user_gender" id="user_gender" value="Perempuan" checked>
                                    <label class="form-check-label">Perempuan</label>
                                </div>
                            </div>
                        </div>                         
                        <div class="col-lg-6">
                            <div>
                                <label class="form-label">Birth Date</label>
                                <input type="text" class="form-control" id="user_birth" name="user_birth" value="" readonly>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-6">
                            <div>
                                <label class="form-label">Birth Place</label>
                                <input type="text" class="form-control" id="user_birth_place" name="user_birth_place">
                            </div>
                        </div>                        
                        <div class="col-ll-6">
                            <div>
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" id="user_email" name="user_email">
                            </div>
                        </div>
                        <div class="col-ll-6">
                            <div>
                                <label class="form-label">Password</label>
                                <input type="text" class="form-control" id="user_password" name="user_password">
                            </div>
                        </div>
                        <div class="col-ll-6">
                            <div>
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" id="user_phone" name="user_phone">
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-12">
                            <label for="statusInput" class="form-label">Status</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="user_status" id="user_status" value="0">
                                    <label class="form-check-label">Inactive</label>
                                </div>
                                <div class="form-check form-radio-outline form-radio-success form-check-inline">
                                    <input class="form-check-input" type="radio" name="user_status" id="user_status" value="1" checked>
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