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

    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@300;500&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz:wght@300;500&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@300;500&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;400;600&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link href='<?php echo FRONT_ROOT.VIEWS_PATH ?>css/card.css' rel='stylesheet'>


<!-- toastr -->
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/imask/3.4.0/imask.min.js'></script>
<script type="text/javascript" src='<?php echo FRONT_ROOT.VIEWS_PATH ?>js/card.js'></script>

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
        .font-family-hind { font-family: 'Hind'}
        .font-family-yanone { font-family: 'Yanone Kaffeesatz'}
        .font-family-Teko { font-family: 'Teko'}
        .font-family-dosis { font-family: 'Dosis', sans-serif; }

        /*.modal {
            transition: opacity 0.25s ease !important;
        }
        .modal-active {
            overflow-x: hidden !important;
            overflow-y: visible !important;
        }*/

        .text-description{
            min-height: 6rem !important;
            max-height: 9rem !important;
        }
        
            ::-webkit-scrollbar-track {
      background-color: rgba(0, 0, 0, 0.2);
}
        

    </style>
</head>
<body class='w-screen h-screen font-family-dosis text-md'>