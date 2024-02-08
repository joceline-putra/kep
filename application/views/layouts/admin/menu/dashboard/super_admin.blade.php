
<div class="row">
    <!-- <div class="col-xxl-12 order-xxl-0 order-first"> -->
        <!-- <div class="d-flex flex-column h-100"> -->
            <!-- <div class="row h-100"> -->
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary-subtle text-primary rounded-2 fs-2">
                                            <i class="ri-building-line align-middle"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">School Registered</p>
                                        <h4 class=" mb-0"><span id="total_school" class="counter-value" data-target="14799.44">0</span></h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-end">
                                        <!-- <span class="badge bg-danger-subtle text-danger"><i class="ri-arrow-down-s-fill align-middle me-1"></i>4.80 %<span> </span></span> -->
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>                      
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary-subtle text-primary rounded-2 fs-2">
                                            <i class="ri-star-s-line align-middle"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="text-uppercase fw-semibold fs-12 text-muted mb-1"> Total Grades</p>
                                        <h4 class=" mb-0"><span id="total_grade" class="counter-value" data-target="2390">0</span></h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-end">
                                        <!-- <span class="badge bg-success-subtle text-success"><i class="ri-arrow-up-s-fill align-middle me-1"></i>6.24 %<span> </span></span> -->
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary-subtle text-primary rounded-2 fs-2">
                                            <i class="ri-user-3-line align-middle"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="text-uppercase fw-semibold fs-12 text-muted mb-1"> Total Teacher</p>
                                        <h4 class=" mb-0"><span id="total_teacher" class="counter-value" data-target="19523.25">0</span></h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-end">
                                        <!-- <span class="badge bg-success-subtle text-success"><i class="ri-arrow-up-s-fill align-middle me-1"></i>3.67 %<span> </span></span> -->
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title  bg-primary-subtle text-primary rounded-2 fs-2">
                                            <i class="ri-user-2-line align-middle"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">Total Student</p>
                                        <h4 class=" mb-0"><span id="total_student" class="counter-value" data-target="14799.44">0</span></h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-end">
                                        <!-- <span class="badge bg-danger-subtle text-danger"><i class="ri-arrow-down-s-fill align-middle me-1"></i>4.80 %<span> </span></span> -->
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>       
                </div>
                <div class="row">
                    <div class="col-xxl-6">
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">School Demographic</h4>
                                <div class="flex-shrink-0">
                                    <button type="button" class="btn btn-soft-info btn-sm">
                                        <i class="ri-file-list-3-line align-middle"></i> Generate Report
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div>
                                    <div id="chart_one" data-colors='["--vz-info", "--vz-info", "--vz-info", "--vz-info", "--vz-danger", "--vz-info", "--vz-info", "--vz-info", "--vz-info", "--vz-info"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>
                    <div class="col-xxl-6">
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Student by School</h4>
                                <div class="flex-shrink-0">
                                    <button type="button" class="btn btn-soft-info btn-sm">
                                        <i class="ri-file-list-3-line align-middle"></i> Generate Report
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div>
                                    <div id="chart_two" data-colors='["--vz-info", "--vz-info", "--vz-info", "--vz-info", "--vz-danger", "--vz-info", "--vz-info", "--vz-info", "--vz-info", "--vz-info"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-height-100">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Last School Registered</h4>
                        <div class="flex-shrink-0">
                            <div class="dropdown card-header-dropdown">
                                <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="text-muted">Report<i class="mdi mdi-chevron-down ms-1"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Download Report</a>
                                    <a class="dropdown-item" href="#">Export</a>
                                    <a class="dropdown-item" href="#">Import</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="table-responsive table-card">
                            <table id="school_last_register" class="table table-centered table-hover align-middle table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <td colspan="2">
                                            <span class="text-muted" style="text-align:center;"><span class="fas fa-spinner fa-spin"></span> Loading data</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table><!-- end table -->
                        </div>

                        <!--
                        <div class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">
                            <div class="col-sm">
                                <div class="text-muted">
                                    Showing <span class="fw-semibold">5</span> of <span class="fw-semibold">25</span> Results
                                </div>
                            </div>
                            <div class="col-sm-auto  mt-3 mt-sm-0">
                                <ul class="pagination pagination-separated pagination-sm mb-0 justify-content-center">
                                    <li class="page-item disabled">
                                        <a href="#" class="page-link">←</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link">1</a>
                                    </li>
                                    <li class="page-item active">
                                        <a href="#" class="page-link">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link">→</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        -->

                    </div>
                </div>
            </div>
            <!-- </div> -->
        <!-- </div> -->
    <!-- </div> -->
</div>