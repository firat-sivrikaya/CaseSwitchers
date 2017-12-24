<!DOCTYPE html>
<html>
<?php
    include("session.php");
	date_default_timezone_set('Europe/Istanbul');
    $time = time();
    $atime = date('Y-m-d H:i:s',$time);
    $postid = mysqli_real_escape_string($db,$_GET['id']);
     
    if(isset($_POST["upvotepost"]))
    {
        $entryid = $_POST["upvotepostid"];
        $query = "SELECT * FROM Rates WHERE e_id = $entryid AND u_id = $login_id";
        $result = $db->query($query);

        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        if($count == 0)
        {
            $query = "INSERT INTO Rates VALUES ($entryid, $login_id, 1)";
            $data = mysqli_query($db,$query);
            
            if($data)
            {
                echo '<div class="alert alert-success" role="alert">You upvoted the entry with ID '.$entryid.'.</div>';
            }
        }
        else
        {
            $query = "SELECT * FROM Rates WHERE e_id = $entryid AND u_id = $login_id AND rating = 1";
            $result = $db->query($query);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $count2 = mysqli_num_rows($result);
            if($count2 == 1)
            {
                $query = "DELETE FROM Rates WHERE e_id = $entryid AND u_id = $login_id";
                $data = mysqli_query($db,$query);
                if($data)
                {
                    echo '<div class="alert alert-warning" role="alert">You reverted your upvote for the entry with ID '.$entryid.'.</div>';
                }
                else
                {
                    echo '<div class="alert alert-danger" role="alert">Could not revert the upvote for the entry with ID '.$entryid.'.</div>';
                }
                
            }
            else
            {
                echo '<div class="alert alert-danger" role="alert">You have already downvoted the entry.</div>';
            }   
        }
    }
    
    if(isset($_POST["downvotepost"]))
    {
        $entryid = $_POST["downvotepostid"];
        $query = "SELECT * FROM Rates WHERE e_id = $entryid AND u_id = $login_id";
        $result = $db->query($query);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        if($count == 0)
        {
            $query = "INSERT INTO Rates VALUES ($entryid, $login_id, -1)";
            $data = mysqli_query($db,$query);
            
            if($data)
            {
                echo '<div class="alert alert-success" role="alert">You downvoted the entry with ID '.$entryid.'.</div>';
            }
        }
        else
        {
            $query = "SELECT * FROM Rates WHERE e_id = $entryid AND u_id = $login_id AND rating = -1";
            $result = $db->query($query);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $count2 = mysqli_num_rows($result);
            if($count2 == 1)
            {
                $query = "DELETE FROM Rates WHERE e_id = $entryid AND u_id = $login_id";
                $data = mysqli_query($db,$query);
                if($data)
                {
                    echo '<div class="alert alert-warning" role="alert">You reverted your downvote for the entry with ID '.$entryid.'.</div>';
                }
                else
                {
                    echo '<div class="alert alert-danger" role="alert">Could not revert the downvote for the entry with ID '.$entryid.'.</div>';
                }
                
            }
            else
            {
                echo '<div class="alert alert-danger" role="alert">You have already upvoted the entry.</div>';
            }   
        }
    }
    if(isset($_POST["favoritepost"]))
    {
        $favoritepostid = $_POST["favoritepostid"];
        
        $query = "SELECT * FROM Favorites WHERE e_id = $favoritepostid AND u_id = $login_id";
        $result = $db->query($query);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        if($count == 1)
        {
            echo '<div class="alert alert-danger" role="alert">You have already favorited this entry.</div>';
        }
        else
        {
            $query = "INSERT INTO Favorites VALUES('$favoritepostid', '$login_id')";
            $data = mysqli_query($db, $query);
            if($data)
            {
                echo '<div class="alert alert-success" role="alert">You have added post with ID'.$favoritepostid.' to your favorites.</div>';
            }
            else
            {
                echo '<div class="alert alert-danger" role="alert">Post with ID'.$favoritepostid.' could not be added to your favorites.</div>';
            }            
        }

    }

 	if(isset($_POST["submitcomment"])){

        $commenttext = mysqli_real_escape_string($db, $_POST['commenttext']);
        $commentid = mysqli_real_escape_string($db, $_POST['submitcomment']);

        $query = "INSERT INTO Entry (creationdate, content) VALUES ('$atime','$commenttext')";
        $data = mysqli_query ($db,$query)or die(mysqli_error($db));

        $query = "SELECT entryID FROM Entry WHERE creationdate = '$atime' AND content = '$commenttext'"; 
        $result = $db->query($query);

        while($row = $result->fetch_assoc()){
            $entryID = $row["entryID"]; 
        }

        $query = "INSERT INTO Owns VALUES ($entryID, $login_id)";
        $data = mysqli_query ($db,$query)or die(mysqli_error($db));

        $query = "SELECT * FROM Postcomments, Subcomments WHERE c_id = $commentid || subcomment_id = $commentid"; 
        $result = $db->query($query);

        if ($result->num_rows > 0){

	        $query = "INSERT INTO Comment VALUES ($entryID)";
	        $data = mysqli_query ($db,$query)or die(mysqli_error($db));

	        $query = "INSERT INTO Subcomments VALUES ($commentid, $entryID)";
	        $data = mysqli_query ($db,$query)or die(mysqli_error($db));
        } 

        else{

	        $query = "INSERT INTO Comment VALUES ($entryID)";
	        $data = mysqli_query ($db,$query)or die(mysqli_error($db));

	        $query = "INSERT INTO Postcomments VALUES ($postid, $entryID)";
	        $data = mysqli_query ($db,$query)or die(mysqli_error($db));
        }

    }
    

