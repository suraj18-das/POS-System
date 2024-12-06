<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Order View
                <a href="order-view-print.php?track=<?= $_GET['track']; ?>" class="btn btn-info mx-2 btn-sm float-end">Print</a>
                <a href="orders.php" class="btn btn-danger mx-2 btn-sm float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>

            <?php
            if (isset($_GET['track'])) {
                if ($_GET['track'] == '') {
            ?>
                    <div class="text-center py-5">
                        <h5>No Tracking Number Found</h5>
                        <div>
                            <a href="orders.php" class="btn btn-primary mt-4 w-25">Go back to orders</a>
                        </div>
                    </div>
                    <?php
                    return false;
                }
                $trackingNo = $_GET['track'];
                $orders = mysqli_query($conn, "SELECT o.*,c.* FROM orders o,customers c 
                            WHERE c.id=o.customer_id AND tracking_no='$trackingNo' 
                            ORDER BY o.id DESC");
                if ($orders) {
                    if (mysqli_num_rows($orders) > 0) {
                        $orderData = mysqli_fetch_assoc($orders);
                        $orderId = $orderData['id'];
                    ?>
                        <div class="card card-body shadow border-1 mb-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Order Details</h4>
                                    <label class="mb-1">
                                        Tracking No:
                                        <span class="fw-bold "><?= $orderData['tracking_no']; ?></span>
                                    </label>
                                    <br>
                                    <label class="mb-1">
                                        Order Date:
                                        <span class="fw-bold "><?= $orderData['order_date']; ?></span>
                                    </label>
                                    <br>
                                    <label class="mb-1">
                                        Order Status:
                                        <span class="fw-bold "><?= $orderData['order_status']; ?></span>
                                    </label>
                                    <br>
                                    <label class="mb-1">
                                        Payment Mode:
                                        <span class="fw-bold "><?= $orderData['payment_mode']; ?></span>
                                    </label>
                                    <br>

                                </div>
                                <div class="col-md-6">
                                    <h4>User Details</h4>
                                    <label class="mb-1">
                                        User Name:
                                        <span class="fw-bold "><?= $orderData['name']; ?></span>
                                    </label>
                                    <br>
                                    <label class="mb-1">
                                        Email Address:
                                        <span class="fw-bold "><?= $orderData['email']; ?></span>
                                    </label>
                                    <br>
                                    <label class="mb-1">
                                        Phone Number:
                                        <span class="fw-bold "><?= $orderData['phone']; ?></span>
                                    </label>
                                    <br>

                                </div>
                            </div>
                        </div>
                        <?php
                        $oredrItemQuery = "SELECT oi.quantity as orderItemQuantity, oi.price as orderItemPrice, o.*, oi.*, p.* FROM orders as o, order_items as oi, products as p WHERE oi.order_id=o.id AND p.id=oi.product_id AND o.tracking_no='$trackingNo' ";
                        $oredrItemResult = mysqli_query($conn, $oredrItemQuery);
                        if ($oredrItemResult) {
                            if (mysqli_num_rows($oredrItemResult) > 0) {
                        ?>
                                <h4 class="my-3">Order Items Details</h4>
                                <table class="table table-striped table-bordered align-items-center justify-content-center">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($oredrItemResult as $orderItemRow): ?>
                                            <tr>
                                                <td>
                                                    <img src="<?= $orderItemRow['image'] != '' ? '../' . $orderItemRow['image'] : 'No Image'; ?>"
                                                        style="width: 50px;height:50px;"
                                                        alt="img">
                                                    <?= $orderItemRow['name']; ?>
                                                </td>
                                                <td width="15%" class="fw-bold ">
                                                    <?= number_format($orderItemRow['orderItemPrice'], 0) ?>
                                                </td>
                                                <td width="15%" class="fw-bold ">
                                                    <?= $orderItemRow['orderItemQuantity']; ?>
                                                </td>
                                                <td width="15%" class="fw-bold ">
                                                    <?= number_format($orderItemRow['orderItemPrice'] * $orderItemRow['orderItemQuantity'], 0); ?>
                                                </td>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td colspan="3" class="text-end fw-bold">Total Price:</td>
                                                <td class="text-end fw-bold">Rs:<?= number_format($orderItemRow['total_amount'], 0); ?></td>
                                            </tr>
                                    </tbody>
                                </table>
                        <?php
                            } else {
                                echo '<h5>Something Went Wrong</h5>';
                                return false;
                            }
                        } else {
                            echo '<h5>Something Went Wrong</h5>';
                            return false;
                        }
                        ?>
                <?php
                    } else {
                        echo '<h5>No Record Found</h5>';
                        return false;
                    }
                } else {
                    echo '<h5>Something Went Wrong</h5>';
                }
            } else {
                ?>
                <div class="text-center py-5">
                    <h5>No Tracking Number Found</h5>
                    <div>
                        <a href="orders.php" class="btn btn-primary mt-4 w-25">Go back to orders</a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>