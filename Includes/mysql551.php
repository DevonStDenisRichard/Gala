<?php

$DB2 = new MySQL1("localhost", "galadb", 'gala11', 'XnrAHsaZCJRbUZfM');

class MySQL1
{
	function MySQL1($db_host, $db_name, $db_username, $db_password)
	{
		$this->host		=	"mysql:host=" . $db_host . ";dbname=" . $db_name . ";charset=utf8";
		$this->username	=	$db_username;
		$this->password	=	$db_password;
	}
	
	function fetchData($queryString)
	{	
		$DB = new PDO($this->host, $this->username, $this->password);
		$stmt = $DB->query($queryString);
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		return $results;
	}
	
	//Returns results
	function InsertData($queryString)
	{	
		$DB = new PDO($this->host, $this->username, $this->password);

		$results = $DB->exec($queryString);
		$insertId = $DB->lastInsertId();

		return $results;
	}
	
	//Returns rowID
	function InsertData2($queryString)
	{	
		$DB = new PDO($this->host, $this->username, $this->password);

		$results = $DB->exec($queryString);
		$insertId = $DB->lastInsertId();

		return $insertId;
	}
	
	function execute($queryString)
	{	
		$DB = new PDO($this->host, $this->username, $this->password);

		$results = $DB->exec($queryString);

		return $results;
	}
}
?>