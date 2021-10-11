<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Update</title>
</head>
<body>
<?php
    $updatedIsbn = filter_input(INPUT_GET,'uid');
    if(isset($updatedIsbn)){
        $result=fetchBook($updatedIsbn);
    }
    $submitted=filter_input(INPUT_POST,'submitBook');
    if(isset($submitted)){
        $isbn = filter_input(INPUT_POST,'txtIsbn');
        $title = filter_input(INPUT_POST,'txtTitle');
        $author = filter_input(INPUT_POST,'txtAuthor');
        $publisher = filter_input(INPUT_POST,'txtPublisher');
        $description = filter_input(INPUT_POST,'txtDescription');
        $cover = filter_input(INPUT_POST,'txtCover');
        $genre = filter_input(INPUT_POST,'selectGenre');
        $resUpdate = updateBook($isbn,$title,$author,$publisher,$description,$cover,$genre);
        if($resUpdate){
            header("location:index.php?mn=book");
        }
        else{
            echo "<div>Failed to update data</div>";
    
        }
    }
?>  
<form id="formBook" method="post">
    <h3>Form Buku</h3>
    <table>
        <tr>
            <td><label for="txtIsbn">ISBN</label></td>
            <td><input required  readonly type="text" name="txtIsbn" value="<?php echo $result['isbn']?>"></td>
        </tr>
        <tr>
            <td><label for="txtTitle">Title</label></td>
            <td><input required  type="text" name="txtTitle" value="<?php echo $result['title']?>"></td>
        </tr>
        <tr>
            <td><label for="txtAuthor">Author</label></td>
            <td><input required  type="text" name="txtAuthor" value="<?php echo $result['author']?>"></td>
        </tr>
        <tr>
            <td><label for="txtPublisher">Publisher</label></td>
            <td><input required  type="text" name="txtPublisher"  value="<?php echo $result['publisher']?>"></td>
        </tr>
        <tr>
            <td><label for="txtDescription">Description</label></td>
            <td><input  required type="text" name="txtDescription" value="<?php echo $result['description']?>"></td>
        </tr>
        <tr>
            <td><label for="txtCover">Cover</label></td>
            <td><input required  type="text" name="txtCover" value="<?php echo $result['cover']?>"></td>
        </tr>
        <tr>
            <td><label for="selectGenre">Genre</label></td>
            <td> 
                <select name="selectGenre">
                <?php
                    $query = "SELECT id,name FROM genre ORDER BY name";
                    $genres = fetchGenres();
                    foreach($genres as $genre){
                        if($result['genre_id'] == $genre['id']){
                            echo "<option selected value=".$genre['id'].">".$genre["name"]."</option>";
                        }
                        else{
                            echo "<option value=".$genre['id'].">".$genre["name"]."</option>";
                        }
                    }
                ?>
                </select>
            </td>
            <td><input type="submit" name="submitBook"></td>
        </tr>
    </table>
</form> 
</body>
</html>