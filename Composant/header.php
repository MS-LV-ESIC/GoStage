<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/5d4f51e2a9.js" crossorigin="anonymous"></script>
</head>

<body>
    <style>
        * {
            padding: 0;
            margin: 0;
            font-family: "Nunito", sans-serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
        }

        header {
            background-color: rgba(0, 76, 170, 1);
            display: flex;
            position: sticky;
            top: 0;
            justify-content: space-between;
            align-items: center;
        }

        .header-icon {
            display: flex;
            gap: 50px;
            margin-right: 50px;
        }

        .btn {
            background-color: transparent;
            border: none;
            cursor: pointer;
            padding: 10px;
        }

        .btn i {
            color: white;
            font-size: 190%;
        }

        .dropbtn {
            background-color: rgba(0, 76, 170, 1);
            color: white;
            font-size: 190%;
            border: none;
            cursor: pointer;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            right: 0;
            display: none;
            position: absolute;
            background-color: rgba(0, 76, 170, 1);
            min-width: 160px;
            z-index: 1;
        }

        .dropdown-content a {
            color: white;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color:rgb(52, 106, 213);
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: rgba(0, 76, 170, 1) ;
        }
    </style>
    <header>
        <div class="header-logo">
            <img src="/GoStage/composant/LogoPrincipale.png" alt="" width="100px">
        </div>
        <div class="header-icon">
            <a href=""><button class="btn"><i class="fa-regular fa-bell"></i></button></a>
            <a href="offres.php"><button class="btn"><i class="fa-solid fa-magnifying-glass"></i></button></a>
            <div class="dropdown">
                <button class="dropbtn"><i class="fa-solid fa-user"></i></button>
                <div class="dropdown-content">
                    <a href="profil.php">Profil</a>
                    <a href="logout.php">Déconnexion</a>
                </div>
            </div>
        </div>
    </header>
</body>

</html>