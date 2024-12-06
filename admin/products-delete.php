<?php
require '../config/function.php';

$paramResultId = checkParamId('id');
if (is_numeric($paramResultId)) {
    $peoductId =validate($paramResultId); 
    $products = getById('products',$peoductId);
    if($products['status'] == 200){
        $productsDelete = delete('products',$peoductId);
        if($productsDelete){
            $deleteImg = "../".$products['data']['image'];
            if(file_exists($deleteImg)){
                unlink($deleteImg);
            }
            redirect('products.php', 'Product Deleted Successfully');

        }else{
            redirect('products.php', 'Something Went Wrong!');

        }
    }else{
        redirect('products.php', $products['message']);
    }
}else{
    redirect('products.php', 'Something Went Wrong!');
}
?>