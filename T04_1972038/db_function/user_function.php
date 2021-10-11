<?php
    function login($email,$password)
    {
        $link = createMySQLConnection();
        $query="SELECT id,name,email FROM user WHERE email=? AND password=? LIMIT 1";
        $stmt=$link->prepare($query);
        $stmt->bindParam(1,$email,PDO::PARAM_STR);
        $stmt->bindParam(2, $password,PDO::PARAM_STR);
        $stmt->execute();
        $result=$stmt->fetch();
        closeConnection($link);
        return $result;
    }
?>