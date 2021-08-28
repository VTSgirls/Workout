<?php
//establish connection
try
{
    //$conn = new PDO("mysql:'$DB_NAME';host='$DB_HOST'","'$DB_USER'","'$DB_PASS'");
    $conn = new PDO("mysql:dbname=vtsgirls;host=localhost", 'vtsgirls', 'bq5z#6Q@tjd9');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

}
catch (PDOException $e)
{
    exit("Not connected! ");
}
?>


