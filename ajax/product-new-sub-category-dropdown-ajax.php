<?php
include_once('../sys/core/init.inc.php');

// create a new function
function search($text, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS ){
	
	// connection to the Ddatabase
	$db = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASS);
	// let's filter the data that comes in
  $text = htmlspecialchars($text);
  
  if($text == ""){
    echo "";
  }else {
    // prepare the mysql query to select the users
    $get_name = $db->prepare("SELECT * FROM tbl_sub_category WHERE categoryId = :subCategoryName");
    // execute the query
    $get_name -> execute(array('subCategoryName' => $text));
    // show the users on the page
    while($names = $get_name->fetch(PDO::FETCH_ASSOC)){
      // show each user as a link
      
      echo '
        <option value="'.$names['id'].'">'.$names['subCategoryName'].'</option>
      ';
    }
  }
	
}
// call the search function with the data sent from Ajax
search($_GET['txt'], $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS);
?>