<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Profile Page</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- Profile Details Start -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <img src="https://i.stack.imgur.com/YQu5k.png" alt="" class="avatar-md rounded-circle img-thumbnail">
                                    </div>
                                    <div class="flex-grow-1 align-self-center">
                                        <div class="text-muted">
                                            <p class="mb-2">Welcome to ABC Dashboard</p>
                                            <h5 class="mb-1"><?= $userInfo->first_name; ?> </h5>
                                            <p class="mb-0"><?= $userInfo->role_name; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 align-self-center">
                                <div class="text-lg-center mt-4 mt-lg-0">
                                    <div class="row">
                                        <div class="col-6">
                                            <div>
                                                <p class="text-muted text-truncate mb-2">Email</p>
                                                <h5 class="mb-0"><?= @$userInfo->email; ?></h5>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div>
                                                <p class="text-muted text-truncate mb-2">Mobile</p>
                                                <h5 class="mb-0"><?= @$userInfo->mobile_number; ?></h5>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div>
                                                <p class="text-muted text-truncate mb-2">Employee Code</p>
                                                <h5 class="mb-0"><?= @$userInfo->emp_code; ?></h5>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 d-none d-lg-block">
                                <div class="clearfix mt-4 mt-lg-0">
                                    <div class="dropdown float-end">
                                        <!-- <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-pencil align-middle me-1"></i> Update
                                        </button> -->
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Profile Details End -->




        <!-- last login detaiils start -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Last Five Login Details</h4>
                        <p class="card-title-desc">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                        </p>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <!-- <table id="datatable" class="table project-list-table table-nowrap align-middle table-borderless"> -->

                                    <table id="datatable" class="table project-list-table table-nowrap align-middle table-borderless">

                                        <!-- <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100 dataTable no-footer dtr-inline" role="grid" aria-describedby="datatable-buttons_info"> -->
                                        <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Name</th>
                                                <th>IP Address</th>
                                                <th>Login Time</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php foreach ($userLast5LoginDetails as $key => $value) { ?>
                                                <tr>
                                                    <td><?= $key + 1; ?> </td>
                                                    <td><?= $value->first_name; ?> </td>
                                                    <td><?= $value->ip; ?> </td>
                                                    <td><?= $value->created_at; ?> </td>

                                                </tr>
                                            <?php } ?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div> <!-- end col -->
        </div>
        <!-- last login detaiils end -->

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->