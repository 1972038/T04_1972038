<?php
    session_start();
    include_once 'util/db_util.php';
    include_once 'db_function/genre_function.php';
    include_once 'db_function/user_function.php';
    include_once 'db_function/book_function.php';
    if(!isset($_SESSION['my_user'])){
        $_SESSION['my_user']=false;
    }

?>

<!DOCTYPE html>
<head>
    <title>Tugas 04</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/colreorder/1.5.4/css/colReorder.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/keytable/2.6.4/css/keyTable.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/web_style.css"/>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/colreorder/1.5.4/js/dataTables.colReorder.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/keytable/2.6.4/js/dataTables.keyTable.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="js/cmd_script.js"></script>
    
    <script>
        $(document).ready( function () {
            $('.listTable').DataTable();
        } );
    </script>
</head>
<body>
    <?php
        if($_SESSION['my_user']){
    ?>
    <a href="?mn=home">Home</a>
    <a href="?mn=genre">Genre</a>
    <a href="?mn=book">Book</a>
    <a href="?mn=logout">Logout</a>
    <?php
        $menu=filter_input(INPUT_GET,"mn");
        switch($menu){
            case "home":
                include_once 'pages/home.php';
                break;
            case "genre":
                include_once 'pages/genre_page.php';
                break;
            case "editGendre":
                include_once 'pages/genre_edit_page.php';
                break;
            case "book":
                include_once 'pages/book_page.php';
                break;
            case "updateBuku":
                include_once 'pages/book_edit_page.php';
                break;
            case 'logout':
                session_unset();
                session_destroy();
                header('location:index.php');
                break;
            default:
                include_once 'pages/home.php';
                break;
        
            }
        }else{
            include_once 'pages/login_page.php';
        }
    ?>
</body>
</html>