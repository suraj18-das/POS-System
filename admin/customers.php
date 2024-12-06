<?php include("includes/header.php") ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Customers
                <a href="customers-create.php" class="btn btn-primary float-end">Add Customers</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php
                    $customers = getAll('customers');
                    if (mysqli_num_rows($customers) > 0) {

                    ?>
                        <?php foreach ($customers as $item) : ?>
                            <tbody>
                                <tr>
                                    <td><?= $item['id'] ?></td>
                                    <td><?= $item['name'] ?></td>
                                    <td><?= $item['email'] ?></td>
                                    <td><?= $item['phone'] ?></td>
                                    <td>
                                        <?php
                                        if ($item['status'] == 1) {
                                            echo '<span class="badge bg-danger">Hidden</span>';
                                        } else {
                                            echo '<span class="badge bg-primary">Visible</span>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="customers-edit.php?id=<?= $item['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                        <a href="customers-delete.php?id=<?= $item['id']; ?>"
                                        onclick="return confirm('Are you sure you want to delete the Customer.')"
                                        class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php
                    } else {
                        ?>
                            <tr>
                                <td colspan="4">
                                    <h5> No Record Found</h5>
                                </td>
                            </tr>
                        <?php
                    }
                        ?>
                            </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php") ?>