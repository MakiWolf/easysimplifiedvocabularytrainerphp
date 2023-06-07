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

		$statement = $pdo->prepare("SELECT user.userID FROM user WHERE username = '" . $username . "'");
		$statement->execute();
		while ($row = $statement->fetch()) {
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
	$pdo = null;
}

function newvocabulary($connstring, $language1, $language2)
{

	try {
		$pdo = new PDO($connstring, $_SESSION["usern"], $_SESSION["passwd"]);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if (empty(!$language2) && empty(!$language1)) {
			$statement = $pdo->prepare("INSERT INTO vocabulary (language1, language2) VALUES (?, ?)");
			$statement->execute(array($language1, $language2));
			echo "New vocabulary created successfully";
		} else {
			echo "not filled out";
		}
	} catch (PDOException $e) {
		echo "<br>" . $e->getMessage();
	}
	$pdo = null;
}

function studyprogress($connstring, $s, $e)
{

	try {
		echo "<center><table border><tr><td>VokabelID</td><td>language1</td><td>language2</td><td>mistake</td></tr>";
		$pdo = new PDO($connstring, $_SESSION["usern"], $_SESSION["passwd"]);
		$statement = $pdo->prepare("SELECT vocabulary.vocabularyID, vocabulary.language1, vocabulary.language2, mistake" . $_SESSION["userid"] . ".mistake FROM vocabulary INNER JOIN mistake" . $_SESSION["userid"] . " ON vocabulary.vocabularyID = mistake" . $_SESSION["userid"] . ".vocabularyID WHERE mistake" . $_SESSION["userid"] . ".userid = '" . $_SESSION["userid"] . "' AND mistake > 0 AND vocabulary.vocabularyID BETWEEN :s AND :e ORDER BY mistake DESC");
		$statement->execute(array('s' => $s, 'e' => $e));
		while ($row = $statement->fetch()) {
			echo "<tr><td>" . $row['vocabularyID'] . "</td><td>" . $row['language1'] . "</td><td>" . $row['language2'] . "</td><td>" . $row['mistake'] . "</td></tr>";
		}
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	$pdo = null;
}

function update($connstring, $mistake, $vocabularyID, $userid)
{
	try {
		$pdo = new PDO($connstring, $_SESSION["usern"], $_SESSION["passwd"]);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE mistake" . $_SESSION["userid"] . " SET mistake=" . $mistake . " WHERE vocabularyID=" . $vocabularyID . " AND userid=" . $userid . "";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$z = $stmt->rowCount();
		//echo "update $z";
		if ($z == 0 && $mistake > 0) {
			$statement = $pdo->prepare("INSERT INTO mistake" . $_SESSION["userid"] . " (vocabularyID, userid, mistake) VALUES (?, ?, ?)");
			$statement->execute(array($vocabularyID, $userid, $mistake));
		}
	} catch (PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
		$z = 0;
	}
	$pdo = null;
	return $z;
}

function getvocabulary($connstring, $vocabularyID)
{

	try {
		$pdo = new PDO($connstring, $_SESSION["usern"], $_SESSION["passwd"]);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$statement = $pdo->prepare("SELECT * FROM vocabulary WHERE vocabularyID = '" . $vocabularyID . "'");
		$statement->execute();
		while ($row = $statement->fetch()) {
			$_SESSION["vocabularyID"] = $row['vocabularyID'];
			$_SESSION["language1"] = $row['language1'];
			$_SESSION["language2"] = $row['language2'];
			$_SESSION["mistake"] = null;
			
		}
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
		
		
	}
	$pdo = null;
	
}

function getvocabularyf1($connstring, $vocabularyID, $userid)
{

	try {
		$pdo = new PDO($connstring, $_SESSION["usern"], $_SESSION["passwd"]);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$statement = $pdo->prepare("SELECT * FROM vocabulary INNER JOIN mistake" . $_SESSION["userid"] . " ON vocabulary.vocabularyID = mistake" . $_SESSION["userid"] . ".vocabularyID WHERE vocabulary.vocabularyID = '" . $vocabularyID . "' AND mistake" . $_SESSION["userid"] . ".userid = '" . $userid . "' AND mistake > 0");
		$statement->execute();
		while ($row = $statement->fetch()) {
			$_SESSION["vocabularyID"] = $row['vocabularyID'];
			$_SESSION["language1"] = $row['language1'];
			$_SESSION["language2"] = $row['language2'];
			$_SESSION["mistake"] = null;
		}
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
		
	}
	$pdo = null;
	
}

function getmistake($connstring, $vocabularyID, $userid)
{

	try {
		$pdo = new PDO($connstring, $_SESSION["usern"], $_SESSION["passwd"]);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$statement = $pdo->prepare("SELECT * FROM mistake" . $_SESSION["userid"] . " WHERE vocabularyID = '" . $vocabularyID . "' AND userid = '" . $userid . "'");
		$statement->execute();
		while ($row = $statement->fetch()) {
			$_SESSION["mistake"] = $row['mistake'];
			
		}
		
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
		
	}
	$pdo = null;
	
}
