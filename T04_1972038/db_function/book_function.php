<?php
    function fetchBooks(){
        $query="SELECT isbn,title,author,publisher,description,cover,name,genre_id from book b LEFT JOIN genre g ON b.genre_id = g.id";
        $link = createMySQLConnection();
        $bookList = $link->query($query);
        closeConnection($link);
        return $bookList;
    }

    function fetchBook($updatedIsbn){
        $link = createMySQLConnection();
        $query = "SELECT isbn,title,author,publisher,description,cover,name,genre_id from book b LEFT JOIN genre g ON b.genre_id = g.id WHERE isbn=?";
        $stmt=$link->prepare($query);
        $stmt->bindParam(1,$updatedIsbn,PDO::PARAM_STR);
        $stmt->execute();
        $result=$stmt->fetch();
        closeConnection($link);
        return $result;
    }

    function addNewBook($isbn,$title,$author,$publisher,$description,$cover,$genre){$query = "INSERT INTO book(isbn,title,author,publisher,description,cover,genre_id) VALUES(?,?,?,?,?,?,?)";
        $result = 0;
        $link = createMySQLConnection();
        $stmt=$link->prepare($query);
        $stmt->bindParam(1,$isbn,PDO::PARAM_STR);
        $stmt->bindParam(2,$title,PDO::PARAM_STR);
        $stmt->bindParam(3,$author,PDO::PARAM_STR);
        $stmt->bindParam(4,$publisher,PDO::PARAM_STR);
        $stmt->bindParam(5,$description,PDO::PARAM_STR);
        $stmt->bindParam(6,$cover,PDO::PARAM_STR);
        $stmt->bindParam(7,$genre,PDO::PARAM_INT);
        $link->beginTransaction();
        if($stmt->execute()){
            $link->commit();
            $result = 1;
        }
        else{
            $link->rollBack();
        }
        closeConnection($link);
        return $result;
    }

    function updateBook($isbn,$title,$author,$publisher,$description,$cover,$genre){
        $link = createMySQLConnection();
        $result = 0;
        $query = "UPDATE book SET title=?,author=?,publisher=?,description=?,cover=?,genre_id=? WHERE isbn=?";
        $stmt=$link->prepare($query);
        $stmt->bindParam(7,$isbn,PDO::PARAM_STR);
        $stmt->bindParam(1,$title,PDO::PARAM_STR);
        $stmt->bindParam(2,$author,PDO::PARAM_STR);
        $stmt->bindParam(3,$publisher,PDO::PARAM_STR);
        $stmt->bindParam(4,$description,PDO::PARAM_STR);
        $stmt->bindParam(5,$cover,PDO::PARAM_STR);
        $stmt->bindParam(6,$genre,PDO::PARAM_INT);
        $link->beginTransaction();
        if($stmt->execute()){
            $link->commit();
            $result = 1;
        }
        else{
            $link->rollBack();
        }
        return $result;
    }

    function deleteBook($deletedId){
        $result = 0;
        $link = createMySQLConnection();
        $query = "DELETE FROM book WHERE isbn=?";
        $stmt = $link->prepare($query);
        $stmt->bindParam(1,$deletedId,PDO::PARAM_STR);
        $link->beginTransaction();
        if($stmt->execute()){
            $link->commit();
            $result = 1;
        }
        else{
            $link->rollBack();
        }
        closeConnection($link);
        return $result;
    }
?>