<?php
session_start();

?>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Mali&family=Prompt:wght@200&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Prompt';
            margin: 0;
            padding: 0;
        }

        .navContainer {
            padding-bottom: 10vh;
        }

        .navContainer nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
        }

        .navContainer ul {
            list-style-type: none;
            margin: 0px;
            padding: 0px;
            overflow: hidden;
            background-color: #47B5FF;
        }

        .navContainer li {
            float: left;
        }

        .navContainer li a {
            /* display: flex; */
            display: inline-flex;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navContainer li a:hover {}

        .navContainer #logo {
            width: 30px;
        }
    </style>
</head>
<div class="navContainer">
    <nav>
        <ul>
            <li><a href="index.php"><img src="img/logo.png" id="logo"> Technic telephone</a></li>
            <li style="float:right"><a href="./Login/login-form.php">Login</a></li>
        </ul>
    </nav>
</div>