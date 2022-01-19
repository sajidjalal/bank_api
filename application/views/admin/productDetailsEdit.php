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



        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title"> <?= $productDetails[0]->product_name; ?> For Stage <?= $productDetails[0]->stage_name; ?></h4>
                        <br>
                        <p class="card-title-desc">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                        </p>
                        <p class="card-title-desc">
                            <?= @$productDetails[0]->product_description; ?>
                        </p>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">
                                            Fill Form Details
                                        </h4>

                                        <form name="productDetailsEdit" id="productDetailsEdit">
                                            <fieldset id="itemInformation">
                                                <?php foreach ($productDetails as $key => $value) { ?>
                                                    <div class="row mb-4">
                                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label"><?= $value->item_name; ?></label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control dropped" data-id="<?= $value->ppdid ?>" data-quantity="quantity" data-rate="" name="quantity_<?= $value->ppdid ?>" id="quantity_<?= $value->ppdid ?>" value="<?= $value->quantity ?>" placeholder="Please Enter Quantity">
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control dropped" data-id="<?= $value->ppdid ?>" data-quantity="" data-rate="rate" name="rate_<?= $value->ppdid ?>" id="rate_<?= $value->ppdid ?>" value="<?= $value->rate ?>" placeholder="Please Enter Rate">
                                                        </div>
                                                    </div>
                                                <?php } ?>

                                                <div class="row justify-content-end">
                                                    <div class="col-sm-9">
                                                        <div>
                                                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                    <!-- end card body -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

<!-- Custome js -->
<script src="/public/layouts/assets/customeTheme/js/productDetailsEdit.js"></script>