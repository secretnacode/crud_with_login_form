<?php
    require_once "./connfigure.php";

    // for modal file
    if(isset($_POST["submit"])){
        if(!filter_input(INPUT_POST, "house_num", FILTER_VALIDATE_INT)){
            if($_POST["submit"] == "Add House"){
                require_once "./modals/house_info_add_modal.php";
            }
            elseif($_POST["submit"] == "Edit House"){
                require_once "./modals/house_info_edit_modal.php";
            }
            else if($_POST["submit"] == "Delete House"){
                require_once "./modals/house_info_delete_modal.php";
            }
        }
        else{
            header('location: ../admin_house_info.php?bad_msg=The house number is not valid');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="design.css">

    <style>
            
        .content{
            width: 100%;
        }

        .msg{
            position: fixed;
            width: 40%;
            height: 80px;
            transform: translateX(75%);
            font-size: 15px;
            font-weight: bold;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .msg span{
            position: inherit;
            right: 0;
            padding: 5px;
            margin: 10px;
            font-size: 15px;
            width: 17px;
            height: auto;
            text-align: center;
            border: 1px solid rgba(0, 0, 0, 0.7);
            border-radius: 50%;
            cursor: pointer;
        }

        .msg span:hover{
            font-weight: bolder;
            transform: scale(1.1);
        }

        #bad_msg{
            background-color: rgba(219, 64, 53, 1);
        }
        
        #good_msg{
            background-color: rgba(59, 217, 66, 1);
        }

        /* navigation design */
        #navigation {
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
            background-color: #1c1c1c;
            color: white;
            width: 15%;
            height: 100%;
            position: fixed;
        }

        .navigagtion_content{
            margin: 0px 0;
            position: sticky;
            top: 0;
        }

        .navigagtion_content h1{
            margin: 40px 10px 10px 10px;
        }

        .navigagtion_content nav {
            margin-top: 20px;
        }

        .navigagtion_content nav ul {
            display: flex;
            flex-direction: column;
            list-style: none;
        }
        
        .navigagtion_content nav ul li:hover{
            background-color: #5c5c5c;
        }

        .navigagtion_content nav ul li a {
            font-size: 15px;
            text-transform: uppercase;
            letter-spacing: 1.7px;
            text-decoration: none;;
            color: white;
            padding-bottom: 5px;
            display: block;
            padding: 15px 25px;
            transition: transform 0.15s linear;
        }

        #navigation nav ul li a:hover{
            transform: scale(1.07);
        }

        /* table content */
        .table_content{
            width: 100%;
            display: flex;
            justify-content: end;
        }

        .values{
            width: 80%;
        }

        /* status design */
        .status{
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
        }

        .stat{
            width: 20%;
            height: 100px;
            border: 1px solid black;
            border-radius: 10px;
            margin: 20px;
        }

        /* tables designs */
        .data_table{
            display: flex;
            width: 100%;
            justify-content: center;
            margin-top: 30px;
        }

        #table_container{
            border: 1px solid black;
            width: 90%;
            border-radius: 5px;
        }

        .table_header{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            height: 80px;
            background-color: #e3e3e3;
            border-top-right-radius: 5px;
            border-top-left-radius: 5px;
            border-bottom: 1px solid black;
        }

        .table_header h1{
            padding: 20px;
            justify-content: center;
        }

        .add_delete{
            display: flex;
            align-items: center;
        }

        .add_delete form input{
            text-decoration: none;
            margin: 20px 15px 20px 0;
            padding: 12px 15px;
            border: none;
            border-radius: 10px;
            color: white;
        }

        .delete{
            background: rgba(255, 52, 52, 1);
            transition: transform 0.1s linear, 
                box-shadow 0.1s linear;
        }

        .add{
            background: rgba(94, 77, 255, 1);
            transition: transform 0.1s linear, 
                box-shadow 0.1s linear;
        }

        .delete:hover, .add:hover{
            transform: translateY(-5px);
            box-shadow: 0 5px 5px rgba(0, 0, 0, 0.7);
        }

        #table_content{
            padding: 5px 20px 20px 20px;
            background-color: white;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        #table_search form{
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 50px;
        }

        #table_search form label{
            color: rgba(0, 0, 0, 0.7);
        }


        #table_search form input{
            display: flex;
            justify-content: end;
            align-items: end;
            height: 25px;
            font-size: 15px;
            padding: 3px;
            border-radius: 8px;
            border: 1.5px solid rgba(0, 0, 0, 0.7);
        }

        #table_search form input:focus{
            box-shadow: 0 0 8px rgba(0, 115, 255, 1),
                0 0 6px rgba(89, 164, 255, 1);
        }   

        #table{
            border: 1px solid rgba(0, 0, 0, 0.4);
            padding: 20px 30px;
            margin-top: 15px;
        }

        table{
            border-collapse: collapse;
            width: 100%;
        }
        
        th, td{
            text-align: left;
        } 

        th{
            padding: 0 8px;
            font-size: 18px;
            letter-spacing: 0.5px;
            border-bottom: 3px solid rgba(0, 0, 0, 0.7);
        }
        
        td{
            padding: 20px 8px;
            font-size: 17px;
            border: 1px solid rgba(0, 0, 0, 0.2);
        }

        th:nth-of-type(1){
            width: 5%;
        }

        th:nth-of-type(2),
        th:nth-of-type(7),
        th:nth-of-type(6),
        th:nth-of-type(4){
            width: 10%;
        }

        th:nth-of-type(3){
            width: 18%;
        }

        th:nth-of-type(5){
            width: 12%;
        }

        th:nth-of-type(8){
            width: 25%;
        }

        td:nth-of-type(n+7),
        td:nth-last-of-type(n+7),
        th:nth-of-type(2),
        th:nth-of-type(n+7){
            text-align: center;
        }

        td a svg{
            transition: transform 0.1s linear;
        }

        td a svg:hover{
            transform: scale(1.2);
        }

        

        .action_form input{
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
        }

    </style>
