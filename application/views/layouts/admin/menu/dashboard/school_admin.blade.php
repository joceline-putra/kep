<div class="h-100">
    <div class="row mb-3 pb-1">
        <div class="col-12">
            <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-16 mb-1">Good {{ (date('H') > 17) ? "Evening" : ((date('H') > 12) ? "Afternoon" : "Morning") }}, {{ !empty($data['session']['user_fullname']) ? $data['session']['user_fullname'] : 'Johns Doe' }}!</h4>
                    <p class="text-muted mb-0">Here's what's happening with your dashboard today.</p>
                </div>
                <!--
                <div class="mt-3 mt-lg-0">
                    <form action="javascript:void(0);">
                        <div class="row g-3 mb-0 align-items-center">
                            <div class="col-sm-auto">
                                <div class="input-group">
                                    <input type="text" class="form-control border-0 dash-filter-picker shadow" data-provider="flatpickr" data-range-date="true" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022">
                                    <div class="input-group-text bg-primary border-primary text-white">
                                        <i class="ri-calendar-2-line"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-soft-success"><i class="ri-add-circle-line align-middle me-1"></i> Add Product</button>
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-soft-info btn-icon waves-effect waves-light layout-rightside-btn"><i class="ri-pulse-line"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                -->
            </div><!-- end card header -->
        </div>
        <!--end col-->
    </div>
</div>

<div class="row">
    <div class="col-xl-4">
        <div class="card card-height-100">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Student by Grades</h4>
                <div class="flex-shrink-0">
                    <button type="button" class="btn btn-soft-info btn-sm">
                        <i class="ri-file-list-3-line align-middle"></i> Generate Report
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div id="chart_one" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card card-height-100">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Lesson Responsbility</h4>
                <div class="flex-shrink-0">
                    <button type="button" class="btn btn-soft-info btn-sm">
                        <i class="ri-file-list-3-line align-middle"></i> Generate Report
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div id="chart_two" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
    </div>    
</div>
<div class="row">
    <div class="col-xxl-12 order-xxl-0 order-first">
        <div class="d-flex flex-column h-100">
            <div class="row h-100">
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
                                    <p class="text-uppercase fw-semibold fs-12 text-muted mb-1"> Grades</p>
                                    <h4 class=" mb-0"><span id="total_grade" class="counter-value" data-target="2390">0</span></h4>
                                </div>
                                <div class="flex-shrink-0 align-self-end">
                                    <!-- <span class="badge bg-success-subtle text-success"><i class="ri-arrow-up-s-fill align-middle me-1"></i>6.24 %<span> </span></span> -->
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
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
                                    <p class="text-uppercase fw-semibold fs-12 text-muted mb-1"> Teacher</p>
                                    <h4 class=" mb-0"><span id="total_teacher" class="counter-value" data-target="19523.25">0</span></h4>
                                </div>
                                <div class="flex-shrink-0 align-self-end">
                                    <!-- <span class="badge bg-success-subtle text-success"><i class="ri-arrow-up-s-fill align-middle me-1"></i>3.67 %<span> </span></span> -->
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
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
                                    <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">Student</p>
                                    <h4 class=" mb-0"><span id="total_student" class="counter-value" data-target="14799.44">0</span></h4>
                                </div>
                                <div class="flex-shrink-0 align-self-end">
                                    <!-- <span class="badge bg-danger-subtle text-danger"><i class="ri-arrow-down-s-fill align-middle me-1"></i>4.80 %<span> </span></span> -->
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-primary-subtle text-primary rounded-2 fs-2">
                                        <i class="ri-book-mark-line align-middle"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">e-Book</p>
                                    <h4 class=" mb-0"><span id="total_book" class="counter-value" data-target="14799.44">0</span></h4>
                                </div>
                                <div class="flex-shrink-0 align-self-end">
                                    <!-- <span class="badge bg-danger-subtle text-danger"><i class="ri-arrow-down-s-fill align-middle me-1"></i>4.80 %<span> </span></span> -->
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->                
            </div><!-- end row -->
        </div>
    </div><!-- end col -->
</div><!-- end row -->

