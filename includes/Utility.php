<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utility
 *
 * @author developer2
 */
class Utility {
    
    public static function r($data, $label = '') {
        $trace = debug_backtrace();
        $html = '';
        $html.= '<p style=background:red;padding:4px;margin:0px;>';
        $html.= 'File : <i>' . $trace[0]['file'] . ' </i>, at  Line number :';
        $html.= '<b>' . $trace[0]['line'] . '</b>';
        $html.= '</p>';
        echo $html;
        if ($label) {
            echo $label . '<hr>';
        }
        echo '<pre style="background:#e0e0e0;padding:4px;margin:0px;clear:both;">';
        print_r($data);
        echo '</pre>';
    }

    public static function getAdvertisedNameList($ticketId) {
        $list = array();

        $sql = "Select ss.id from tickets t join sms_services ss on ss.service_1300 = t.service_1300 where t.ticket_id=$ticketId ";
        $result = mysql_query($sql);
        $sms_services = mysql_fetch_assoc($result);

        if (isset($sms_services['id'])) {
            $sql1 = "Select id,advertised_name,short_code from sms_service_short_code where sms_service_id=" . $sms_services['id'];
            $result1 = mysql_query($sql1);
            while ($row1 = mysql_fetch_assoc($result1)) {
                $list[$row1['id']] = $row1['advertised_name'] . ' (<i>' . $row1['short_code'] . '</i>)';
            }
        }

        return $list;
    }

}
