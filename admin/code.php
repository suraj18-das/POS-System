<?php
include('../config/function.php');

if (isset($_POST['saveAdmin'])) {
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $phone = validate($_POST['phone']);
    $is_ban = isset($_POST['is_ban']) == true ? 1 : 0;
    if ($name != '' && $email != '' && $password != '') {
        $emailCheck = mysqli_query($conn, "SELECT * FROM admins WHERE email ='$email'");
        if ($emailCheck) {
            if (mysqli_num_rows($emailCheck) > 0) {
                redirect('admins-create.php', 'Email already used by another user.');
            }
        }
        $bcryptpassword = password_hash($password, PASSWORD_BCRYPT);
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $bcryptpassword,
            'phone' => $phone,
            'is_ban' => $is_ban
        ];
        $result = insert('admins', $data);
        if ($result) {
            redirect('admins.php', 'Admin Created Successfully!');
        } else {
            redirect('admins-create.php', 'Something Went Wrong!');
        }
    } else {
        redirect('admins-create.php', 'Please fill required field.');
    }
}

if (isset($_POST['updateAdmin'])) {
    $adminId = validate($_POST['adminId']);
    $adminData = getById('admins', $adminId);
    if ($adminData['status'] != 200) {
        redirect('admins-edit.php?id=' . $adminId, 'Please fill required field.');
    }
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $phone = validate($_POST['phone']);
    $is_ban = isset($_POST['is_ban']) == true ? 1 : 0;

    // For checking if email already exist or not
    $emailCheckQuery = "SELECT * FROM admins WHERE email='$email' AND id!='$adminId'";
    $checkResult = mysqli_query($conn, $emailCheckQuery);
    if ($checkResult) {
        if (mysqli_num_rows($checkResult) > 0) {
            redirect('admins-edit.php?id=' . $adminId, 'Email already used by another user');
        }
    }

    // check if password is updated or not
    if ($password != '') {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    } else {
        $hashedPassword = $adminData['data']['password'];
    }
    if ($name != '' && $email != '') {
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'phone' => $phone,
            'is_ban' => $is_ban
        ];
        $result = update('admins', $adminId, $data);
        if ($result) {
            redirect('admins-edit.php?id=' . $adminId, 'Admin Updated Successfully!');
        } else {
            redirect('admins-edit.php?id=' . $adminId, 'Something Went Wrong!');
        }
    } else {
        redirect('admins-create.php', 'Please fill required field.');
    }
}

if (isset($_POST['saveCategory'])) {
    $categoryName = validate($_POST['name']);
    $categoryDescription = validate($_POST['description']);
    $status = isset($_POST['status']) == true ? 1 : 0;

    $data = [
        'name' => $categoryName,
        'description' => $categoryDescription,
        'status' => $status
    ];
    $result = insert('categories', $data);
    if ($result) {
        redirect('categories.php', 'Category Created Successfully!');
    } else {
        redirect('categories-create.php', 'Something Went Wrong!');
    }
}

if (isset($_POST['updateCategory'])) {
    $categoryId = validate($_POST['categoryId']);
    $categoryName = validate($_POST['name']);
    $categoryDescription = validate($_POST['description']);
    $status = isset($_POST['status']) == true ? 1 : 0;

    $data = [
        'name' => $categoryName,
        'description' => $categoryDescription,
        'status' => $status
    ];
    $result = update('categories', $categoryId, $data);
    if ($result) {
        redirect('categories-edit.php?id=' . $categoryId, 'Category Updated Successfully!');
    } else {
        redirect('categories-edit.php?id=' . $categoryId, 'Something Went Wrong!');
    }
}

if (isset($_POST['saveProducts'])) {
    $category_id = validate($_POST['category_id']);
    $productName = validate($_POST['name']);
    $productDescription = validate($_POST['description']);
    $productPrice = validate($_POST['price']);
    $productQty = validate($_POST['quantity']);
    $status = isset($_POST['status']) == true ? 1 : 0;

    if ($_FILES['image']['size'] > 0) {
        $path = "../assets/uploads/products";
        $image_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        $fileName = time() . '.' . $image_ext;
        move_uploaded_file($_FILES['image']['tmp_name'], $path . "/" . $fileName);
        $finalImage = "assets/uploads/products/" . $fileName;
    } else {
        $finalImage = "";
    }

    $data = [
        'category_id' => $category_id,
        'name' => $productName,
        'description' => $productDescription,
        'price' => $productPrice,
        'quantity' => $productQty,
        'image' => $finalImage,
        'status' => $status
    ];
    $result = insert('products', $data);
    if ($result) {
        redirect('products.php', 'Products Created Successfully!');
    } else {
        redirect('products-create.php', 'Something Went Wrong!');
    }
}

