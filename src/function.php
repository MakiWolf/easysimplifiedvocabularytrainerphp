<?php

function viewtablevocabulary($s, $e, $connstring)
{
	//$s and $e are used for start and end by some special queries

	try {

		$pdo = new PDO($connstring, $_SESSION["usern"], $_SESSION["passwd"]);

		$statement = $pdo->prepare("SELECT * FROM vocabulary WHERE vocabularyID BETWEEN :s AND :e");
		$statement->execute(array('s' => $s, 'e' => $e));
		echo "<center><table border><tr><td>ID</td><td>language1</td><td>language2</td><td></td></tr>";
		while ($row = $statement->fetch()) {
			echo "<tr><td>" . $row['vocabularyID'] . "</td><td>" . htmlspecialchars($row['language1']) . "</td><td>" . htmlspecialchars($row['language2']) . "</td><td><a href ='editvocabulary.php?id=" . $row['vocabularyID'] . "'>edit</a></td></tr>";
		}
		echo "</table></center>";
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	$pdo = null;
}




function editvocabulary($connstring, $id)
{

	try {

		$pdo = new PDO($connstring, $_SESSION["usern"], $_SESSION["passwd"]);


		$statement = $pdo->prepare("SELECT * FROM vocabulary WHERE vocabularyID = " . $id . "");
		$statement->execute();

		while ($row = $statement->fetch()) {
			echo "
			<p><b>edit:</b></p>
			<form method=\"post\" action=\"editvocabulary_submit.php\">
			<input type=\"hidden\" name=\"vocabularyid\" value=\"" . $id . "\"><br>
			<span>language1: </span><input type=\"text\" name=\"language1\" value=\"" . $row["language1"] . "\"><br>
			<span>language2: </span><input type=\"text\" name=\"language2\" value=\"" . $row["language2"] . "\"><br>	
			<input type='submit' data-loading-text='save' value='  save  '>
			</form> ";
		}
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	$pdo = null;
}


function userid($connstring, $username)
{

	try {
		$pdo = new PDO($connstring, $_SESSION["usern"], $_SESSION["passwd"]);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT user.userID FROM user WHERE username = '" . $username . "'";
		foreach ($pdo->query($sql) as $row) {
			$_SESSION["userid"] = $row['userID'];
		}
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	$pdo = null;
}

function editvocabularysave($connstring, $id, $language1, $language2)
{
	try {
		$pdo = new PDO($connstring, $_SESSION["usern"], $_SESSION["passwd"]);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE vocabulary SET language1='" . $language1 . "', language2='" . $language2 . "' WHERE vocabularyID=" . $id . "";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		echo $stmt->rowCount() . " vocabulary UPDATED successfully";
	} catch (PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
}
