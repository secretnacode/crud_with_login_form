<?php

    // adding house in data base
    if(isset($_POST["submit"])){
        if($_POST["submit"] == "Add House"){
            add_house();
        }
        else if($_POST["submit"] == "Edit House"){
            edit_house();
        }
        else if($_POST["submit"] == "Delete House"){
            delete_house();
        }
    }

    // a function for adding a house data in the database
    function add_house(){
        include "./connfigure.php";
        
        $house_num = filter_input(INPUT_POST, "house_num", FILTER_SANITIZE_NUMBER_INT);
        $house_type = filter_input(INPUT_POST, "house_type", FILTER_SANITIZE_SPECIAL_CHARS);
        $site_name = filter_input(INPUT_POST, "site_name", FILTER_SANITIZE_SPECIAL_CHARS);
        $house_price = filter_input(INPUT_POST, "house_price", FILTER_SANITIZE_NUMBER_INT);
        $house_monthly_price = filter_input(INPUT_POST, "house_monthly_price", FILTER_SANITIZE_NUMBER_INT);

        $pic_name = basename($_FILES['file']['name']);
        $pic_temp = $_FILES["file"]["tmp_name"];
        $new_pic_name = uniqid() . "-{$house_type}-{$site_name}-{$pic_name}";
        $path = "./pictures/" . $new_pic_name;
        $pic_type = pathinfo($path, PATHINFO_EXTENSION);
        $allow_type = array('jpg', 'png', 'jpeg', 'gif');

        $query = "INSERT INTO `house_info_table`(`house_num`, `house_type`, `house_site`, `house_price`, `monthly_price`, `house_picture`) 
        VALUES ('$house_num','$house_type','$site_name','$house_price','$house_monthly_price','$pic_name')";

        if(in_array($pic_type, $allow_type)){
            if(move_uploaded_file($pic_temp, $path)){
                $insert = mysqli_query($conn, $query);
                $success = ($insert) ? header('location: ./admin_house_info.php?good_msg=The house has been ADDEDD SUCCESSFULLY') : error_log(mysqli_error($conn));
            }
            else{
                header('location: ./admin_house_info.php?bad_msg=There seems to be a problem uploading the image in the database');
            }
        }
        else{
            header('location: ./admin_house_info.php?bad_msg=Only "jpg", "png", "jpeg", and "gif" picture is allowed');
        }

        $conn -> close();
    }

    // a function for the selected id to be edited
    function edit_house(){
        $id = $_POST["id"];

        include "./connfigure.php";
        
        $house_num = filter_input(INPUT_POST, "house_num", FILTER_SANITIZE_NUMBER_INT);
        $house_type = filter_input(INPUT_POST, "house_type", FILTER_SANITIZE_SPECIAL_CHARS);
        $site_name = filter_input(INPUT_POST, "site_name", FILTER_SANITIZE_SPECIAL_CHARS);
        $house_price = filter_input(INPUT_POST, "house_price", FILTER_SANITIZE_NUMBER_INT);
        $house_monthly_price = filter_input(INPUT_POST, "house_monthly_price", FILTER_SANITIZE_NUMBER_INT);
        
        $pic_name = basename($_FILES['file']['name']);
        $pic_temp = $_FILES["file"]["tmp_name"];
        $new_pic_name = uniqid() . "-{$house_type}-{$site_name}-{$pic_name}";
        $path = "./pictures/" . $new_pic_name;
        $pic_type = pathinfo($path, PATHINFO_EXTENSION);
        $allow_type = array('jpg', 'png', 'jpeg', 'gif');

        // for the saved pic name if the file type input is not filled up in edit modal
        $saved_picture_file = $_POST["picture"];
        
        if(!empty($pic_name)){
            if(in_array($pic_type, $allow_type)){
                if(move_uploaded_file($pic_temp, $path)){
                    $query = "UPDATE `house_info_table` SET `house_num`='$house_num',`house_type`='$house_type',`house_site`='$site_name',`house_price`='$house_price',`monthly_price`='$house_monthly_price',`house_picture`='$pic_name' WHERE id = '$id'";
                    $insert = mysqli_query($conn, $query);
                    $success = ($insert) ? header('location: ./admin_house_info.php?good_msg=The house has been UPDATED SUCCESSFULLY') : error_log(mysqli_error($conn));
                }
                else{
                    header('location: ./admin_house_info.php?bad_msg=There seems to be a problem updating the image in the database');
                }
            }
            else{
                header('location: ./admin_house_info.php?bad_msg=hellow po');
            }
        }
        else{
            $query = "UPDATE `house_info_table` SET `house_num`='$house_num',`house_type`='$house_type',`house_site`='$site_name',`house_price`='$house_price',`monthly_price`='$house_monthly_price',`house_picture`='$saved_picture_file' WHERE id = '$id'";
            $insert = mysqli_query($conn, $query);
            $success = ($insert) ? header('location: ./admin_house_info.php?good_msg=The house has been UPDATED SUCCESSFULLY') : error_log(mysqli_error($conn)); 
        }   

        $conn -> close();
    }

    // a function for the selected house to be deleted
    function delete_house(){
        $id = $_POST["id"];

        include "./connfigure.php";

        $query = "DELETE FROM `house_info_table` WHERE id = $id";
        $delete = mysqli_query($conn, $query);
        $success = ($delete)? header('location: ./admin_house_info.php?good_msg=The house data hase been DELETED SUCCESSFULLY') : error_log(mysqli_error($conn));

        $conn -> close();
    }

?>
