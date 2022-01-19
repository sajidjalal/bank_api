<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">customer Lead</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Customer </a></li>
                            <li class="breadcrumb-item active">customer Create</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- Item Table Start -->
        <div class="row">
            <div class="col-12">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Bootstrap Validation - Normal</h4>
                            <p class="card-title-desc">
                                Provide valuable, actionable feedback to your users with HTML5 form validation available in all our supported browsers.
                            </p>
                            <form class="" id="CreateLeadForm" name="CreateLeadForm" method="POST">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="first_name" class="form-label">First name</label>
                                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter First Name">
                                            <label id="first_name_error" class="myError"></label>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="mobile_number" class="form-label">Mobile</label>
                                            <input type="text" class="form-control" name="mobile_number" id="mobile_number" placeholder="Enter Mobile Number" maxlength="10">
                                            <label id="mobile_number_error" class="myError"></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email">
                                            <label id="email_error" class="myError"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
                                            <label id="password_error" class="myError"></label>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <button class="btn btn-primary" type="submit">Submit form</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
        </div>

        <!-- Item Table End -->

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

<script src="/public/layouts/assets/customeTheme/js/createLead.js"></script>