<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genre Update</title>
</head>
<body>
    

<?php
$updatedId=filter_input(INPUT_GET,'uid');
if(isset($updatedId)){
    $genres=fetchGenre($updatedId);
}

$submitted=filter_input(INPUT_POST,'btnUpdate');
if(isset($submitted)){
    $name = filter_input(INPUT_POST,'txtName');
    $result = updateGenre($updatedId,$name);
    if($result){
        header("location:index.php?mn=genre");
    }
    else{
        echo "<div>Failed to update data</div>";
    }
}
?>
<form action="" method="POST">
    <label for="fieldId">Id</label>
    <input type="text" name="txtId" id="fieldId" readonly value="<?php echo $genres['id']?>"> 
    <label for="nameId">Name</label>
    <input type="text" name="txtName" id="nameId" placeholder="Genre Name" maxlength="100" require value="<?php echo $genres['name']?>">
    <input type="submit" value="Update" name="btnUpdate">
</form>
</body>
</html>