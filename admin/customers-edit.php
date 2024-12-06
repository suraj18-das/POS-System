<?php include('includes/header.php'); ?>


<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Edit Customer
                <a href="customers.php" class="btn btn-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <form action="code.php" method="POST">

            <?php
                 $paramValue = checkParamId('id');
                 if(!is_numeric($paramValue)){
                     echo '<h5>Id is not numeric </h5>'; 
                     return false;
                 }
                $customersData = getById('customers', $paramValue);
                if ($customersData) {
                    if ($customersData['status'] == 200) {
                ?>
                        <input type="hidden" name="customer_id" value="<?= $customersData['data']['id']; ?>">
                <div class="row">

                    <div class="col-md-12 mb-3">
                        <label for="">Name *</label>
                        <input type="text" name="name" required value="<?= $customersData['data']['name']; ?>" class="form-control" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Email</label>
                        <input type="email" name="email" value="<?= $customersData['data']['email']; ?>" class="form-control" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Phone</label>
                        <input type="number" name="phone" value="<?= $customersData['data']['phone']; ?>" class="form-control" />
                    </div>
                    <div class="col-md-6">
                        <label for="">Status (Unchecked = Visible, Checked = Hidden) </label>
                        <br>
                        <input type="checkbox" name="status" <?= $customersData['data']['status'] == true ? 'checked' : ''; ?> style="width: 30px; height: 30px; " />
                    </div>
                    <div class="col-md-6 mb-3 text-end">
                        <br>
                        <button type="submit" name="updateCustomer" class="btn btn-primary">Update</button>
                    </div>
                </div>
                <?php
                    } else {
                        echo '<h5>' . $adminData['message'] . '</h5>';
                    }
                } else {
                    echo 'Something Went Wrong!';
                    return false;
                }
                ?>
            </form>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>