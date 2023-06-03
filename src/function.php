<?php
function viewtables($s, $e, $servername, $dbname, $charset, $username, $password, $table, $id){
//$s and $e are used for start and end by some special queries

try {
    
     $pdo = new PDO("mysql:host=$servername;dbname=$dbname;$charset", $username, $password);
    
     if($table == "vocabulary"){
    	$statement = $pdo->prepare("SELECT * FROM vocabulary WHERE ID BETWEEN :s AND :e");
    	$statement->execute(array('s' => $s, 'e' => $e));
        echo "<center><table border><tr><td>ID</td><td>language1</td><td>language2</td><td></td></tr>";
   	 while ($row = $statement->fetch()) {
       		 echo "<tr><td>".$row['ID']."</td><td>".$row['language1']."</td><td>".$row['language2']."</td><td><a href ='editvocabulary.php?id=".$row['ID']."'>edit</a></td></tr>";
   	 }
      echo "</table></center>";
    }
    elseif($table == "editvocabulary"){
    	$statement = $pdo->prepare("SELECT * FROM vocabulary WHERE ID = ".$id."");
    	$statement->execute();
    	
       while ($row = $statement->fetch() ) {
       		    echo "
        <p><b>edit:</b></p>
        <form method=\"post\" action=\"editvocabulary_submit.php\">
	    <input type=\"hidden\" name=\"id\" value=\"" .$id. "\"><br>
	    <span>language1: </span><input type=\"text\" name=\"language1\" value=\"".$row["language1"]."\"><br>
	    <span>language2: </span><input type=\"text\" name=\"language2\" value=\"".$row["language2"]."\"><br>	
	    <input type='submit' data-loading-text='save' value='  save  '>
	    </form> ";
    
      
        }
	
     
        }

   	
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
}

$pdo = null;
