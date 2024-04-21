<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="design.css">

    <style>

    /* navigation bar style */
    #header {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        height: 40px;
        padding: 20px;
        background-color: transparent;
        color: white;
        position: fixed;
        width: 100%;
        z-index: 10;
        transition: background-color 1s ease-in;
    }

    #header.scrolled{
        background-color: black;
    }

    #header nav {
        display: flex;
    }
        

    #header nav ul {
        display: flex;
        flex-direction: row;
        list-style: none;
        justify-content: flex-end;
        margin-right: 25px;
    }

    #header nav ul li a {
        margin: 10px;
        font-size: 15px;
        text-transform: uppercase;
        letter-spacing: 1.7px;
        text-decoration: none;
        color: white;
        padding-bottom: 5px;
    }

    #header nav ul li a:hover{
        border-bottom: 1px solid white;
    }
    
    #admin{
        margin: 0 10px;
        font-size: 15px;
        text-transform: uppercase;
        letter-spacing: 1.7px;
        padding-bottom: 5px;
        cursor: pointer;
    }

    #container{
        position: relative;
    }

    #container:hover #content{
        cursor: pointer;
        display: block;
    }

    #content{
        position: absolute;
        background-color: white;
        min-width: max-content;
        transform: translateX(-40%);
        display: none;
        border-radius: 5px;
    }

    #content a{
        display: flex;
        flex-direction: column;
        align-items: center;
        color: black;
        text-decoration: none;
        padding: 5px 8px; 
        font-size: 15px;
    }

    #content a:nth-child(1),
    #content a:nth-child(2),
    #content a:nth-child(3){
        border-bottom: 1px solid black;
    }

    #content a:nth-child(1){
        border-top-right-radius: 5px;
        border-top-left-radius: 5px;
    }

    #content a:nth-child(4){
        border-bottom-right-radius: 5px;
        border-bottom-left-radius: 5px;
    }

    #content a:hover{
        background-color: lightsteelblue;
    }
    
    
    </style>

</head>
<body>
    <!-- for navigation bar -->
    <div id="header">
        <h1>Houses.com</h1>

        <!-- for the shortcuts/links -->
        <nav>
            <ul>
                <li><a href="#aTagHomeLink">Homes</a></li>
                <li><a href="#aTagLocationLink">Locations</a></li>
                <li><a href="#">Reservations</a></li>
                <li><a href="contacts.html">Contacts</a></li>
                <div id="container">
                    <li id="admin">Admin</li>
                    <div id="content">
                        <a href="admin_house_info.php">House Info</a>
                        <a href="">Interior Design</a>
                        <a href="">User Messages</a>
                        <a href="">Log Out</a>
                    </div>
                </div>
            </ul>
        </nav>
    </div>

    <!-- sliding images for the back ground in landing page -->
    <?php include("./home_page_bgslidding.php")?>
</body>
</html>