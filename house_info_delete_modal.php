<?php
    require_once "./connfigure.php";
    $id = $_GET["id"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./design.css">

    <style>
        /* modal design */
        .modal{
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            position: fixed;
            justify-content: center;
            align-items: center;
            z-index: 1;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
        }

        .modal_content{
            position: relative;
            width: 35%;
            height: 50%;
            background-color: white;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .modal_header{
            display: flex;
            flex-direction: row;
            padding: 25px 20px;
            justify-content: space-between;
            color: rgba(0, 0, 0, 1);
            border-bottom: 1px solid rgba(0, 0, 0, 0.3);
            background-color: rgba(255, 74, 74, 1);
            border-top-right-radius: 5px;
            border-top-left-radius: 5px;
        }

        .close_container{
            display: flex;
            flex-direction: column;
            align-items: end;
        }

        .close_button{
            display: flex;
            position: relative;
            justify-content: center;
            align-items: center;
            margin: 5px;
            border: 1px solid rgba(0, 0, 0, 0.7);
            width: 20px;
            height: 20px;
            border-radius: 100%;
            padding: 3px;
        }

        .close_button:hover{
            box-shadow: 0 0 8px rgba(0, 115, 255, 1),
                0 0 6px rgba(89, 164, 255, 1);
        }

        .close_button span{
            font-size: 18px;
            color: rgba(0, 0, 0, 0.9);
            position: absolute;
            top: 50%;
            transform: translateY(-55%);
        }

        .close_button span:hover{
            font-weight: bold;
        }

        .close{
            cursor: pointer;
        }

        .content_delete{
            padding: 20px;
        }

        .content_delete p{
            font-size: 20px;
            text-align: center;
        }

        .add_houses_cancel{
            width: 100%;
            height: 80px;
            display: flex;
            justify-content: end;
            align-items: center;
            border-top: 1px solid rgba(0, 0, 0, 0.3);
        }

        .add_houses_cancel a, .forms .add_houses_cancel input.add{
            text-decoration: none;
            color: white;
            margin: 20px 10px;
            padding: 10px 15px;
            border: none;
            border-radius: 10px;
            width: auto;
            height: auto;
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

    </style>
</head>
<body>
    <!-- modal form for add info -->
    <div class="modal">
        <div class="modal_content">
            
            <!-- query for selecting all the data base on the given id -->
            <?php
                $query = "SELECT house_type FROM `house_info_table` WHERE id = '$id'";
                $select = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($select);
            ?>
        
            <div class="modal_header">
                <h1>Delete <?php echo $row["house_type"]?>????</h1>
                <div class="close_container">
                    <div class="close_button">
                        <span class="close">&times;</span>
                    </div>
                </div>
            </div>

            <div class="content_delete">
                <p>Are you sure you want to delete all the data <br>that was included with the <?php echo $row["house_type"]?></p>
            </div>

            <div class="forms">
                <form action="./house_info_crud.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <div class="add_houses_cancel">
                        <input type="submit" name="submit" class="add" value="Delete House">
                        <a class="delete">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var modal = document.querySelector('.modal');
        var close_modal = document.querySelector('.close');
        var cancel = document.querySelector('.delete');

        close_modal.onclick = function(){
            modal.style.display = "none";
        }

        cancel.onclick = function(){
            modal.style.display = "none";
        }


        window.addEventListener('click', function(event){
            if(event.target === modal){
                modal.style.display = "none";
            }
        });

        
    </script>
</body>
</html>
