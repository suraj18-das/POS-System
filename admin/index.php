<?php include('includes/header.php') ?>

<div class="container-fluid px-4">

    <div class="row">
        <div class="col-md-12">
            <h1 class="mt-4">Dashboard</h1>
            <?php alertMessage(); ?>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-body border-dark bg-primary p-3">
                <p class="text-sm mb-0 text-capitalized text-bg-primary">Total Category</p>
                <h5 class="fw-bold mb-0 text-bg-primary">
                    <?= getCount('categories'); ?>
                </h5>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-body border-dark bg-warning p-3 text-white">
                <p class="text-sm mb-0 text-capitalized ">Total Products</p>
                <h5 class="fw-bold mb-0">
                    <?= getCount('products'); ?>
                </h5>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-body border-dark bg-info p-3 text-white">
                <p class="text-sm mb-0 text-capitalized">Total Admins</p>
                <h5 class="fw-bold mb-0">
                    <?= getCount('admins'); ?>
                </h5>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card card-body border-dark bg-dark p-3 text-white">
                <p class="text-sm mb-0 text-capitalized">Total Customers</p>
                <h5 class="fw-bold mb-0">
                    <?= getCount('customers'); ?>
                </h5>
            </div>
        </div>
        <div class="col-md-12 mb-3">
            <hr>
            <h5>Orders</h5>
        </div>
        <div class="col-md-3 mb-3">
            <?php
            $todayDate = date('Y-m-d');
            $todayOrders = mysqli_query($conn, "SELECT * FROM orders WHERE order_date='$todayDate'");
            $totalCountOrders = 0;

            if ($todayOrders && mysqli_num_rows($todayOrders) > 0) {
                $totalCountOrders = mysqli_num_rows($todayOrders);
            }

            // Determine card color based on the order count
            $cardColor = ($totalCountOrders < 5) ? 'bg-danger' : 'bg-success';
            ?>
            <div class="card card-body <?= $cardColor ?> text-white p-3">
                <p class="text-sm mb-0 text-capitalized">Today Orders</p>
                <h5 class="fw-bold mb-0">
                    <?= $totalCountOrders > 0 ? $totalCountOrders : "0"; ?>
                </h5>
            </div>
        </div>

        <div class="col-md-3 mb-3 text-white">
            <div class="card card-body border-dark bg-secondary p-3">
                <p class="text-sm mb-0 text-capitalized">Total Orders</p>
                <h5 class="fw-bold mb-0">
                    <?= getCount('orders'); ?>
                </h5>
            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php') ?>