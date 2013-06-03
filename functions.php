<?php

function select_query ($columns, $table) //May not be necessary
{
	$query_text = "select ";
	for ($i = 0; $i < count($columns)-1; $i++) {
		$query_text = $query_text . $columns[$i]. ", ";		
	}
	$query_text = $query_text . $columns[$i] . " from " . $table;
	return $query_text;
}

function display_table ($col_name_array, $query, $edit, $del, $edit_target, $del_target)
{

	$result = mysql_query($query);
    //INSERT CODE - check that array and result are same length
	echo "<table>";
	display_table_head($col_name_array, $edit, $del);
	display_table_body($result,$edit, $del, $edit_target, $del_target);
	echo "</table>";
}

function display_table_head ($array, $edit, $del)
{
	
	echo "<thead>";
	echo "<tr>";
		for ($i = 0; $i < count($array); $i++)
		{
			echo "<th>" . "{$array[$i]}" . "</th>";
		}
	echo "</tr>";
	echo "</thead>";
}

function display_table_body ($result, $edit, $del, $edit_target, $del_target)
{
	$rows = mysql_num_rows($result);
	
	echo "<tbody>";

	for ($i = 0; $i < $rows; $i++)
	{
		$row = mysql_fetch_row($result);
		$width  = mysql_num_fields($result);
		echo "<tr class=\"table-row\">";
		for ($j = 1; $j < $width; $j++)
		{
			echo "<td class=\"table-data-element\">" . $row[$j] . "</td>";
		}
        if ($edit === 1 )
        {
            echo '<td class="table-data-element"><form method="POST" action='.$edit_target.'><input type="submit" name ="edit" value="Edit"/><input type="hidden" name="edit_value" value="'.$row[0].'"/></form></td>';
        }
        if ($del === 1 )
        {
            echo '<td class="table-data-element"><form method="POST" action='.$del_target.'><input type="submit" name ="delete" value="Del"/><input type="hidden" value="'.$row[0].'"/></form></td>';
        }
		echo "</tr>";
	}		
	echo "</tbody>";
}

function get_post ($var)
{
	return mysql_real_escape_string($_POST[$var]);
}
?>
