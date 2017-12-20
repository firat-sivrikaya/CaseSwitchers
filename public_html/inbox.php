<?php

	include("session.php");

?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M:\Bilkent\CS353\Project\Frontend\MessageInbox</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button><a class="navbar-brand navbar-link" href="index.php">CaseSwitchers </a></div>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav">
                    <li role="presentation"><a href="index.php">Home </a></li>
                    <li role="presentation"><a href="posts.php">Posts </a></li>
                    <li role="presentation"><a href="categories.php">Categories </a></li>
                    <li role="presentation"><a href="users.php">Users </a></li>
                    <li role="presentation"></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php
                        if(isset($_SESSION['admin']))
                        {
                            echo '<li role="presentation"><a href="adminpanel.php">Admin Panel </a></li>';
                        }
                        if(isset($_SESSION['login_user']))
                        {
                            echo '<li role="presentation"><a href="profile.php?id='.$login_id.'">Profile </a></li>';
                            echo '<li role="presentation"><a href="logout.php">Logout </a></li>';
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Inbox </h1></div>
        </div>
        <div class="row">
            <div class="col-sm-3 col-sm-offset-9">
                <div class="row">
                <form method="post" action="">
                    <div class="col-sm-8 col-sm-pull-1">
                        <input type="search" name="Search" placeholder="Search">
                    </div>
                    <div class="col-sm-4">
                        <button class="btn btn-default btn-sm" type="submit">Search </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container">	    
	        <div class="row">
	            <div class="col-md-12">
	                <div class="table-responsive">
	                    <table class="table table-striped">
	                        <thead>
	                            <tr>
	                                <th>Message Content</th>
	                                <th>User </th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        <?php 

								if(isset($_POST['Search'])){

										$pattern = $_POST['Search'];
										$query = "SELECT * FROM Messages WHERE (receiver_id = '$login_id' OR sender_id = '$login_id') AND content LIKE '%$pattern%' ORDER BY timestamp DESC";
								        $result = $db->query($query);

								        if(strlen($pattern) != 0){
				   							if ($result->num_rows > 0) {

											    while($row = $result->fetch_assoc()){

											    	if($row["sender_id"] == $login_id)
											        	$userid = $row["receiver_id"];
											        else
											        	$userid = $row["sender_id"];

						                        	$query2 = "SELECT username FROM User WHERE userID = '$userid'";
						   							$result2 = $db->query($query2);
						   							$row2 = $result2->fetch_assoc();

											    	if(strlen($row["content"])>30){
											    		$substrMsg = substr($row["content"],0,30);
											        	echo '<td><a href="readmessage.php?id='.$userid.'">'.$substrMsg.'...</td>'; 
											    	}
											    	
											        else
											        	echo '<td><a href="readmessage.php?id='.$userid.'">'.$row["content"].'</td>';

											        echo '<td>'.$row2["username"].'</td>';
											        echo '</tr>';

											    }
											} 		
									}

									else
										header("location: inbox.php");
								}

								else{

									$query = "SELECT sub.* FROM (SELECT *
											FROM Messages as m1
											WHERE m1.timestamp IN (SELECT MAX(timestamp)
						                    FROM Messages as m2
						                    WHERE (m1.sender_id = m2.sender_id and m1.receiver_id = m2.receiver_id) or 
						                           (m1.sender_id = m2.receiver_id and m1.receiver_id = m2.sender_id)    
              							      ))sub WHERE sender_id = '$login_id' or receiver_id = '$login_id' ORDER BY timestamp DESC";
	   								$result = $db->query($query);

		   							if ($result->num_rows > 0) {

									    while($row = $result->fetch_assoc()){

									    	if($row["sender_id"] == $login_id)
									        	$userid = $row["receiver_id"];
									        else
									        	$userid = $row["sender_id"];

				                        	$query2 = "SELECT username FROM User WHERE userID = '$userid'";
				   							$result2 = $db->query($query2);
				   							$row2 = $result2->fetch_assoc();

									    	if(strlen($row["content"])>30){
									    		$substrMsg = substr($row["content"],0,30);
									        	echo '<td><a href="readmessage.php?id='.$userid.'">'.$substrMsg.'...</a></td>'; 
									    	}
									    	
									        else
									        	echo '<td><a href="readmessage.php?id='.$userid.'">'.$row["content"].'</td>';

									        echo '<td>'.$row2["username"].'</td>';
									        echo '</tr>';

									    }
									} 								
								}

	                            ?>
	                            <tr></tr>
	                        </tbody>
	                    </table>
	                </div>
	            </div>
	        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>