<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin Login</title>
</head>

<body>
<?php
	session_start();
	
	include('./Includes/mysql55.php');
	
	if(isset($_SESSION['Logged']))
	{	
		if($_POST['actions'] == 'Users')
		{
			if(isset($_POST['update']))
			{
				if($_POST['update'] == "update")
					$query = "UPDATE `users` SET `User` = '" . $_POST['User'] . "', `Pass` = '" . $_POST['Pass'] . "', `Level` = '" . $_POST['Level'] . "' WHERE `users`.`Index1` = " . $_POST['index'] . ";";	
				elseif($_POST['update'] == "AddUser")
					$query = "INSERT INTO `users` (`Index1`, `User`, `Pass`, `Level`) VALUES (NULL, '" . $_POST['User'] . "', '" . $_POST['Pass'] . "', '" . $_POST['level'] . "');";
				else
					$query = "DELETE FROM `users` WHERE `users`.`Index1` = " . $_POST['index'];

				$DB1->execute($query);
			}
			
			include('./Includes/UserEdit.php');
		}
		elseif($_POST['actions'] == 'News')
		{
			if(isset($_POST['update']))
			{
				if($_POST['update'] == "update")
				{
					if(!empty($_FILES["ImageLocation"]["name"]))
					{
						$target_dir = "./News/";
						$ext = pathinfo($_FILES["ImageLocation"]["name"], PATHINFO_EXTENSION);
						$target_file = $target_dir . time() . "." . $ext; 
						move_uploaded_file($_FILES["ImageLocation"]["tmp_name"], $target_file);
						$query = "UPDATE `news` SET `Title` = '" .  addslashes($_POST['Title']) . "', `Summary` = '" .  addslashes($_POST['Summary']) . "', `ImageLocation` = '" . $target_file . "' WHERE `news`.`Index1` = " . $_POST['index'] . ";";
					}
					else
						$query = "UPDATE `news` SET `Title` = '" .  addslashes($_POST['Title']) . "', `Summary` = '" .  addslashes($_POST['Summary']) . "' WHERE `news`.`Index1` = " . $_POST['index'] . ";";
					
				}
				elseif($_POST['update'] == "AddNews")
				{
					if(!empty($_FILES["ImageLocation"]["name"]))
					{
						$target_dir = "./News/";
						$ext = pathinfo($_FILES["ImageLocation"]["name"], PATHINFO_EXTENSION);
						$target_file = $target_dir . time() . "." . $ext;
						move_uploaded_file($_FILES["ImageLocation"]["tmp_name"], $target_file);
						
						$query = "INSERT INTO `news` (`Index1`, `Title`, `Summary`, `Date`, `ImageLocation`) VALUES (NULL, '" .  addslashes($_POST['Title']) . "', '" .  addslashes($_POST['Summary']) . "', CURRENT_TIMESTAMP, '" . $target_file . "');";
					}
					else
						$query = "INSERT INTO `news` (`Index1`, `Title`, `Summary`, `Date`) VALUES (NULL, '" .  addslashes($_POST['Title']) . "', '" .  addslashes($_POST['Summary']) . "', CURRENT_TIMESTAMP);";
				}
				else
				{
					$query = "SELECT `ImageLocation` FROM `news` WHERE `Index1` = " . $_POST['index'];
					$result = $DB1->fetchdata($query);
					
					if($result[0]['ImageLocation'] != NULL)
						unlink($result[0]['ImageLocation']);
					
					$query = "DELETE FROM `news` WHERE `news`.`Index1` = " . $_POST['index'];
				}

				$DB1->execute($query);
			}
			include('./Includes/NewsEdit.php');
		}
		elseif($_POST['actions'] == 'Minutes')
		{
			if(isset($_POST['update']))
			{
				if($_POST['update'] == "update")
				{
					$target_dir = "./Minutes/";
					$ext = pathinfo($_FILES["PhysicalLocation"]["name"], PATHINFO_EXTENSION);
					$target_file = $target_dir . time() . "." . $ext; 
					move_uploaded_file($_FILES["PhysicalLocation"]["tmp_name"], $target_file);
					
					$query = "UPDATE `minutes` SET `Title` = '" . $_POST['Title'] . "', `PhysicalLocation` = '" . $target_file . "' WHERE `minutes`.`Index1` = " . $_POST['index'] . ";";
				}
				elseif($_POST['update'] == "AddMinutes")
				{
					$target_dir = "./Minutes/";
					$ext = pathinfo($_FILES["PhysicalLocation"]["name"], PATHINFO_EXTENSION);
					$target_file = $target_dir . time() . "." . $ext;
					move_uploaded_file($_FILES["PhysicalLocation"]["tmp_name"], $target_file);
					
					$query = "INSERT INTO `minutes` (`Index1`, `Title`, `PhysicalLocation`) VALUES (NULL, '" . $_POST['Title'] . "', '" . $target_file . "');";
				}
				else
				{
					$query = "SELECT `PhysicalLocation` FROM `minutes` WHERE `Index1` = " . $_POST['index'];
					$result = $DB1->fetchdata($query);
					
					if($result[0]['PhysicalLocation'] != NULL)
						unlink($result[0]['PhysicalLocation']);
					
					$query = "DELETE FROM `minutes` WHERE `minutes`.`Index1` = " . $_POST['index'];
				}

				$DB1->execute($query);
			}
			include('./Includes/MinutesEdit.php');

		}
		elseif($_POST['actions'] == 'Menus')
		{
			if(isset($_POST['update']))
			{
				if($_POST['update'] == "update")
					$query = "UPDATE `staticmenu` SET `MenuName` = '" . $_POST['MenuName'] . "', `Content` = '" . addslashes($_POST['Content']) . "' WHERE `staticmenu`.`Index1` =  " . $_POST['index'] . ";";	
				elseif($_POST['update'] == "AddMenu")
					$query = "INSERT INTO `staticmenu` (`Index1`, `MenuName`, `Content`) VALUES (NULL, '" . $_POST['MenuName'] . "', '" . $_POST['Content'] . "');";
				else
					$query = "DELETE FROM `staticmenu` WHERE `staticmenu`.`Index1` = " . $_POST['index'];

				$DB1->execute($query);
			}
			include('./Includes/MenuEdit.php');
		}
		elseif($_POST['actions'] == 'Calendar')
		{
			if(isset($_POST['update']))
			{
				if($_POST['update'] == "update")
				{
					$checked = 0;
					
					if(isset($_POST['Meeting']) && $_POST['Meeting'] == 1)
						$checked = 1;
					
					$query = "UPDATE `calendar` SET `Date1` = '" . $_POST['Date1'] . "', `Time1` = '" . $_POST['Time1'] . "', `EventTitle` = '" . addslashes($_POST['EventTitle']) . "', `Summary` = '" . addslashes($_POST['Summary']) . "', `Meeting` = " . $checked . " WHERE `calendar`.`Index1` = " . $_POST['index'] . ";";	

				}
				elseif($_POST['update'] == "AddCal")
				{
					$checked = 0;
					
					if(isset($_POST['Enabled']) && $_POST['Enabled'] == 1)
						$checked = 1;
					
					$query = "INSERT INTO `calendar` (`Index1`, `Date1`, `Time1`, `EventTitle`, `Summary`, `Meeting`) VALUES (NULL, '" . $_POST['Date1'] . "', '" . $_POST['Time1'] . "', '" . addslashes($_POST['EventTitle']) . "', '" . addslashes($_POST['Summary']) . "', '" . $checked . "');";
				}
				else
					$query = "DELETE FROM `calendar` WHERE `calendar`.`Index1` = " . $_POST['index'];

				$DB1->execute($query);
			}
			include('./Includes/CalEdit.php');
		}
		elseif($_POST['actions'] == 'Adverts')
		{
			if(isset($_POST['update']))
			{
				if($_POST['update'] == "update")
				{
					$checked = 0;
					
					if(isset($_POST['Enabled']) && $_POST['Enabled'] == 1)
						$checked = 1;
					
					if(!empty($_FILES['ImageLocation']['name']))
					{
						$target_dir = "./Adverts/";
						$ext = pathinfo($_FILES["ImageLocation"]["name"], PATHINFO_EXTENSION);
						$target_file = $target_dir . time() . "." . $ext; //basename($_FILES["fileToUpload"]["name"]);
						move_uploaded_file($_FILES["ImageLocation"]["tmp_name"], $target_file);
						
						$query = "UPDATE `ads` SET `AdOwner` = '" . addslashes($_POST['AdOwner']) . "', `ImageLocation` = '" . $target_file . "', `Enabled` = b'" . $checked . "', `Website` = '" . $_POST['Website'] . "' WHERE `ads`.`Index1` = " . $_POST['index'] . ";";	
					}
					else
						$query = "UPDATE `ads` SET `AdOwner` = '" . addslashes($_POST['AdOwner']) . "', `Enabled` = b'" . $checked . "', `Website` = '" . $_POST['Website'] . "' WHERE `ads`.`Index1` = " . $_POST['index'] . ";";	

				}
				elseif($_POST['update'] == "AddAd")
				{
					$checked = 0;
					
					if(isset($_POST['Enabled']) && $_POST['Enabled'] == 1)
						$checked = 1;
					
					if(!empty($_FILES['ImageLocation']['name']))
					{
						$target_dir = "./Adverts/";
						$ext = pathinfo($_FILES["ImageLocation"]["name"], PATHINFO_EXTENSION);
						$target_file = $target_dir . time() . "." . $ext; //basename($_FILES["fileToUpload"]["name"]);
						move_uploaded_file($_FILES["ImageLocation"]["tmp_name"], $target_file);
						
						$query = "INSERT INTO `Ads` (`Index1`, `ImageLocation`, `AdOwner`, `Enabled`, `Website`) VALUES (NULL, '" . $target_file . "', '" . addslashes($_POST['AdOwner']) . "', b'" . $checked . "', '" . $_POST['Website'] . "');";
					}
					else
						$query = "INSERT INTO `Ads` (`Index1`, `AdOwner`, `Enabled`, `Website`) VALUES (NULL, '" . addslashes($_POST['AdOwner']) . "', b'" . $checked . "', '" . $_POST['Website'] . "');";
				}
				else
				{
					$query = "SELECT `ImageLocation` FROM `ads` WHERE `Index1` = " . $_POST['index'];
					$result = $DB1->fetchdata($query);
					
					if($result[0]['ImageLocation'] != NULL)
						unlink($result[0]['ImageLocation']);
					
					$query = "DELETE FROM `ads` WHERE `ads`.`Index1` = " . $_POST['index'];
				}

				$DB1->execute($query);
			}
			include('./Includes/AdEdit.php');
		}
		elseif($_POST['actions'] == 'Issues')
		{
			if(isset($_POST['update']))
			{
				if($_POST['update'] == "update")
				{
					if(!empty($_FILES['PhysicalLocation']['name']))
					{
						$target_dir = "./Issues/";
						$ext = pathinfo($_FILES["PhysicalLocation"]["name"], PATHINFO_EXTENSION);
						$target_file = $target_dir . time() . "." . $ext;
						move_uploaded_file($_FILES["PhysicalLocation"]["tmp_name"], $target_file);

						$query = "UPDATE `articles` SET `Volume` = '" . $_POST['Volume'] . "', `Issue` = '" . $_POST['Issue'] . "', `PhysicalLocation` = '" . $target_file . "', `Title` = '" . addslashes($_POST['Title']) . "', `Article` = '" . addslashes($_POST['Article']) . "' WHERE `articles`.`Index1` = " . $_POST['index'] . ";";	
					}
					else
						$query = "UPDATE `articles` SET `Volume` = '" . $_POST['Volume'] . "', `Issue` = '" . $_POST['Issue'] . "', `Title` = '" . $_POST['Title'] . "', `Article` = '" . addslashes($_POST['Article']) . "' WHERE `articles`.`Index1` = " . addslashes($_POST['index']) . ";";	
				}
				elseif($_POST['update'] == "AddArticle")
				{
					if(!empty($_FILES['PhysicalLocation']['name']))
					{
						$target_dir = "./Issues/";
						$ext = pathinfo($_FILES["PhysicalLocation"]["name"], PATHINFO_EXTENSION);
						$target_file = $target_dir . time() . "." . $ext; 
						move_uploaded_file($_FILES["PhysicalLocation"]["tmp_name"], $target_file);
						
						$query = "INSERT INTO `articles` (`Index1`, `Volume`, `Issue`, `PhysicalLocation`, `Title`, `Article`, `Date1`) VALUES (NULL, '" . $_POST['Volume'] . "', '" . $_POST['Issue'] . "', '" . $target_file . "', '" . addslashes($_POST['Title']) . "', '" . addslashes($_POST['Article']) . "', 'CURRENT_TIMESTAMP');";
					}
					else
						$query = "INSERT INTO `articles` (`Index1`, `Volume`, `Issue`, `Title`, `Article`, `Date1`) VALUES (NULL, '" . $_POST['Volume'] . "', '" . $_POST['Issue'] . "', '" . addslashes($_POST['Title']) . "', '" . addslashes($_POST['Article']) . "', 'CURRENT_TIMESTAMP');";
				}
				else
				{
					$query = "SELECT `PhysicalLocation` FROM `articles` WHERE `Index1` = " . $_POST['index'];
					$result = $DB1->fetchdata($query);
					
					if($result[0]['PhysicalLocation'] != NULL)
						unlink($result[0]['PhysicalLocation']);
					
					$query = "DELETE FROM `articles` WHERE `articles`.`Index1` = " . $_POST['index'];
				}

				$DB1->execute($query);
			}
			include('./Includes/IssueEdit.php');
		}
		else
			include('./Includes/MainAdmin.php');
	}
	elseif(isset($_POST['User']) && isset($_POST['Password']))
	{
		$query="SELECT * FROM `users` WHERE `User` LIKE '" . $_POST['User'] . "' AND `Pass` LIKE '" . $_POST['Password'] . "'";
		$result = $DB1->fetchdata($query);
		
		if($result[0]['User'] == NULL)
			include("./Includes/Login.php");
		else
		{
			$_SESSION['Logged'] = 1;
			$_SESSION['UserLevel'] = $result[0]['Level'];
			include('./Includes/MainAdmin.php');
		}
	}
	elseif(!isset($_SESSION['Logged']))
	{
		include("./Includes/Login.php");
	}
	
?>
</body>
</html>
