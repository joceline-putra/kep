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
                            <button id="btn_confirm" type="button" class="btn btn-info btn-label rounded-pill">
                                <i class="ri-thumb-up-line label-icon align-middle rounded-pill fs-16 me-2"></i> 
                                Confirm
                            </button>
                            <button type="button" class="btn_delete btn btn-danger btn-label rounded-pill">
                                <i class="ri-delete-bin-line label-icon align-middle rounded-pill fs-16 me-2"></i> 
                                Delete
                            </button>
                            <button type="button" class="btn_edit btn btn-primary btn-label rounded-pill">
                                <i class="ri-eye-line label-icon align-middle rounded-pill fs-16 me-2"></i> 
                                View
                            </button>
                            <button id="btn_new" type="button" class="btn btn-secondary btn-label rounded-pill">
                                <i class="ri-add-circle-line label-icon align-middle rounded-pill fs-16 me-2"></i> 
                                New {{ $data['title'] }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 10px;">
                                <div class="form-check">
                                    <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                </div>
                            </th>
                            <th data-ordering="false">SR No.</th>
                            <th data-ordering="false">ID</th>
                            <th data-ordering="false">Purchase ID</th>
                            <th data-ordering="false">Title</th>
                            <th data-ordering="false">User</th>
                            <th>Assigned To</th>
                            <th>Created By</th>
                            <th>Create Date</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">
                                <div class="form-check">
                                    <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                </div>
                            </th>
                            <td>01</td>
                            <td>VLZ-452</td>
                            <td>VLZ1400087402</td>
                            <td><a href="#!">Post launch reminder/ post list</a></td>
                            <td>Joseph Parker</td>
                            <td>Alexis Clarke</td>
                            <td>Joseph Parker</td>
                            <td>03 Oct, 2021</td>
                            <td><span class="badge bg-info-subtle text-info">Re-open</span></td>
                            <td><span class="badge bg-danger">High</span></td>
                            <td>
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a href="#!" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                        <li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                        <li>
                                            <a class="dropdown-item remove-item-btn">
                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <div class="form-check">
                                    <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                </div>
                            </th>
                            <td>02</td>
                            <td>VLZ-453</td>
                            <td>VLZ1400087425</td>
                            <td><a href="#!">Additional Calendar</a></td>
                            <td>Diana Kohler</td>
                            <td>Admin</td>
                            <td>Mary Rucker</td>
                            <td>05 Oct, 2021</td>
                            <td><span class="badge bg-secondary-subtle text-secondary">On-Hold</span></td>
                            <td><span class="badge bg-info">Medium</span></td>
                            <td>
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a href="#!" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                        <li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                        <li>
                                            <a class="dropdown-item remove-item-btn">
                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <div class="form-check">
                                    <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                </div>
                            </th>
                            <td>03</td>
                            <td>VLZ-454</td>
                            <td>VLZ1400087438</td>
                            <td><a href="#!">Make a creating an account profile</a></td>
                            <td>Tonya Noble</td>
                            <td>Admin</td>
                            <td>Tonya Noble</td>
                            <td>27 April, 2022</td>
                            <td><span class="badge bg-danger-subtle text-danger">Closed</span></td>
                            <td><span class="badge bg-success">Low</span></td>
                            <td>
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a href="#!" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                        <li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                        <li>
                                            <a class="dropdown-item remove-item-btn">
                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <div class="form-check">
                                    <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                </div>
                            </th>
                            <td>04</td>
                            <td>VLZ-455</td>
                            <td>VLZ1400087748</td>
                            <td><a href="#!">Apologize for shopping Error!</a></td>
                            <td>Joseph Parker</td>
                            <td>Alexis Clarke</td>
                            <td>Joseph Parker</td>
                            <td>14 June, 2021</td>
                            <td><span class="badge bg-warning-subtle text-warning">Inprogress</span></td>
                            <td><span class="badge bg-info">Medium</span></td>
                            <td>
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a href="#!" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                        <li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                        <li>
                                            <a class="dropdown-item remove-item-btn">
                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <div class="form-check">
                                    <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                </div>
                            </th>
                            <td>05</td>
                            <td>VLZ-456</td>
                            <td>VLZ1400087547</td>
                            <td><a href="#!">Support for theme</a></td>
                            <td>Donald Palmer</td>
                            <td>Admin</td>
                            <td>Donald Palmer</td>
                            <td>25 June, 2021</td>
                            <td><span class="badge bg-danger-subtle text-danger">Closed</span></td>
                            <td><span class="badge bg-success">Low</span></td>
                            <td>
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a href="#!" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                        <li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                        <li>
                                            <a class="dropdown-item remove-item-btn">
                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <div class="form-check">
                                    <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                </div>
                            </th>
                            <td>06</td>
                            <td>VLZ-457</td>
                            <td>VLZ1400087245</td>
                            <td><a href="#!">Benner design for FB & Twitter</a></td>
                            <td>Mary Rucker</td>
                            <td>Jennifer Carter</td>
                            <td>Mary Rucker</td>
                            <td>14 Aug, 2021</td>
                            <td><span class="badge bg-warning-subtle text-warning">Inprogress</span></td>
                            <td><span class="badge bg-info">Medium</span></td>
                            <td>
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a href="#!" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                        <li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                        <li>
                                            <a class="dropdown-item remove-item-btn">
                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <div class="form-check">
                                    <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                </div>
                            </th>
                            <td>07</td>
                            <td>VLZ-458</td>
                            <td>VLZ1400087785</td>
                            <td><a href="#!">Change email option process</a></td>
                            <td>James Morris</td>
                            <td>Admin</td>
                            <td>James Morris</td>
                            <td>12 March, 2022</td>
                            <td><span class="badge bg-primary-subtle text-primary">Open</span></td>
                            <td><span class="badge bg-danger">High</span></td>
                            <td>
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a href="#!" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                        <li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                        <li>
                                            <a class="dropdown-item remove-item-btn">
                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <div class="form-check">
                                    <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                </div>
                            </th>
                            <td>08</td>
                            <td>VLZ-460</td>
                            <td>VLZ1400087745</td>
                            <td><a href="#!">Support for theme</a></td>
                            <td>Nathan Cole</td>
                            <td>Nancy Martino</td>
                            <td>Nathan Cole</td>
                            <td>28 Feb, 2022</td>
                            <td><span class="badge bg-secondary-subtle text-secondary">On-Hold</span></td>
                            <td><span class="badge bg-success">Low</span></td>
                            <td>
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a href="#!" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                        <li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                        <li>
                                            <a class="dropdown-item remove-item-btn">
                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <div class="form-check">
                                    <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                </div>
                            </th>
                            <td>09</td>
                            <td>VLZ-461</td>
                            <td>VLZ1400087179</td>
                            <td><a href="#!">Form submit issue</a></td>
                            <td>Grace Coles</td>
                            <td>Admin</td>
                            <td>Grace Coles</td>
                            <td>07 Jan, 2022</td>
                            <td><span class="badge bg-success-subtle text-success">New</span></td>
                            <td><span class="badge bg-danger">High</span></td>
                            <td>
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a href="#!" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                        <li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                        <li>
                                            <a class="dropdown-item remove-item-btn">
                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <div class="form-check">
                                    <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                </div>
                            </th>
                            <td>10</td>
                            <td>VLZ-462</td>
                            <td>VLZ140008856</td>
                            <td><a href="#!">Edit customer testimonial</a></td>
                            <td>Freda</td>
                            <td>Alexis Clarke</td>
                            <td>Freda</td>
                            <td>16 Aug, 2021</td>
                            <td><span class="badge bg-danger-subtle text-danger">Closed</span></td>
                            <td><span class="badge bg-info">Medium</span></td>
                            <td>
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a href="#!" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                        <li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                        <li>
                                            <a class="dropdown-item remove-item-btn">
                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <div class="form-check">
                                    <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                </div>
                            </th>
                            <td>11</td>
                            <td>VLZ-463</td>
                            <td>VLZ1400078031</td>
                            <td><a href="#!">Ca i have an e-copy invoice</a></td>
                            <td>Williams</td>
                            <td>Admin</td>
                            <td>Williams</td>
                            <td>24 Feb, 2022</td>
                            <td><span class="badge bg-primary-subtle text-primary">Open</span></td>
                            <td><span class="badge bg-success">Low</span></td>
                            <td>
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a href="#!" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                        <li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                        <li>
                                            <a class="dropdown-item remove-item-btn">
                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <div class="form-check">
                                    <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                </div>
                            </th>
                            <td>12</td>
                            <td>VLZ-464</td>
                            <td>VLZ1400087416</td>
                            <td><a href="#!">Brand logo design</a></td>
                            <td>Richard V.</td>
                            <td>Admin</td>
                            <td>Richard V.</td>
                            <td>16 March, 2021</td>
                            <td><span class="badge bg-warning-subtle text-warning">Inprogress</span></td>
                            <td><span class="badge bg-danger">High</span></td>
                            <td>
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a href="#!" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                        <li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                        <li>
                                            <a class="dropdown-item remove-item-btn">
                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <div class="form-check">
                                    <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                </div>
                            </th>
                            <td>13</td>
                            <td>VLZ-466</td>
                            <td>VLZ1400089015</td>
                            <td><a href="#!">Issue with finding information about order ?</a></td>
                            <td>Olive Gunther</td>
                            <td>Alexis Clarke</td>
                            <td>Schaefer</td>
                            <td>32 March, 2022</td>
                            <td><span class="badge bg-success-subtle text-success">New</span></td>
                            <td><span class="badge bg-danger">High</span></td>
                            <td>
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a href="#!" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                        <li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                        <li>
                                            <a class="dropdown-item remove-item-btn">
                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <div class="form-check">
                                    <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                </div>
                            </th>
                            <td>14</td>
                            <td>VLZ-467</td>
                            <td>VLZ1400090324</td>
                            <td><a href="#!">Make a creating an account profile</a></td>
                            <td>Edwin</td>
                            <td>Admin</td>
                            <td>Edwin</td>
                            <td>05 April, 2022</td>
                            <td><span class="badge bg-warning-subtle text-warning">Inprogress</span></td>
                            <td><span class="badge bg-success">Low</span></td>
                            <td>
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a href="#!" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                        <li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                        <li>
                                            <a class="dropdown-item remove-item-btn">
                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Grids in modals -->
<div class="modal fade" id="modal_sample" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalgridLabel">Grid Modals</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0);">
                    <div class="row g-3">
                        <div class="col-xxl-6">
                            <div>
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" placeholder="Enter firstname">
                            </div>
                        </div><!--end col-->
                        <div class="col-xxl-6">
                            <div>
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" placeholder="Enter lastname">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <label for="genderInput" class="form-label">Gender</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                    <label class="form-check-label" for="inlineRadio1">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                    <label class="form-check-label" for="inlineRadio2">Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                                    <label class="form-check-label" for="inlineRadio3">Others</label>
                                </div>
                            </div>
                        </div><!--end col-->
                        <div class="col-xxl-6">
                            <div>
                                <label for="emailInput" class="form-label">Email</label>
                                <input type="email" class="form-control" id="emailInput" placeholder="Enter your email">
                            </div>
                        </div><!--end col-->
                        <div class="col-xxl-6">
                            <div>
                                <label for="passwordInput" class="form-label">Password</label>
                                <input type="password" class="form-control" id="passwordInput" value="451326546">
                            </div>
                        </div><!--end col-->
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