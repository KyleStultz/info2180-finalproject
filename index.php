<?php session_start(); ?>
<html>
    <!Doctype html>

    <head>
        <meta charset ="UTF-8"/>
        <meta name= "viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet"  href="styles/styles.css"/>
        <script src="scripts/login.js"> </script>
        <script src="scripts/UserLogout.js"> </script>
        <script src="scripts/home.js"> </script>
        <script src="scripts/newcontact.js"> </script>
        <script src="scripts/newnote.js"> </script>
        <script src="scripts/viewcontact.js"> </script>
        <script src="scripts/viewusers.js"> </script>
        <script src="scripts/newuser.js"> </script>
        <script src="scripts/updatecontact.js"> </script>
        <title>Dolphin CRM</title>
    </head>

    <body>
        <section id="flex-parent">

            <header>
                <img src="assets/dolphin.png"/> 
                <p id="logotitle">Dolphin CRM</p>
            </header>

            <div id="central">

                <aside class="hide">
                    <div class="menu"><button id="home"> <img src="assets/home.png"/> Home</button></div>
                    <div class="menu"><button id ="adduser"> <img src="assets/add-friend.png"/> Add User</button></div>
                    <div class="menu"><button id ="newcontact"> <img src="assets/new_contact.png"/> New Contact</button></div>
                    <div class="menu"><onlybutton id="viewusers"> <img src="assets/users.png"/>Users</button></div>
                    <hr>
                    <div class="menu"><button id="logout"> <img src="assets/logout.png"/>Logout</button></div>
                </aside>

                <section id="changearea"> 
                    <form id="login">
                        <h1 class="formtitle">Login</h2>
                        <div class="formstatus"> </div>
                        <div class="formgrp"> 
                            <input class="inputnormal" type="email" placeholder="Email address" name="email" required>
                        </div>
                        <div class="formgrp"> 
                            <input class="inputnormal" type="password" placeholder="Password" name="password" required>
                        </div>
                        <button type= "submit" name="submitbtn" id="submitbtn"> <img src="assets/lock.png"/> <span> Login </span></button>
                    </form> 
                </section>

                <footer id="footer">
                    <hr>
                    <p>Copyright &copy; 2022 Dolphin CRM</p>
                </footer>
            </div>
        </section>
    </body>

</html>