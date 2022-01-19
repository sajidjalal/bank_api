<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Transaction Page</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Deposit</a></li>
                            <li class="breadcrumb-item active"> Withdraw</li>
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
                                                <p class="text-muted text-truncate mb-2">Current Balance</p>
                                                <h5 class="mb-0"><?= @$lastDepositDetails->balance; ?></h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div>
                                                <p class="text-muted text-truncate mb-2">Updated Date</p>
                                                <h5 class="mb-0"><?= @$lastDepositDetails->created_at; ?></h5>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div>
                                                <!-- <p class="text-muted text-truncate mb-2">Employee Code</p>
                                                <h5 class="mb-0"><?= @$userInfo->emp_code; ?></h5> -->

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

                        <div class="col-xl-12">
                            <div class="mt-8">
                                <h4 class="card-title">Last Transaction Details</h4>
                                <p class="card-title-desc">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                </p>
                                <div class="d-flex flex-wrap gap-2">

                                    <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#depostiModal">Deposit</button>

                                    <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#withdrawModal">withdraw</button>


                                </div>

                            </div>
                            <br>

                        </div>


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
                                                <th>Transaction Type</th>
                                                <th>Transaction Amount</th>
                                                <th>Balance Amount</th>
                                                <th>Transaction Time</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php foreach ($userTranactionList as $key => $value) { ?>
                                                <tr>
                                                    <td><?= $key + 1; ?> </td>
                                                    <td><?= $value->first_name; ?> </td>
                                                    <td><?php
                                                        if ($value->transaction_type == 1) {
                                                            echo "Deposite";
                                                        } else {
                                                            echo "Withdrawl";
                                                        }
                                                        ?> </td>
                                                    <td><?php
                                                        if ($value->transaction_type == 1) {
                                                            echo $value->deposite;
                                                        } else {
                                                            echo $value->withdraw;
                                                        }
                                                        ?> </td>
                                                    <td><?= $value->balance; ?> </td>
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

<!-- Modal -->

<!--  Dposite Large modal example -->
<div class="modal fade bs-example-modal-lg" id="depostiModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Deposit Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="depositForm" method="post">
                    <div class="row mar-1 mb-1">
                        <div class="col-md-6">
                            <label for="account_type">Select Account Type<span class="red"> *</span></label>
                            <select id="account_type" name="account_type" class="form-control " style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                <option selected="selected" value="" disabled>Choose one</option>
                                <option value="savings">savings</option>
                                <!-- <option value="current">current</option> -->
                            </select>
                            <label id="account_type_error" class="myError"></label>
                        </div>
                        <br>

                        <div class="form-group col-md-6" id="deposite_div">
                            <label for="deposite">Amount<span class="red"> *</span></label>
                            <input id="deposite" name="deposite" type="text" class="form-control" placeholder="Enter Amount">
                            <label id="deposite_error" class="myError"></label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" id="additionalInfoFormSubmit" class="btn btn-primary">Submit</button>
                        <!-- <button type="button" class="btn cancel-btn" data-dismiss="modal">Close</button> -->
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--  withdraw Large modal example -->
<div class="modal fade bs-example-modal-lg" id="withdrawModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Withdrawl Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="withdrawForm" method="post">
                    <div class="row mar-1 mb-1">
                        <div class="col-md-6">
                            <label for="account_type">Select Account Type<span class="red"> *</span></label>
                            <select id="account_type" name="account_type" class="form-control " style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                <option selected="selected" value="" disabled>Choose one</option>
                                <option value="savings">savings</option>
                                <!-- <option value="current">current</option> -->
                            </select>
                            <label id="account_type_error" class="myError"></label>
                        </div>
                        <br>

                        <div class="form-group col-md-6" id="withdraw_div">
                            <label for="withdraw">Amount<span class="red"> *</span></label>
                            <input id="withdraw" name="withdraw" type="text" class="form-control" placeholder="Enter Amount">
                            <label id="withdraw_error" class="myError"></label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" id="additionalInfoFormSubmit" class="btn btn-primary">Submit</button>
                        <!-- <button type="button" class="btn cancel-btn" data-dismiss="modal">Close</button> -->
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $("#withdraw,#deposite").keyup(function(e) {
        var $th = $(this);

        if (
            e.keyCode != 46 &&
            e.keyCode != 8 &&
            e.keyCode != 37 &&
            e.keyCode != 38 &&
            e.keyCode != 39 &&
            e.keyCode != 40
        ) {
            $th.val(
                $th.val().replace(/[^0-9]/g, function(str) {
                    return "";
                })
            );
        }
        return;
    });
</script>

<script src="/public/layouts/assets/customeTheme/js/deposite.js"></script>