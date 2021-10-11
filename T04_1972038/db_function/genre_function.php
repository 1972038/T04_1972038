
<?php
include_once 'util/db_util.php';
function fetchGenres(){
    $link = createMySQLConnection();
    $query = "SELECT * FROM genre ORDER BY name";
    $genres = $link->query($query);
    closeConnection($link);
    return $genres;
}

function fetchGenre($id){
    $link = createMySQLConnection();
    $query="SELECT * FROM genre WHERE id= ?";
    $stmt=$link->prepare($query);
    $stmt->bindParam(1,$id,PDO::PARAM_INT);
    $stmt->execute();
    $result=$stmt->fetch();
    closeConnection($link);
    return $result;
}

function addNewGenre($name){
    $result = 0;
    $query = "INSERT INTO genre(name) VALUES(?)";
    $link = createMySQLConnection();
    $stmt = $link->prepare($query);
    $stmt->bindParam(1,$name,PDO::PARAM_STR);
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

function deleteGenre($id){
    $result = 0;
    $link = createMySQLConnection();
    $query = "DELETE FROM genre WHERE id=?";
    $stmt = $link->prepare($query);
    $stmt->bindParam(1,$id,PDO::PARAM_INT);
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

function updateGenre($id,$name){
    $result = 0;
    $link = createMySQLConnection();
    $query='UPDATE genre SET name = ? WHERE id=?';
    $stmt = $link->prepare($query);
    $stmt->bindParam(1,$name,PDO::PARAM_STR);
    $stmt->bindParam(2,$id,PDO::PARAM_INT);
    $link->beginTransaction();
    if($stmt->execute()){
        $link->commit();
        $result = 1;
        header("location:index.php?mn=genre");
    }
    else{
        $link->rollBack();
    }
    closeConnection($link);
    return $result;
}
?>