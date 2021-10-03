<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP_CRUD_Application</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css">    
    <style>
    body{
        background: rgb(238,174,202);
        background: radial-gradient(circle, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 100%);
    }
    </style>
</head>
<body>
    <?php require_once 'process.php'; ?>

    <?php
    if(isset($_SESSION['message'])): ?>

    <div class="alert alert-<?=$_SESSION['msg_type']?>" >

    <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);

    ?>
    </div>

    <?php endif ?> 
    <div  class = "container" > 
    <?php

    $mysqli = new mysqli('localhost' , 'root' , 'rishi' , 'mgmt') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM data") or die(mysqli_error($mysqli));
    
    ?>

    <div class="main">
        <table class="table" >
            <thead>
                <tr>
                    <th>SongName</th>
                    <th>SingerName</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
        <?php
            while ($row = $result->fetch_assoc()):?>
            <tr>
                <td><?php echo $row['SongName']; ?></td>
                <td><?php echo $row['SingerName']; ?></td>
                <td>
                    <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                    <a href="process.php?delete=<?php echo $row['id']; ?>"  class="btn btn-danger" >Delete</a>
                </td>
            </tr>   
            <?php endwhile ?>  
        </table>

    </div>
    <?php
    //pre_r($result);
    pre_r($result->fetch_assoc());
    function pre_r( $array ){
        //echo 'pre_r';
        print_r( $array );
        //echo '</pre_r>';
    }

    ?>
    <div>
    <form id='uploadForm' action="process.php" method="POST">

        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
        <label>Song Name:</label>
        <input type="text" name="SongName"  class="form-control" placeholder="Enter Song Name"
        value="<?php echo $SongName; ?>" required>
        </div>
        <div class="form-group">
        <label>Singer Name:</label>
        <input type="text" name="SingerName" class="form-control" placeholder="Enter Singer Name"
        value="<?php echo $SingerName; ?>" required>
        </div>
        <div class="form-group">
            <?php
                if ($update == true):
            ?>
                <button type="submit" class="btn btn-info" name="update">Update</button>
            <?php else: ?>
                <button type="submit" class="btn btn-danger" name="save">Add</button>
            <?php endif; ?>
        </div>
    </div>
    </div>
    </form>
</body>
</html>