<?php
  include_once('../sys/core/init.inc.php');
  $common = new common();

  if($_SESSION['UID'] == ''){
    header("Location: index"); /* Redirect browser */
    exit();
  }

  $results = $common -> GetRows("
    SELECT
      tbl_products.id AS productId, tbl_products.categoryId, tbl_products.subCategoryId, tbl_products.price, tbl_products.productName, tbl_products.shortDescription, tbl_products.longDescription, tbl_products.thumbnail,
      tbl_category.id, tbl_category.categoryName,
      tbl_sub_category.id, tbl_sub_category.subCategoryName

    FROM
      tbl_products, tbl_category, tbl_sub_category

    WHERE
      tbl_products.categoryId=tbl_category.id

    AND
      tbl_products.subCategoryId=tbl_sub_category.id
  ");


  foreach ($results as $row){ 
    $id = $row['productId'];
    $categoryName = $row['categoryName'];
    $productName = $row['productName'];
    $price = $row['price'];
    $subCategoryName = $row['subCategoryName'];
    $shortDesc = $row['shortDescription'];
    $longDesc = $row['longDescription'];
    $thumbnail = $row['thumbnail'];

    $blog_arr[] = array(
      "thumbnail" => '
        <img src="uploads/product_images/'.$thumbnail.'" height="100px" width="80px" />
      ',
      "productName" => $productName,
      "categoryName" => $categoryName, 
      "subCategoryName" => $subCategoryName,
      "price" => $price,
      "shortDesc" => $shortDesc,
      "longDesc" => $longDesc,
      "actions" => '
        <a href="product-edit?id='.$id.'" >
          <span class="label label-warning">
            Edit or Delete
          </span>
        </a>
      '
    );
  }
  $show_arr = array(
    'data' => $blog_arr,
  );
  // encoding array to json format    
  echo json_encode($show_arr); 
?>