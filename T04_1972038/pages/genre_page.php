<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genre Page</title>
</head>
<body>

<?php
    $submitted = filter_input(INPUT_POST,"btnSubmit");
    if(isset($submitted)){
        $name = filter_input(INPUT_POST,"txtName");
        $result=addNewGenre($name);
        if($result){
            echo "<div>Data successfully added</div>";
        }
        else{
            echo "<div>Failed to add data</div>";
        }
        
    }

    $choice = filter_input(INPUT_GET,'tok');
    if(isset($choice) && $choice='del'){
        $deletedId = filter_input(INPUT_GET,'did');
        $resultDel= deleteGenre($deletedId);  
        if($resultDel){
            echo "<div>Data successfully deleted</div>";
        }
        else{
            echo "<div>Failed to delete data</div>";
        }     
    }
?>
<form action="" method="POST">
    <fieldset >
        <legend>Genre Form</legend>
        <label for="nameId">Name</label>
        <input type="text" id="nameId" name="txtName" placeholder="New Genre" maxlength="100">
        <input type="submit" value="Submit" name="btnSubmit">
    </fieldset>
</form>
<table class="listTable">
    <thead>
        <th>ID</th>
        <th>NAME</th>
        <th>Action</th>
    </thead>
    <tbody>
        <?php
            $genreList=fetchGenres();
            foreach($genreList as $genre){
                echo "<tr>
                      <td>".$genre['id']."</td>
                      <td>".$genre['name']."</td>
                      <td><button onclick=editGenre(".$genre['id'].")>Edit</button>
                          <button onclick=deleteGenre(".$genre['id'].")>Delete</button></td>
                      </tr>";
            }
        ?>
    </tbody>
</table>
    
</body>
</html>
