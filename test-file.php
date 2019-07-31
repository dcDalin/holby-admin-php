<?php

 /* Start Original Scripts */
 include_once('sys/core/init.inc.php');

 $common = new common();

try {
            $firstName = ucfirst(strtolower(trim('first')));
            $lastName = ucfirst(strtolower(trim('last')));
            $email = strtolower(trim('email@mdail.com'));
            $gender = trim('Male');
            $phoneNumber = trim('0723737683');
            $idNumber = trim('123788737');

            $user_password = substr(md5(microtime()),rand(0,26),6);
            $password = md5($user_password);

            $response = array();

            // Check if email and password are correct 
            $query = $common -> Insert("
              INSERT INTO tbl_admin (firstName, lastName, email, gender, phoneNumber, idNumber, pass)
              VALUES ('".$firstName."', '".$lastName."','".$email."','".$gender."','".$phoneNumber."','".$idNumber."','".$password."')
            ");


            echo '>>>>>>>>>>>>>>';
            echo $query;
            echo '<<<<<<<<<<<<<<';
            if(!$query){
                $response['status'] = 'error'; // could not create user
                $response['message'] = 'Sorry, Could not create new user'; 
            }else if($query){
              $admin_level_id = '1';
              $query2 = $common -> Insert("
                INSERT INTO tbl_admin_and_role_link (admin_id, admin_level_id)
                VALUES ('".$query."', '".$admin_level_id."')
              ");

              if(!$query2){
                $response['status'] = 'error'; // could not create user
                $response['message'] = 'Sorry, Could not create new Admin'; 
              }else if($query2) {
                $response['status'] = 'success'; 
                $response['message'] = 'New user successfuly created'; 

                $message= "
                        Hello $firstName
                        <br /><br />
                        Your Holby Training Solutions Admin Account has been created
                        <br /><br />
                        Below is your password, be sure to change it
                        <br /><br />
                        $user_password
                        <br /><br />
                        Thank you
                    ";
                $subject = "Holby Training Solutions Admin Account Creation";
            
                $common->send_mail($email,$message,$subject, $EMAIL_USERNAME,$EMAIL_PASSWORD);
              }
            } 
            echo json_encode($response);
            exit;
        }catch(Exception $e){
            echo $e;
        }