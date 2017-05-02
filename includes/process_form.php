<?php
require 'config.inc.php';
require MYSQL;

if (!isset($_SESSION['id'])) {
    exit('Sorry! your session has expired!');
}

$errors = array();
$c      = '';
$u      = '';

if (isset($_POST['mobile']) && $_POST['mobile'] != '' && preg_match("/^[0-9]+$/", $_POST['mobile'])) {
    $m = strip_tags(trim($_POST['mobile']));
    $suffix = substr($m, -10);
    $m      = '44' . $suffix;
} else {
    $errors['mobile'] = 'Please enter a valid mobile number!';
}

if (isset($_POST['ticket_id']) && $_POST['ticket_id'] != '' && preg_match("/^[0-9]+$/", $_POST['ticket_id'])) {
    $t = strip_tags(trim($_POST['ticket_id']));
} else {
    $errors['ticket_id'] = 'Please enter a valid ticket id!';
}

if (isset($_POST['e']) && $_POST['e'] != '') {
    $e = strip_tags(trim($_POST['e']));
} else {
    $errors['e'] = 'Please enter e!';
}

if (isset($_POST['amount']) && $_POST['amount'] != '') {
    $a = strip_tags(trim($_POST['amount']));
} else {
    $errors['amount'] = 'Please enter a valid amount!';
}

if (isset($_POST['fullname']) && $_POST['fullname'] != '') {
    $f = strip_tags(trim($_POST['fullname']));
} else {
    $errors['fullname'] = 'Please enter your full name!';
}

if (isset($_POST['unit']) && $_POST['unit'] != '') {
    $u = strip_tags(trim($_POST['unit']));
} else {
    //  $errors['unit'] = 'Please enter your unit number!';
}

if (isset($_POST['street_no']) && $_POST['street_no'] != '') {
    $s = strip_tags(trim($_POST['street_no']));
} else {
    $errors['street_no'] = 'Please enter your street number!';
}

if (isset($_POST['street']) && $_POST['street'] != '') {
    $st = strip_tags(trim($_POST['street']));
} else {
    $errors['street'] = 'Please enter your street!';
}

if (isset($_POST['suburb']) && $_POST['suburb'] != '') {
    $su = strip_tags(trim($_POST['suburb']));
} else {
    $errors['suburb'] = 'Please enter your suburb!';
}

if (isset($_POST['state']) && $_POST['state'] != '') {
    $sta = strip_tags(trim($_POST['state']));
} else {
    $errors['state'] = 'Please enter your state!';
}

if (isset($_POST['postcode']) && $_POST['postcode'] != '') {
    $p = strip_tags(trim($_POST['postcode']));
} else {
    $errors['postcode'] = 'Please enter your postcode!';
}

if (isset($_POST['sms_service_short_code_id']) && $_POST['sms_service_short_code_id'] != '') {
    $ad = strip_tags(trim($_POST['sms_service_short_code_id']));
} else {
    $errors['sms_service_short_code_id'] = 'Please select advertised name !';
}

if (empty($errors)) {

    // check if refund already claimed

    $q = "SELECT caller_number,eligible_amount,propose_amount,ticket_id, created_date, claimed_on from email where userkey='" . $_SESSION['id']."'";

    $result = mysql_query($q);
    $row    = mysql_fetch_array($result);

    if (!empty($row)) {

        if (!empty($row['claimed_on'])) {
            exit('CLAIMED');
        }

        /**
         * Check if link has expired
         */
        $expiryCheckQuery = "SELECT caller_number,eligible_amount,propose_amount,ticket_id,created_date, claimed_on from email where userkey = '" . $_SESSION['id']."' AND created_date > DATE_SUB(NOW(), INTERVAL 48 HOUR)";

        $r1  = mysql_query($expiryCheckQuery);
        $rw1 = mysql_fetch_array($r1);

        if (empty($rw1)) {
            exit('EXPIRED');
        }

    }






    // OK to proceed!
    // Add the page to the database:
    $q = "INSERT INTO claims (mobile, amount, fullname, unit, street_no, street, suburb, state, postcode, ticket_id, created_date) VALUES ('$m', $a , '$f', '$u', '$s', '$st', '$su', '$sta','$p', $t, now())";
    $r = mysql_query($q);

    $query = "INSERT INTO refund_text(name,refund_mobile,amount_eligible,amount_agreed,unit,street_no,street,suburb,state,postcode,status,created_date,updated_date,ticket_id,mobile,sms_service_short_code_id, refund_source)
VALUES ('$f', '$m', $e, $a, '$u', '$s', '$st', '$su', '$sta','$p', 1,now(), now(), $t, '$m', $ad, 'claims')";
    $r = mysql_query($query);

    $que = "UPDATE tickets SET status='3' WHERE ticket_id='$t'";
    $ret = mysql_query($que);

    /**
     * mark email has claimed;
     */
    
    $markclaimedquery = "UPDATE email SET claimed_on='" . date('Y-m-d H:i:s') . "' WHERE userkey='" . $_SESSION['id']."'";
    $resmarkedclaim   = mysql_query($markclaimedquery);

    // Clear $_POST:
    $_POST = array();

    exit('OK');
}