?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M:\Bilkent\CS353\Project\Frontend\individualpost</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
    <script>
        function changeComment(entryid)
        {
            var submitComment = document.getElementsByName("submitcomment")[0];
            submitComment.setAttribute("value", entryid);
            document.getElementsByName("submitcommentcontainer")[0].style.display = "block";
        }
    </script>
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
                <h4>
                <?php
                    $query = "SELECT * FROM Post WHERE PostID = $postid";
                    $result = $db->query($query);
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $posttitle = $row["topicname"];
                    echo $posttitle;
                ?></h4></div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <p class="lead">
                <?php
                    $query = "SELECT * FROM Entry WHERE EntryID = $postid";
                    $result = $db->query($query);
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $entrycontent = $row["content"];
                    echo $entrycontent;
                ?></p>
            </div>
            <div class="col-md-3">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-info"><span>User: 
                    <?php
                        $query = "SELECT * FROM User u, Owns o WHERE o.e_id = '$postid' AND u.userID = o.u_id";
                        $result = $db->query($query);
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $postownername = $row["username"];
                        echo $postownername;
                    ?></span></li>
                    <li class="list-group-item list-group-item-info"><span>Rating: 
                    <?php
                        $query6 = "SELECT e_id, sum(rating) as entryrating FROM Rates WHERE e_id = '$postid' GROUP BY e_id";
                        $result6 = $db->query($query6);
                        $row6 = $result6->fetch_assoc();
                        $entryrating = $row6["entryrating"];
                        echo $entryrating;
                    ?></span></li>
                    <li class="list-group-item list-group-item-info"><span>Subcategory: 
                    <?php
                        $query7 = "SELECT subcategoryname FROM Subcategory s, PostCategory p WHERE p.p_id = $postid AND p.c_id = s.c_id";
                        $result7 = $db->query($query7);
                        $row7 = $result7->fetch_assoc();
                        $subcategoryname = $row7["subcategoryname"];
                        echo $subcategoryname;
                    ?></span></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="">
                <button class="btn btn-success active" type="button" name="replypost" onmousedown="changeComment(<?php echo $postid;?>)">Reply </button>
                <input value="<?php echo $postid;?>" type="hidden" name="replypostid">
                <button class="btn btn-primary active" type="submit" name="upvotepost">Upvote </button>
                <input value="<?php echo $postid;?>" type="hidden" name="upvotepostid">
                <button class="btn btn-danger active" type="submit" name="downvotepost">Downvote </button>
                <input value="<?php echo $postid;?>" type="hidden" name="downvotepostid">
                <button class="btn btn-info active" type="submit" name="favoritepost">Add to Favorites</button>
                <input value="<?php echo $postid;?>" type="hidden" name="favoritepostid">
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4><em>Comments </em></h4></div>
        </div>
        <?php

       		function displaySub($commentID, $db, $depth, $offset){

	            $query = "SELECT * FROM Subcomments WHERE comment_id = $commentID"; 
	       		$result = $db->query($query);

	       		if($result->num_rows == 0){
	       			return;
	       		}

	       		else{
                    
	       				$depth = $depth-1;
	       				$offset = $offset+1;

		       			while($row = $result->fetch_assoc()){


		       				$subno = $row["subcomment_id"];
		       				$query2 = "SELECT * FROM Entry e, User u, Owns o WHERE e.entryID = $subno AND o.e_id = e.entryID AND u.userID = o.u_id";
		       				$result2 = $db->query($query2);

		       				while($row2 = $result2->fetch_assoc()){    

		       					$subcontent = $row2["content"];
		       					$subowner = $row2["username"];

		       				}
                            
                            $query3 = "SELECT e_id, sum(rating) as commentrating FROM Comment, Rates WHERE commentID = $subno AND e_id = commentID GROUP BY e_id";
                            $result3 = $db->query($query3);
                            $row3 = $result3->fetch_assoc();
                            $commentrating = $row3["commentrating"];

			            	echo '<div class="row" id="'.$subno.'">
			            		<div class="col-md-'.$depth.' col-md-offset-'.$offset.' col-xs-'.$depth.' col-xs-offset-'.$offset.'">
			              			<blockquote>
				                    	<p>'.$subcontent.'</p>
				                    	<footer>'.$subowner.' | Rating: '.$commentrating.'</footer>
					                </blockquote>
					                <form method="post" action="">
					                <button class="btn btn-success active" type="button" name="replypost" onmousedown="changeComment('.$subno.')">Reply </button>
					                <input value="'.$subno.'" type="hidden" name="replypostid">
					                <button class="btn btn-primary active" type="submit" name="upvotepost">Upvote </button>
					                <input value="'.$subno.'" type="hidden" name="upvotepostid">
					                <button class="btn btn-danger active" type="submit" name="downvotepost">Downvote </button>
					                <input value="'.$subno.'" type="hidden" name="downvotepostid">
					                <button class="btn btn-info active" type="submit" name="favoritepost">Add to Favorites</button>
					                <input value="'.$subno.'" type="hidden" name="favoritepostid">
					                </form>
			            		</div>
			        		</div>';

			        		displaySub($subno,$db,$depth,$offset);
	       				}	       			
	       			}
	       		}

            $query = "SELECT p.c_id, e.* FROM Entry e, Postcomments p WHERE (p.p_id = '$postid' AND e.entryID = p.c_id) ORDER BY creationdate ASC"; 
       		$result = $db->query($query);
       		
      		while($row = $result->fetch_assoc()){

	            $query2 = "SELECT * FROM User u, Owns o WHERE o.e_id = '$row[entryID]' AND u.userID = o.u_id"; 
	       		$result2 = $db->query($query2);  
	       		while($row2 = $result2->fetch_assoc()){          	
	       			$commentowner = $row2["username"];
	       			$commentno = $row2["e_id"];
	       		}
                $query3 = "SELECT e_id, sum(rating) as commentrating FROM Comment, Rates WHERE commentID = $commentno AND e_id = commentID GROUP BY e_id";
                $result3 = $db->query($query3);
                $row3 = $result3->fetch_assoc();
                $commentrating = $row3["commentrating"];

	       		$depth = 12;
	       		$offset = 1;
            	echo '<div class="row">
            		<div class="col-md-'.$depth.' col-md-offset-'.$offset.' col-xs-'.$depth.' col-xs-offset-'.$offset.'">
              			<blockquote>
	                    	<p>'.$row["content"].'</p>
	                    	<footer>'.$commentowner.' | Rating: '.$commentrating.'</footer>
		                </blockquote>
		                <form method="post" action="">
		                <button class="btn btn-success active" type="button" name="replypost" onmousedown="changeComment('.$commentno.')">Reply </button>
		                <input value="'.$commentno.'" type="hidden" name="replypostid">
		                <button class="btn btn-primary active" type="submit" name="upvotepost">Upvote </button>
		                <input value="'.$commentno.'" type="hidden" name="upvotepostid">
		                <button class="btn btn-danger active" type="submit" name="downvotepost">Downvote </button>
		                <input value="'.$commentno.'" type="hidden" name="downvotepostid">
		                <button class="btn btn-info active" type="submit" name="favoritepost">Add to Favorites</button>
		                <input value="'.$commentno.'" type="hidden" name="favoritepostid">
		                </form>
            		</div>
        		</div>';

        		displaySub($commentno,$db,$depth,$offset);
			}
		    
        ?>

        <!--<div class="row">
            <div class="col-md-11 col-md-offset-1 col-xs-11 col-xs-offset-1">
                <blockquote>
                    <p>Do you really think that a virtual currency will bring the end of a solid economical system?</p>
                    <footer>adamsmith | Rating: 4</footer>
                </blockquote>
                <button class="btn btn-success active" type="button">Reply </button>
                <button class="btn btn-primary active" type="button">Upvote </button>
                <button class="btn btn-danger active" type="button">Downvote </button>
                <button class="btn btn-info active" type="button">Add to Favorites</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-2 col-xs-10 col-xs-offset-2">
                <blockquote>
                    <p>I believe, by heart.</p>
                    <footer>george44 | Rating: 11</footer>
                </blockquote>
                <button class="btn btn-success active" type="button">Reply </button>
                <button class="btn btn-primary active" type="button">Upvote </button>
                <button class="btn btn-danger active" type="button">Downvote </button>
                <button class="btn btn-info active" type="button">Add to Favorites</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <blockquote>
                    <p>A Big Bubble</p>
                    <footer>jonas_cs | Rating: 8</footer>
                </blockquote>
                <button class="btn btn-success active" type="button">Reply</button>
                <button class="btn btn-primary active" type="button">Upvote </button>
                <button class="btn btn-danger active" type="button">Downvote </button>
                <button class="btn btn-info active" type="button">Add to Favorites</button>
            </div>
        </div>-->
    </div>
<form method="post" action="">
    <div class="container" type="hidden" style="display: none" name="submitcommentcontainer">
        <div class="row">
            <div class="col-md-12">
                <h4>New Comment</h4>
                <textarea class="input-lg" name="commenttext">Put your comment here</textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-success" type="submit" name="submitcomment" value="-1">Submit </button>
            </div>
        </div>
    </div>
    </form>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>