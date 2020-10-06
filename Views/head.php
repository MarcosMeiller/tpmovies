<?php namespace views;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoviePass</title>
    <meta name="author" content="NUÑEZ - GELLER">
    <meta name="description" content="TP MoviePass UTN 2020">
    <!--<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" 
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,600;1,500&display=swap" rel="stylesheet">-->
    <style>
        html,body{
            height: 100vh !important;
        }

        .logoWelcome{font-size: 75px !important;}

        @media (min-width: 640px) {
            .logoWelcome{font-size: 125px !important;}
        }

        @media (min-width: 768px) {
            .logoWelcome{font-size: 150px !important;}
        }

        @media (min-width: 1024) {
            .logoWelcome{font-size: 200px !important;}
        }

        .bgMovie{
            /* The image used */
            

            /* Full height */
            height: 100% !important;
            

            /* Center and scale the image nicely */
            background-position: center center !important;
            background-repeat: no-repeat !important;
            background-size: cover !important;
            background-attachment: fixed !important;   
        }
        .font-family-montSerrat { font-family: 'Montserrat', sans-serif; }
        .modal {
        transition: opacity 0.25s ease;
        }
        body.modal-active {
        overflow-x: hidden;
        overflow-y: visible !important;
        }


    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body class='w-screen h-screen font-family-montSerrat'>