if (isset($_POST['updateProduct'])) {
    $productId = validate($_POST['productId']);
    $product = getById('products', $productId);
    if (!$product) {
        redirect('products.php', 'Product Not Found!');
    }
    $category_id = validate($_POST['category_id']);
    $productName = validate($_POST['name']);
    $productDescription = validate($_POST['description']);
    $productPrice = validate($_POST['price']);
    $productQty = validate($_POST['quantity']);
    $status = isset($_POST['status']) == true ? 1 : 0;

    if ($_FILES['image']['size'] > 0) {
        $path = "../assets/uploads/products";
        $image_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        $fileName = time() . '.' . $image_ext;
        move_uploaded_file($_FILES['image']['tmp_name'], $path . "/" . $fileName);
        $finalImage = "assets/uploads/products/" . $fileName;
        $deleteImg = "../" . $product['data']['image'];
        if (file_exists($deleteImg)) {
            unlink($deleteImg);
        }
    } else {
        $finalImage = $product['data']['image'];
    }

    $data = [
        'category_id' => $category_id,
        'name' => $productName,
        'description' => $productDescription,
        'price' => $productPrice,
        'quantity' => $productQty,
        'image' => $finalImage,
        'status' => $status
    ];
    $result = update('products', $productId, $data);
    if ($result) {
        redirect('products.php?id=' . $productId, 'Products Updated Successfully!');
    } else {
        redirect('products-edit.php?id=' . $productId, 'Something Went Wrong!');
    }
}

if (isset($_POST['saveCustomer'])) {
    $customerName = validate($_POST['name']);
    $customerEmail = validate($_POST['email']);
    $customerPhone = validate($_POST['phone']);
    $status = isset($_POST['status']) == true ? 1 : 0;
    if ($customerName != '') {
        $emailCheck = mysqli_query($conn, "SELECT * FROM customers WHERE email='$customerEmail' LIMIT 1");
        if ($emailCheck) {
            if (mysqli_num_rows($emailCheck) > 0) {
                redirect('customers.php', 'Email already used by another user');
            }
        }

        $data = [
            'name' => $customerName,
            'email' => $customerEmail,
            'phone' => $customerPhone,
            'status' => $status
        ];
        $result = insert('customers', $data);
        if ($result) {
            redirect('customers.php', 'Customer Added Successfully!');
        } else {
            redirect('customers.php', 'Something Went Wrong!');
        }
    } else {
        redirect('customers.php', 'Please Fill Required Field');
    }
}

if (isset($_POST['updateCustomer'])) {
    $customer_id = validate($_POST['customer_id']);
    $customerName = validate($_POST['name']);
    $customerEmail = validate($_POST['email']);
    $customerPhone = validate($_POST['phone']);
    $status = isset($_POST['status']) == true ? 1 : 0;
    if ($customerName != '') {
        $emailCheck = mysqli_query($conn, "SELECT * FROM customers WHERE email='$customerEmail' AND id!='$customer_id'");
        if ($emailCheck) {
            if (mysqli_num_rows($emailCheck) > 0) {
                redirect('customers-edit.php?id=' . $customer_id, 'Email already used by another user');
            }
        }

        $data = [
            'name' => $customerName,
            'email' => $customerEmail,
            'phone' => $customerPhone,
            'status' => $status
        ];
        $result = update('customers',$customer_id, $data);
        if ($result) {
            redirect('customers.php?', 'Customer Updated Successfully!');
        } else {
            redirect('customers-edit.php?id=' . $customer_id, 'Something Went Wrong!');
        }
    } else {
        redirect('customers-edit.php?id=' . $customer_id, 'Please Fill Required Field');
    }
}
