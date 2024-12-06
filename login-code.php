<?php
require 'config/function.php';
if (isset($_POST['loginBtn'])) {
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    if ($email != '' && $password != '') {
        $sql = "SELECT * FROM admins WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row['password'];

            if(!password_verify($password,$hashedPassword)){
                redirect('login.php','Invalid Password');
            }
            if($row['is_ban'] == 1){
                redirect('login.php','Your account has been banned');
            }
            $_SESSION['loggedIn'] = true;
            $_SESSION['loggedInUser'] = [
                'user_id' => $row['id'],
                'name' => $row['name'],
                'email' => $row['email'],
                'phone' => $row['phone'],
            ];
            redirect('admin/index.php','You have been logged in');
        }else{
            redirect('login.php','Somtheing Went Wrong');
        }
    } else {
        redirect('login.php', 'All field are required');
    }
}
