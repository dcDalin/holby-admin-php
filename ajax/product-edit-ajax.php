<?php

include_once('../sys/core/init.inc.php');
$common = new common();

if($_SESSION['UID'] == ''){
  header("Location: index"); /* Redirect browser */
  exit();
} 

if(filter_has_var(INPUT_POST, 'btn-submit')){
  try {
    $id = intval($_POST['productId']);
    $categoryName = trim($_POST['categoryName']);
    $subCategory = trim($_POST['subCategory']);
    $price = trim($_POST['price']);
    $productName = trim($_POST['productName']);
    $shortDescription = trim($_POST['shortDescription']);
    $longDescription = trim($_POST['longDescription']);
    $thumbnail = trim($_POST['courseThumbnail']);

    $imgFile = $_FILES['thumbnail']['name'];
    $tmp_dir = $_FILES['thumbnail']['tmp_name'];
    $imgSize = $_FILES['thumbnail']['size'];

    $response = array();

    if(empty($imgFile)){
      $sql = $common -> Update("
      UPDATE tbl_products
      SET
        categoryId='".$categoryName."',
        subCategoryId='".$subCategory."',
        price='".$price."',
        productName='".$productName."',
        shortDescription='".$shortDescription."',
        longDescription='".$longDescription."'
      WHERE
        id='".$id."'
    ");

      if($sql){
        $response['status'] = 'success';
        $response['message'] = 'Product successfuly updated. Reloading...';
      }else if(!$sql){
        $response['status'] = 'error';
        $response['message'] = 'Could not update the product';
      }
    }else {
      $upload_dir = '../uploads/product_images/';
      $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension

      // valid image extensions
      $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

      // rename uploading image
      $userpic = rand(1000,1000000).".".$imgExt;

      // allow valid image file formats
      if(in_array($imgExt, $valid_extensions)){
      // Check file size '5MB'
      if($imgSize < 10000000) { 
        unlink("../uploads/product_images/$thumbnail"); 
        move_uploaded_file($tmp_dir,$upload_dir.$userpic); 
      } else{ 
        $response['status']='error' ; 
        $response['message']='Image file is too big' ; 
      } 
    } else{ 
      $response['status'] = 'error' ;
      $response['message'] = 'Only JPG, JPEG, PNG & GIF files are allowed' ; 
    } 
    $sql = $common -> Update("
      UPDATE tbl_products
      SET
        categoryId='".$categoryName."',
        subCategoryId='".$subCategory."',
        price='".$price."',
        productName='".$productName."',
        shortDescription='".$shortDescription."',
        longDescription='".$longDescription."',
        thumbnail='".$userpic."'
      WHERE
        id='".$id."'
    ");

    if($sql){
      $response['status'] = 'success';
      $response['message'] = 'Product successfuly updated. Reloading...';
    }else if(!$sql){
      $response['status'] = 'error';
      $response['message'] = 'Could not update the product';
    }
  }
  echo json_encode($response);
    exit;
  }catch(Exception $e){
    echo $e;
  }
}
/* End ajax login process */
?>