</head>
<body>

    <!-- table contents -->
    <div class="content">
        <?php
            if(isset($_GET["bad_msg"])){
                $bad_mesage = $_GET["bad_msg"];

                echo '
                <div id="bad_msg" class="msg">
                    ' .$bad_mesage. '
                    <span class="close_button">&times;</span>
                </div> 
                ';
            }
            else if(isset($_GET["good_msg"])){
                $good_mesage = $_GET["good_msg"];
                
                echo '
                <div id="good_msg" class="msg">
                    ' .$good_mesage. '
                    <span class="close_button">&times;</span>
                </div> 
                ';
            }
        ?>

        <!-- for the navbar -->
        <div id="navigation">
            <div class="navigagtion_content">
                <h1>Houses.com</h1>

                <!-- for the shortcuts/links -->
                <nav>
                    <ul>
                        <li><a href="admin_home_page.php">Houses</a></li>
                        <li><a href="admin_house_info.php">House Info</a></li>
                        <li><a href="">Interior Design</a></li>
                        <li><a href="">Contact Info</a></li>
                        <li><a href="">User Messages</a></li>
                        <li><a href="">Log Out</a></li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- houses status -->
        <div class="table_content">
            <div class="values">
                <!-- <div class="status">
                    <div class="stat">
                        <h1>houses count</h1>
                    </div>

                    <div class="stat">
                        <h1>house bought</h1>
                    </div>

                    <div class="stat">
                        <h1>houses buyer</h1>
                    </div>
                </div>     -->

                <!-- tables -->
                <div class="data_table">
                    <div id="table_container">
                        <div class="table_header">
                            <h1>Houses Info</h1>
                            
                            <div class="add_delete">
                                <form action="./admin_house_info.php" method="post">
                                    <!-- <input type="submit" name="submit" class="delete" value="Delete Houses"> -->
                                    <input type="submit" name="submit" class="add" value="Add House">
                                </form>
                            </div>
                        </div>
                        
                        <div id="table_content">
                            <div id="table_search">
                                <form action="" method="">
                                    <div class="limit_input">    
                                        <label for="limit">show:</label>
                                        <input type="number" name="limit" value="0">
                                    </div>

                                    <div class="search_input">    
                                        <label for="search">search:</label>
                                        <input type="text" name="search">
                                    </div>
                                </form>
                            </div>

                            <div id="table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th scope=col></th>
                                            <th scope=col>House Num</th>
                                            <th scope=col>House type</th>
                                            <th scope=col>House Site</th>
                                            <th scope=col>House Price</th>
                                            <th scope=col>Monthly Price</th>
                                            <th scope=col>House Picture</th>
                                            <th scope=col colspan="2">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <!-- query for selecting all the data in the house_info_table in database -->
                                        <?php
                                            $query = " SELECT * FROM `house_info_table` WHERE 1";
                                            $select = mysqli_query($conn, $query);
                                            $results = mysqli_num_rows($select);

                                            if($results > 0){
                                                while($rows = mysqli_fetch_assoc($select)){
                                        ?>

                                        <tr>
                                            <td>
                                                <form action="" class="checked_info">
                                                    <input type="checkbox">
                                                </form>
                                            </td>
                                            <td><?php echo $rows["house_num"]?></td>
                                            <td><?php echo $rows["house_type"]?></td>
                                            <td><?php echo $rows["house_site"]?></td>
                                            <td><?php echo "₱" . $rows["house_price"]?></td>
                                            <td><?php echo "₱" . $rows["monthly_price"]?></td>
                                            <td>yes</td>
                                            <form action="./admin_house_info.php?id=<?php echo $rows["id"]?>" method="post">
                                                <td class="action_form">
                                                    <input type="submit" name="submit" value="Edit House" class="add"> 
                                                    <input type="submit" name="submit" value="Delete House" class="delete">
                                                </td>
                                            </form>
                                        </tr>

                                        <?php
                                                }
                                            }
                                        ?>
                                            
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var msg = document.querySelector(".msg");
        var close_msg = document.querySelector(".close_button");
            
        close_msg.onclick= function(){
            msg.style.display = "none"; 
        }

        setTimeout(function() {
            msg.style.display = "none"; 
        }, 5000); 

    </script>
</body>
</html> 