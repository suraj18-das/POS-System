<?php
require '../config/function.php';

$paramResultId = checkParamId('id');
if (is_numeric($paramResultId)) {
    $customersId =validate($paramResultId); 
    $customers = getById('customers',$customersId);
    if($customers['status'] == 200){
        $customersDelete = delete('customers',$customersId);
        if($customersDelete){
            redirect('customers.php', 'Customer Deleted Successfully');

        }else{
            redirect('customers.php', 'Something Went Wrong!');

        }
    }else{
        redirect('customers.php', $customers['message']);
    }
}else{
    redirect('customers.php', 'Something Went Wrong!');
}
?>