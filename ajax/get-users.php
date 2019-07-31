<?php
    include_once('../sys/core/init.inc.php');
    $common = new common();
    $results = $common -> GetRows("
        SELECT * FROM tbl_admin
    ");
    $total_rows = $common -> CCGetDBValue("SELECT COUNT(*) FROM tbl_admin ");
    foreach ($results as $row){
        $id = $row['id'];
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $email = $row['email'];
        $gender = $row['gender'];
        $phoneNumber = $row['phoneNumber'];
        $idNumber = $row['idNumber'];

        $users_arr[] = array(
            "id" => $id, 
            "fname" => $firstName, 
            "lname" => $lastName, 
            "email" => $email,
            "gender" => $gender,
            "phoneNumber" => $phoneNumber,
            "idNumber" => $idNumber,
            "actions" => '
                <a class="like" id="like" href="admins-roles?id='.$id.'&fname='.$firstName.'&lname='.$lastName.'&email='.$email.'" title="User Roles"><i class="glyphicon glyphicon-user"></i></a>
                <a class="like" id="like" href="admins-edit?id='.$id.'" title="Edit Admin"><i class="glyphicon glyphicon-edit"></i></a>
                <a class="like" id="like" href="admins-edit?id='.$id.'" title="Delete Admin"><i class="glyphicon glyphicon-remove"></i></a>
            '
        );
    }
    $show_arr = array(
        'data' => $users_arr,
    );
    // encoding array to json format    
    echo json_encode($show_arr); 
?>