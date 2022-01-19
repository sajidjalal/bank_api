<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Item LIST</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Item</a></li>
                            <li class="breadcrumb-item active">Item List</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- Item Table Start -->
        <div class="row">
            <div class="col-lg-12">
                <div class="">
                    <div class="table-responsive">
                        <table id="datatable" class="table project-list-table table-nowrap align-middle table-borderless">
                            <thead>
                                <tr>
                                    <th style="width: 100px">#</th>
                                    <th>Project Name</th>
                                    <th>Details by Item</th>
                                    <th>Details by Product</th>
                                    <th>Created Date</th>
                                    <th>Status</th>
                                    <th>Created By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($projectList as $key => $value) {

                                ?>
                                    <tr>
                                        <td><?= $key + 1; ?> </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14">
                                                <a href="javascript: void(0);" class="text-dark">
                                                    <?= $value->project_name; ?>
                                                </a>
                                            </h5>
                                            <p class="text-muted mb-0">
                                                <?= $value->project_description; ?>
                                            </p>
                                        </td>

                                        <td>
                                            <h5 class="text-truncate font-size-14">
                                                <a href="/admin/projectByItem/<?= $value->pid; ?>" class="text-dark">
                                                    By Item
                                                </a>
                                            </h5>
                                        </td>

                                        <td>
                                            <h5 class="text-truncate font-size-14">
                                                <a href="/admin/projectByProduct/<?= $value->pid; ?>" class="text-dark">
                                                    By Product
                                                </a>
                                            </h5>
                                        </td>

                                        <td>
                                            <?= date('jS F, y ', strtotime($value->created_at)) ?>
                                        </td>

                                        <td>
                                            <?php if ($value->isactive) { ?>
                                                <span class="badge bg-success">Active</span>
                                            <?php } else { ?>
                                                <span class="badge bg-danger">In Active</span>
                                            <?php } ?>
                                        </td>

                                        <td>
                                            <div class="avatar-group">
                                                <?php if (@$value->profile_pic) { ?>
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block" title="<?= @$value->first_name; ?>">
                                                            <img src="<?= $value->profile_pic; ?>" alt="" class="rounded-circle avatar-xs">
                                                        </a>
                                                    </div>
                                                <?php } else { ?>


                                                    <?php if (@$value->first_name) { ?>

                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-inline-block" title="<?= @$value->first_name; ?>">
                                                                <div class="avatar-xs">
                                                                    <span class="avatar-title rounded-circle bg-success text-white font-size-16 custome-uppercase">
                                                                        <?= $value->first_name[0]; ?>
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="avatar-group-item">
                                                            <a href="javascript: void(0);" class="d-inline-block">
                                                                <img src="/public/layouts/assets/images/users/default.png" alt="" class="rounded-circle avatar-xs" title="No Information Present">
                                                            </a>
                                                        </div>
                                                    <?php } ?>


                                                <?php } ?>

                                            </div>
                                        </td>

                                        <td>
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-toggle card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-dots-horizontal font-size-18"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>





                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Item Table End -->

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->