<div class="row">
    <div class="col-xxl-5">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Upcoming Activities</h4>
                <div class="flex-shrink-0">
                    <div class="dropdown card-header-dropdown">
                        <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted fs-18"><i class="mdi mdi-dots-vertical"></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#">Edit</a>
                            <a class="dropdown-item" href="#">Remove</a>
                        </div>
                    </div>
                </div>
            </div><!-- end card header -->
            <div class="card-body pt-0">
                <ul class="list-group list-group-flush border-dashed">
                    <li class="list-group-item ps-0">
                        <div class="row align-items-center g-3">
                            <div class="col-auto">
                                <div class="avatar-sm p-1 py-2 h-auto bg-light rounded-3">
                                    <div class="text-center">
                                        <h5 class="mb-0">25</h5>
                                        <div class="text-muted">Tue</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <h5 class="text-muted mt-0 mb-1 fs-13">12:00am - 03:30pm</h5>
                                <a href="#" class="text-reset fs-14 mb-0">Meeting for campaign with sales team</a>
                            </div>
                            <div class="col-sm-auto">
                                <div class="avatar-group">
                                    <div class="avatar-group-item">
                                        <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Stine Nielsen">
                                            <img src="{{ asset('velzon/images/users/avatar-1.jpg') }}" alt="" class="rounded-circle avatar-xxs">
                                        </a>
                                    </div>
                                    <div class="avatar-group-item">
                                        <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Jansh Brown">
                                            <img src="{{ asset('velzon/images/users/avatar-2.jpg') }}" alt="" class="rounded-circle avatar-xxs">
                                        </a>
                                    </div>
                                    <div class="avatar-group-item">
                                        <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Dan Gibson">
                                            <img src="{{ asset('velzon/images/users/avatar-3.jpg') }}" alt="" class="rounded-circle avatar-xxs">
                                        </a>
                                    </div>
                                    <div class="avatar-group-item">
                                        <a href="javascript: void(0);">
                                            <div class="avatar-xxs">
                                                <span class="avatar-title rounded-circle bg-info text-white">
                                                    5
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </li><!-- end -->
                    <li class="list-group-item ps-0">
                        <div class="row align-items-center g-3">
                            <div class="col-auto">
                                <div class="avatar-sm p-1 py-2 h-auto bg-light rounded-3">
                                    <div class="text-center">
                                        <h5 class="mb-0">20</h5>
                                        <div class="text-muted">Wed</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <h5 class="text-muted mt-0 mb-1 fs-13">02:00pm - 03:45pm</h5>
                                <a href="#" class="text-reset fs-14 mb-0">Adding a new event with attachments</a>
                            </div>
                            <div class="col-sm-auto">
                                <div class="avatar-group">
                                    <div class="avatar-group-item">
                                        <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Frida Bang">
                                            <img src="{{ asset('velzon/images/users/avatar-4.jpg') }}" alt="" class="rounded-circle avatar-xxs">
                                        </a>
                                    </div>
                                    <div class="avatar-group-item">
                                        <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Malou Silva">
                                            <img src="{{ asset('velzon/images/users/avatar-5.jpg') }}" alt="" class="rounded-circle avatar-xxs">
                                        </a>
                                    </div>
                                    <div class="avatar-group-item">
                                        <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Simon Schmidt">
                                            <img src="{{ asset('velzon/images/users/avatar-6.jpg') }}" alt="" class="rounded-circle avatar-xxs">
                                        </a>
                                    </div>
                                    <div class="avatar-group-item">
                                        <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Tosh Jessen">
                                            <img src="{{ asset('velzon/images/users/avatar-7.jpg') }}" alt="" class="rounded-circle avatar-xxs">
                                        </a>
                                    </div>
                                    <div class="avatar-group-item">
                                        <a href="javascript: void(0);">
                                            <div class="avatar-xxs">
                                                <span class="avatar-title rounded-circle bg-success text-white">
                                                    3
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </li><!-- end -->
                    <li class="list-group-item ps-0">
                        <div class="row align-items-center g-3">
                            <div class="col-auto">
                                <div class="avatar-sm p-1 py-2 h-auto bg-light rounded-3">
                                    <div class="text-center">
                                        <h5 class="mb-0">17</h5>
                                        <div class="text-muted">Wed</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <h5 class="text-muted mt-0 mb-1 fs-13">04:30pm - 07:15pm</h5>
                                <a href="#" class="text-reset fs-14 mb-0">Create new project Bundling Product</a>
                            </div>
                            <div class="col-sm-auto">
                                <div class="avatar-group">
                                    <div class="avatar-group-item">
                                        <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Nina Schmidt">
                                            <img src="{{ asset('velzon/images/users/avatar-8.jpg') }}" alt="" class="rounded-circle avatar-xxs">
                                        </a>
                                    </div>
                                    <div class="avatar-group-item">
                                        <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Stine Nielsen">
                                            <img src="{{ asset('velzon/images/users/avatar-1.jpg') }}" alt="" class="rounded-circle avatar-xxs">
                                        </a>
                                    </div>
                                    <div class="avatar-group-item">
                                        <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Jansh Brown">
                                            <img src="{{ asset('velzon/images/users/avatar-2.jpg') }}" alt="" class="rounded-circle avatar-xxs">
                                        </a>
                                    </div>
                                    <div class="avatar-group-item">
                                        <a href="javascript: void(0);">
                                            <div class="avatar-xxs">
                                                <span class="avatar-title rounded-circle bg-primary text-white">
                                                    4
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </li><!-- end -->
                    <li class="list-group-item ps-0">
                        <div class="row align-items-center g-3">
                            <div class="col-auto">
                                <div class="avatar-sm p-1 py-2 h-auto bg-light rounded-3">
                                    <div class="text-center">
                                        <h5 class="mb-0">12</h5>
                                        <div class="text-muted">Tue</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <h5 class="text-muted mt-0 mb-1 fs-13">10:30am - 01:15pm</h5>
                                <a href="#" class="text-reset fs-14 mb-0">Weekly closed sales won checking with sales team</a>
                            </div>
                            <div class="col-sm-auto">
                                <div class="avatar-group">
                                    <div class="avatar-group-item">
                                        <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Stine Nielsen">
                                            <img src="{{ asset('velzon/images/users/avatar-1.jpg') }}" alt="" class="rounded-circle avatar-xxs">
                                        </a>
                                    </div>
                                    <div class="avatar-group-item">
                                        <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Jansh Brown">
                                            <img src="{{ asset('velzon/images/users/avatar-5.jpg') }}" alt="" class="rounded-circle avatar-xxs">
                                        </a>
                                    </div>
                                    <div class="avatar-group-item">
                                        <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Dan Gibson">
                                            <img src="{{ asset('velzon/images/users/avatar-2.jpg') }}" alt="" class="rounded-circle avatar-xxs">
                                        </a>
                                    </div>
                                    <div class="avatar-group-item">
                                        <a href="javascript: void(0);">
                                            <div class="avatar-xxs">
                                                <span class="avatar-title rounded-circle bg-warning text-white">
                                                    9
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </li><!-- end -->
                </ul><!-- end -->
                <div class="align-items-center mt-2 row g-3 text-center text-sm-start">
                    <div class="col-sm">
                        <div class="text-muted">Showing<span class="fw-semibold">4</span> of <span class="fw-semibold">125</span> Results
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <ul class="pagination pagination-separated pagination-sm justify-content-center justify-content-sm-start mb-0">
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
            </div><!-- end card body -->
        </div><!-- end card -->
    </div>

    <div class="col-xxl-4">
        <div class="card card-height-100">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">News Feed</h4>
                <!-- <div>
                    <button type="button" class="btn btn-soft-primary btn-sm">
                        View all
                    </button>
                </div> -->
            </div><!-- end card-header -->

            <div class="card-body">
                <div id="news_card">
                    <!-- <div class="d-flex mt-4">
                        <div class="flex-shrink-0">
                            <img src="{{ asset('velzon/images/small/img-1.jpg') }}" class="rounded img-fluid" style="height: 60px;" alt="">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1 lh-base"><a href="#" class="text-reset">One stop shop destination on all the latest news in crypto currencies</a></h6>
                            <p class="text-muted fs-12 mb-0">Dec 12, 2021 <i class="mdi mdi-circle-medium align-middle mx-1"></i>09:22 AM</p>
                        </div>
                    </div>
                    <div class="d-flex mt-4">
                        <div class="flex-shrink-0">
                            <img src="{{ asset('velzon/images/small/img-1.jpg') }}" class="rounded img-fluid" style="height: 60px;" alt="">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1 lh-base"><a href="#" class="text-reset">One stop shop destination on all the latest news in crypto currencies</a></h6>
                            <p class="text-muted fs-12 mb-0">Dec 12, 2021 <i class="mdi mdi-circle-medium align-middle mx-1"></i>09:22 AM</p>
                        </div>
                    </div>                     -->
                </div>
                <div class="mt-3 text-center">
                    <a id="btn_news_load_more" class="text-muted text-decoration-underline" style="cursor:pointer;"><span class="fas fa-spinner fa-spin"></span> Load</a>
                </div>

            </div><!-- end card body -->
        </div><!-- end card -->
    </div>
</div>