<!DOCTYPE html>
<html>
<head>
    <title>FM Plus - Edit Person</title>
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

    $person_id = ($_POST['edit_value']);
    $query ="SELECT person_code, first_name, last_name FROM fmp_person where person_id = " . $person_id;
    $result = mysql_query($query);
    $row = mysql_fetch_array($result);
    $person_code = $row["person_code"];
    $first_name = $row["first_name"];
    $last_name = $row["last_name"];

    echo <<<END
    <form method="post" action="display_people.php">
        <p><input type="text" name="person_code" value="$person_code"/></p>
        <p><input type="text" name="first_name" value="$first_name"/></p>
        <p><input type="text" name="last_name" value="$last_name"/></p>
        <p><input type="submit" value="edit_person"/></p>
        <input type="hidden" name="person_id" value="$person_id"/>
    </form>

END;

    mysql_close();
?>
</body>
</html>