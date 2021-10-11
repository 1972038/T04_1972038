<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Page</title>
</head>
<body>

<?php
    $submitted = filter_input(INPUT_POST,"btnSubmit");
    if(isset($submitted)){
        $name = filter_input(INPUT_POST,"txtName");
        $query = "INSERT INTO genre(name) VALUES(?)";
        $link = new PDO("mysql:host=localhost; dbname=demo_pw220211","root",'');
        $link->setAttribute(PDO::ATTR_AUTOCOMMIT,false);
        $link->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $stmt = $link->prepare($query);
        $stmt->bindParam(1,$name,PDO::PARAM_STR);
        $link->beginTransaction();
        if($stmt->execute()){
            $link->commit();
        }
        else{
            $link->rollBack();
        }
        closeConnection($link);
    }
?>
<form action="" method="POST">
    <label for="nameId">Name</label>
    <input type="text" id="nameId" name="txtName" placeholder="New Genre" maxlength="100">
    <input type="submit" value="Submit" name="btnSubmit">
</form>
<table class="listTable">
    <thead>
        <th>ID</th>
        <th>NAME</th>
    </thead>
    <tbody>
        <?php
            $link = new PDO("mysql:host=localhost; dbname=demo_pw220211","root",'');
            $link->setAttribute(PDO::ATTR_AUTOCOMMIT,false);
            $link->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $query = "SELECT id,name FROM genre ORDER BY name";
            $genreList=$link->query($query);
            foreach($genreList as $genre){
                echo "<tr>
                      <td>".$genre['id']."</td>
                      <td>".$genre['name']."</td>
                      <td><button onclick=editGenre(".$genre['id'].")>Edit</button></td>
                      </tr>";
            }
            closeConnection($link);
        ?>
    </tbody>
</table>
    
</body>
</html>
