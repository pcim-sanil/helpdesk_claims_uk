<?php
DEFINE('LIVE', false);
DEFINE('CONTACT_EMAIL', 'info@pcim.com.au');
DEFINE('BASE_URI', realpath(__DIR__ . '/..') . "/");
DEFINE('BASE_URL', 'http://192.168.0.20/helpdesk_claims_uk/');
DEFINE('MYSQL', BASE_URI . 'mysql.inc.php');

function my_error_handler($e_number, $e_message, $e_file, $e_line, $e_vars)
{

    // Build the error message:
    $message = "An error occurred in script '$e_file' on line $e_line:\n$e_message\n";

    // Add the backtrace:
    $message .= "<pre>" . print_r(debug_backtrace(), 1) . "</pre>\n";

    if (!LIVE) {
        // Show the error in the browser.
        echo '<div class="alert alert-danger">' . nl2br($message) . '</div>';
    } else {
        // Development (print the error).
        // Send the error in an email:
        error_log($message, 1, CONTACT_EMAIL, 'From:admin@example.com');

        // Only print an error message in the browser, if the error isn't a notice:
        if ($e_number != E_NOTICE) {
            echo '<div class="alert alert-danger">A system error occurred. We apologize for the inconvenience.</div>';
        }
    } // End of $live IF-ELSE.

    return true; // So that PHP doesn't try to handle the error, too.
}
