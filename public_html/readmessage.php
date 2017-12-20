<?php

    include("session.php");

    date_default_timezone_set('Europe/Istanbul');
    $time = time();
    $atime = date('Y-m-d H:i:s',$time);

    $senderid = mysqli_real_escape_string($db,$_GET["id"]);

    if(isset($_POST['sendmessage'])){

        $replymessage = mysqli_real_escape_string($db, $_POST['reply']);
        $query = "INSERT INTO Messages (sender_id, receiver_id, content) VALUES ($login_id, $senderid, '$replymessage')";
        $data = mysqli_query ($db,$query)or die(mysqli_error($db));

    }
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M:\Bilkent\CS353\Project\Frontend\individualpost - Kopya</title>
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
                </button><a class="navbar-brand navbar-link" href="#">CaseSwitchers </a></div>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav">
                    <li role="presentation"><a href="#">Home </a></li>
                    <li role="presentation"><a href="#">Posts </a></li>
                    <li role="presentation"><a href="#">Categories </a></li>
                    <li role="presentation"><a href="#">Users </a></li>
                    <li role="presentation"></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li role="presentation"><a href="#">Profile </a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Message Content</h4></div>
        </div>
    </div>
    <div class="container">
        <?php
            $query = "SELECT * FROM Messages WHERE ((receiver_id = '$login_id' AND sender_id = '$senderid') OR (receiver_id = '$senderid' AND sender_id = '$login_id')) ORDER BY timestamp ASC";
            $result = $db->query($query);

            if ($result->num_rows > 0) {

                while($row = $result->fetch_assoc()){

                    if($row["receiver_id"] == $login_id){
                            
                        $sender = $row["sender_id"];
                        $query2 = "SELECT username FROM User WHERE userID = '$sender'";
                        $result2 = $db->query($query2);
                        $row2 = $result2->fetch_assoc();

                        echo '<div class="row">
                            <div class="col-md-12">
                                <blockquote>
                                    <p>'.$row["content"].'</p>
                                    <footer>'.$row2["username"].' | Sent: '.$row["timestamp"].'</footer>
                                </blockquote>
                            </div>
                        </div>';
                    }

                    else if($row["sender_id"] == $login_id){

                        $sender = $row["sender_id"];
                        $query2 = "SELECT username FROM User WHERE userID = '$sender'";
                        $result2 = $db->query($query2);
                        $row2 = $result2->fetch_assoc();

                        echo '<div class="row">
                            <div class="col-md-11 col-md-offset-1 col-xs-11 col-xs-offset-1">
                                <blockquote>
                                    <p>'.$row["content"].'</p>
                                    <footer>'.$row2["username"].' | Sent: '.$row["timestamp"].'</footer>
                                </blockquote>
                            </div>
                        </div>';
                    }

                }
            } 
        ?>

    </div>
    <div class="container">
        <form action="" method="post">
            <div class="row">
                <div class="col-md-12">
                    <h4>Reply</h4>
                    <textarea class="input-lg" name="reply">Put your message here</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-success" type="submit" name="sendmessage">Submit </button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-2 col-md-offset-9 col-md-push-1">
                <a class="btn btn-info active" type="button" href="inbox.php">Back to Inbox  </a>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>