<?php
class VisitCounter {
    /**
     * Count a visit on a certain page.
     *
     * @param $page string name which will be store in the database
     */
    public static function countVisit($page) {
        require 'ip-anonymizer.php';
        require 'config.php';

        $anonymized_user_ip = IpAnonymizer::anonymizeIp($_SERVER['REMOTE_ADDR']);

        $stored_user_ips = mysqli_query($link, "SELECT * FROM userVisits WHERE page = '$page' AND userIp = '$anonymized_user_ip' AND date = CURDATE()");

        if (mysqli_num_rows($stored_user_ips) == 0) {
            mysqli_query($link, "INSERT INTO userVisits VALUES('NULL', '$page', CURDATE(), '$anonymized_user_ip')");

            $stored_visits = mysqli_query($link, "SELECT * FROM totalVisits WHERE page = '$page' AND date = CURDATE()");

            if (mysqli_num_rows($stored_visits) == 0) {
                mysqli_query($link, "INSERT INTO totalVisits VALUES('NULL', '$page', CURDATE(), 1)");
            } else {
                mysqli_query($link, "UPDATE totalVisits SET visits = visits + 1 WHERE page = '$page' AND date = CURDATE()");
            }
        }

        mysqli_close($link);
    }
}
?>