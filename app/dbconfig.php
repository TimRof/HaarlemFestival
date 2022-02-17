<?php
if (getenv('DATABASE_URL') != "") {
    $dbopts = parse_url(getenv('DATABASE_URL'));
    $type = "pgsql";
    $servername = $dbopts["host"];
    $username = $dbopts["user"];
    $password = $dbopts["pass"];
    $database = ltrim($dbopts["path"], '/');
} else {
    $type = "mysql";
    $servername = "mysql";
    $username = "root";
    $password = "secret123";
    $database = "haarlemfestival";
}
