<?php
include '../config.php';

// Check if the user is logged in

if(!isSet($_SESSION['username']))
{
header("Location: ../index.php");
exit;
}
?>
<!DOCTYPE html> 
<html>
<head>
<meta charset="utf-8">
<title>Application Web jQuery Mobile</title>
<link href="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.css" rel="stylesheet" type="text/css"/>
<script src="http://code.jquery.com/jquery-1.6.4.min.js" type="text/javascript"></script>
<script src="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js" type="text/javascript"></script>
</head> 
<body> 
<div data-role="header" data-theme="b">
<a title="Liste des utilisateurs" href="affichage.php" rel="external" data-icon="grid" data-iconpos="notext" data-direction="reverse" class="ui-btn-right-bis jqm-home ui-btn  ui-btn-icon-notext ui-btn-corner-all"><span class="ui-icon  ui-icon-grid"></span></a>

	<h1>Liste des utilisateurs</h1>
<a title="page d'accueil"  href="../private.php" rel="external" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-right-bis jqm-home ui-btn  ui-btn-icon-notext ui-btn-corner-all"><span class="ui-icon  ui-icon-home"></span></a>

</div>
<h4></h4> 
<?php
 if ($_POST['valider']) {
     // attempt a connection
 $base=$_SESSION['database'];
 $dbh = pg_connect("host=localhost dbname=$base user=openpg password=openpgpwd");
     if (!$dbh) {
         die("Error in connection: " . pg_last_error());
     }

     // execute query
     $sql = "SELECT * FROM product_template where name='".$_POST[name]."'";
	 
     $result = pg_query($dbh, $sql);
     if (!$result) {
         die("Error in SQL query: " . pg_last_error());
     }
    $total = pg_num_rows($result);
 if($total) {
    echo '<table data-role="table" id="movie-table" data-mode="reflow" class="ui-responsive table-stroke">'."\n";
            echo '<thead>';
            echo '<tr>';
            echo '<th data-priority="1">Id</th>';
			echo '<th data-priority="2">name</th>';
			echo '<th data-priority="1">type</th>';
			echo '<th data-priority="2">prix vent</th>';
			echo '<th data-priority="2">vente ok</th>';
			echo '<th data-priority="2">purchase ok</th>';
			echo '<th data-priority="2">company id</th>';
            echo '</tr>'."\n";
			echo '</thead>';
			echo '<tbody>';
  while ($row = pg_fetch_array($result)) {
	            echo '<tr>';
                 echo '<td bgcolor="#dddddd">'.$row["id"].'</td>';
				echo '<td bgcolor="#dddddd">'.$row["name"].'</td>';
				echo '<td bgcolor="#dddddd">'.$row["type"].'</td>';
                echo '<td bgcolor="#dddddd">'.$row["list_price"].'</td>';
				echo '<td bgcolor="#dddddd">'.$row["sale_ok"].'</td>';
				echo '<td bgcolor="#dddddd">'.$row["purchase_ok"].'</td>';
				echo '<td bgcolor="#dddddd">'.$row["company_id"].'</td>';
				echo '<td><a href="update.php?id='.$row["id"].' "><img src="../images/mod.jpg" width="25" height="25"></a></td>';
				echo '<td><a href="delete.php?id='.$row["id"].'&supp=ok "><img src="../images/sup.png" width="25" height="25"></a></td>';
				echo '<td><a href="detaille.php?id='.$row["id"].' "><img src="../images/list.jpg" width="25" height="25"></a></td>';
                echo '</tr>'."\n";}
				echo '</tbody>';
				echo '</table>'."\n";
            }
            
		else {
              echo "Une erreur s'est produite.\n";
            echo "Pas d\'enregistrements dans cette table...";
              exit;
        }

    
     // free memory
     pg_free_result($result);
    
     // close connection
     pg_close($dbh);
 }
 ?>       

  <form action="recherche.php" method="post">  
      <p>
     <!-- Name: <br> <input type="text" name="name">       
      <input type="submit" name="valider">-->
      <label for="search-basic">name:</label>
      <input type="search" name="name" id="search-basic" value="" />
      <input type="submit" name="valider" value="recherche">
      </form>

 <div data-role="header" data-theme="b">
<a title="Ajout" href="insert.php" rel="external" data-icon="plus" data-iconpos="notext" data-direction="reverse" class="ui-btn-right-bis jqm-home ui-btn  ui-btn-icon-notext ui-btn-corner-all"><span class="ui-icon  ui-icon-plus"></span></a>

	<h1>&copy; 2013</h1>
<a title="A propos d'application"  href="../autour.php" data-rel="dialog" data-transition="flip" data-icon="info" data-iconpos="notext" data-direction="reverse" class="ui-btn-right-bis jqm-home ui-btn  ui-btn-icon-notext ui-btn-corner-all"><span class="ui-icon  ui-icon-info"></span></a>

</div>  
</body>
</html>       