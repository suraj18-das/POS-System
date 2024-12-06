<?php include("includes/header.php") ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Edit Category
                <a href="admins.php" class="btn btn-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>

            <form action="code.php" method="POST">

                <?php
                if (isset($_GET['id'])) {
                    if ($_GET['id'] != '') {
                        $categoryId = $_GET['id'];
                    } else {
                        echo '<h5>No Id Found</h5>'; 
                        return false;
                    }
                } else {
                    echo '<h5>No Id given in params</h5>'; 
                    return false;
                }

                $categoryData = getById('categories', $categoryId);
                if ($categoryData) {
                    if ($categoryData['status'] == 200) {
                ?>
                        <input type="hidden" name="categoryId" value="<?= $categoryData['data']['id']; ?>">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="">Name *</label>
                                <input type="text" name="name" required value="<?= $categoryData['data']['name']; ?>" class="form-control" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <textarea name="description" class="form-control" rows="3"><?= $categoryData['data']['description']; ?></textarea>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="">Status (Unchecked = Visible, Checked = Hidden)</label>
                                <br>
                                <input type="checkbox" name="status" <?= $categoryData['data']['status'] == true ? 'checked' : ''; ?> style="width:30px;height:30px;" />
                            </div>
                            <div class="col-md-12 mb-3 text-end">
                                <button type="submit" name="updateCategory" class="btn btn-primary">Update</button>
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
<?php include("includes/footer.php") ?>