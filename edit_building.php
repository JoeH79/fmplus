<!DOCTYPE html>
<html>
<head>
    <title>FM Plus | Edit building</title>
    <link rel='stylesheet' type='text/css' href='styles.css' />
    <link href='http://fonts.googleapis.com/css?family=Numans' rel='stylesheet' type='text/css'>
</head>
<body>

<?php
    require_once 'functions_dbconnect.php';
    require_once 'functions_layout.php';

    db_connect();
    display_header();
    display_menu();

    $building_id = ($_POST['edit_value']);
    $query ="SELECT building_code, building_name FROM fmp_building where building_id = " . $building_id;
echo $query;
    $result = mysql_query($query);
    $row = mysql_fetch_array($result);
    $building_code = $row["building_code"];
    $building_name = $row["building_name"];

    echo <<<END
    <form method="post" action="display_buildings.php">
        <p><input type="text" name="building_code" value="$building_code"/></p>
        <p><input type="text" name="first_name" value="$building_name"/></p>
        <p><input type="submit" value="edit_building"/></p>
        <input type="hidden" name="building_id" value="$building_id"/>
    </form>

END;

    mysql_close();
?>
</body>
</html>