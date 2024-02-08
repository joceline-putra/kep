<style>
    .form-switch-success .form-check-input {
        background-color: rgb(240, 101, 72);
        /* border-color: red; */
        border-bottom-color: rgb(240, 101, 72);
        border-left-color: rgb(240, 101, 72);
        border-right-color: rgb(240, 101, 72);
        border-top-color: rgb(240, 101, 72);
        --vz-form-switch-bg: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23fff'/%3e%3c/svg%3e");
        }
    .form-switch-success .form-check-input:focus {
        --vz-form-switch-bg: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23fff'/%3e%3c/svg%3e");
    }        
    .form-switch-success .form-check-input:checked {
        background-color: #0ab39c;
        border-color: #0ab39c;
    }    
</style>
<div class="row"> 
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-2">
                        <h5 class="card-title mb-0">{{ $data['title'] }}</h5>
                    </div>
                    <div class="col-lg-10">
                    <p class="text-end">
                    Please use this configuration carefully, Modify data will change the role of Level User
                </p>  
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p class="text-muted">
                    <code>Read</code> = User can visit the page, read data existing<br>
                    <code>Write</code> = User can save new data, store new data<br>
                    <code>Modify</code> = User can update data, modify data existing<br>
                    <code>Delete</code> = User can remove data, delete data existing<br>                                                            
                </p>         
                <div class="row">
                    <div class="col-md-3">
                        <div class="nav flex-column nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <?php 
                        foreach($data['level'] as $i => $v){
                            $selected = 'false';
                            $active = '';
                            if($i == 0){
                                $selected = 'true';
                                $active = 'active';
                            }
                            echo '<a style="text-align:left;" name="nav-custom" class="nav-link '.$active.'" id="v-pills-'.$v["level_id"].'-tab" data-id="'.$v['level_id'].'" data-bs-toggle="pill" href="#v-pills-'.$v["level_id"].'" role="tab" aria-controls="v-pills-'.$v["level_id"].'" aria-selected="'.$selected.'">'.$v["level_name"].'</a>';
                        }
                        ?>
                        </div>
                    </div><!-- end col -->
                    <div class="col-md-9">
                        <div class="tab-contents text-muted mt-4 mt-md-0" id="v-pills-tabContent">              
                            <div class="table-responsive">
                                <table data-id="1" class="table_temporary table align-middle table-nowrap mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Menu</th>
                                            <th scope="col" style="text-align:left;">Read</th>
                                            <th scope="col" style="text-align:left;">Write</th>
                                            <th scope="col" style="text-align:left;">Modify</th>
                                            <th scope="col" style="text-align:left;">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!--  end col -->
                </div>
                <!--end row-->
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