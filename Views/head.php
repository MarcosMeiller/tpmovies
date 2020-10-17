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

    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet" type="text/css" />

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,600;1,500&display=swap" rel="stylesheet"/>    

<!-- toastr -->
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

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
            /*height: 100% !important;*/
            /* Center and scale the image nicely */
            background-position: center center !important;
            background-repeat: no-repeat !important;
            background-size: cover !important;
            background-attachment: fixed !important;   
        }
        .font-family-montSerrat { font-family: 'Montserrat', sans-serif; }

        /*.modal {
            transition: opacity 0.25s ease !important;
        }
        .modal-active {
            overflow-x: hidden !important;
            overflow-y: visible !important;
        }*/


    </style>
</head>
<body class='w-screen h-screen font-family-montSerrat'>