<?php
require '../config/function.php';

$paramResultId = checkParamId('id');
if (is_numeric($paramResultId)) {
    $categoryId =validate($paramResultId); 
    $categories = getById('categories',$categoryId);
    if($categories['status'] == 200){
        $categoriesDelete = delete('categories',$categoryId);
        if($categoriesDelete){
            redirect('categories.php', 'Category Deleted Successfully');

        }else{
            redirect('categories.php', 'Something Went Wrong!');

        }
    }else{
        redirect('categories.php', $categories['message']);
    }
}else{
    redirect('categories.php', 'Something Went Wrong!');
}
?>