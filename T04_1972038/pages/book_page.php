<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Page</title>
</head>
<body>
<?php
    $submitted = filter_input(INPUT_POST,'submitBook');
    if(isset($submitted)){
        $isbn = filter_input(INPUT_POST,'txtIsbn');
        $title = filter_input(INPUT_POST,'txtTitle');
        $author = filter_input(INPUT_POST,'txtAuthor');
        $publisher = filter_input(INPUT_POST,'txtPublisher');
        $description = filter_input(INPUT_POST,'txtDescription');
        $cover = filter_input(INPUT_POST,'txtCover');
        $genre = filter_input(INPUT_POST,'selectGenre');
        $resultAdd = addNewBook($isbn,$title,$author,$publisher,$description,$cover,$genre);
        if($resultAdd){
            echo "<div>Data successfully added</div>";
        }
        else{
            echo "<div>Failed to add data</div>";
        }
    }
    $choice = filter_input(INPUT_GET,'tok');
    if(isset($choice) && $choice=='del'){
        $deletedId=filter_input(INPUT_GET,'did');
        $resultDel = deleteBook($deletedId);
        if($resultDel){
            echo "<div>Data successfully deleted</div>";
        }
        else{
            echo "<div>Failed to delete data</div>";
        }
    }
    
?>
<form id="formBook" method="post">
    <fieldset>
    <legend>Form Buku</legend>
    <table>
        <tr>
            <td><label for="txtIsbn">ISBN</label>
                <input required type="text" name="txtIsbn"></td>
        </tr>
        <tr>
            <td><label for="txtTitle">Title</label>
                <input  required type="text" name="txtTitle"></td>
        </tr>
        <tr>
            <td><label for="txtAuthor">Author</label>
                <input required  type="text" name="txtAuthor"></td>
        </tr>
        <tr>
            <td><label for="txtPublisher">Publisher</label>
                <input required  type="text" name="txtPublisher"></td>
        </tr>
        <tr>
            <td><label for="txtDescription">Description</label>
                <input  required type="text" name="txtDescription"></td>
        </tr>
        <tr>
            <td><label for="txtCover">Cover</label>
                <input  required type="text" name="txtCover"></td>
        </tr>
        <tr>
            <td><label for="selectGenre">Genre</label>
             
                <select  name="selectGenre">
                <?php
                    $genres=fetchGenres();
                    foreach($genres as $genre){
                        echo "<option value=".$genre['id'].">".$genre["name"]."</option>";
                    }
                ?>
                </select>
            </td>
            <td><input type="submit" name="submitBook"></td>
        </tr>
    </table>
    </fieldset>
</form>
<br>
<table class="listTable">
        <thead>
            <th>ISBN</th>
            <th>Title</th>
            <th>Author</th>
            <th>Publisher</th>
            <th>Description</th>
            <th>Cover</th>
            <th>Genre</th>
            <th>Action</th>
        </thead>
        <?php
            $bookList = fetchBooks();
            foreach($bookList as $book){
                echo "<tr>
                     <td>".$book['isbn']."</td>
                     <td>".$book['title']."</td>
                     <td>".$book['author']."</td>
                     <td>".$book['publisher']."</td>
                     <td>".$book['description']."</td>
                     <td>".$book['cover']."</td>
                     <td>".$book['name']."</td>
                     <td><button onclick=editBook(".$book['isbn'].")>Edit</button>
                         <button onclick=deleteBook(".$book['isbn'].")>Delete</button></td>
                     </tr>";
            }
        ?>
    </table>
</body>
</html>