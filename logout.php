<?php
    session_start();
    include_once('sys/core/init.inc.php');
    $common = new common();

    if(!$_SESSION['UID'] = ''){
        $response['status'] = 'success';

        // Change online status to 'N' i.e. Offline 
        $onlineStatus = $common -> GetRows("
            UPDATE tbl_admin SET online = 'N' WHERE id='".$_SESSION['UID']."'
        ");

        unset($_SESSION['SESSION_PHONE']);
        unset($_SESSION['SESSION_UGID']);
        unset($_SESSION['SESSION_EMAIL']);
        unset($_SESSION['SESSION_UNAME']);
        unset($_SESSION['SESSION_NAMES']);
        unset($_SESSION['UID_Session']);
        session_destroy();
    }else{
        header("Location: index"); /* Redirect browser */
        exit();
    }
    echo json_encode($response);
    exit;
?>