<?php namespace Controllers;


//Use Models\Room as Room;
Use Dao\RoomDAO as RoomDao;
Use Models\Movie as Movie;
Use Dao\MovieDAO as MovieDAO;
//use Models\FunctionCinema as FunctionCinema;
Use Dao\FunctionCinemaDAO as FunctionCinemaDAO;
Use Dao\CinemaDAO as CinemaDAO;
use Models\Cinema as Cinema;
Use Models\CreditCard as CreditCard;
use Dao\TicketDAO as ticketDAO;
use Dao\CreditCardDAO as CreditCardDAO;
use DateTime;
use models\Ticket;

// phpMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('fpdf182/fpdf.php');

use FPDF;

class PayFunctionController
{
    private $daoF;
    private $daoR;
    private $daoT;
    private $daoC;
    private $daoM;
    private $daoCi;
    //private $pdf;
  

    public function __construct(){
        $this->daoF = new FunctionCinemaDAO();
        $this->daoR = new RoomDao();
        $this->daoT = new ticketDAO();
        $this->daoC = new CreditCardDAO(); 
        $this->daoM = new MovieDAO();
        $this->daoCi = new CinemaDAO();
        //$this->pdf = new FPDF('P','mm',array(80,150));

    }
    
    public function Index($message = "", $type="",$id = 0)
    {
        if(!isset($_SESSION["loggedUser"])){
            $url = $_SESSION['url'];
            $_SESSION['bg'] = 1;
            require_once(VIEWS_PATH."login.php");
            //header("Location:".FRONT_ROOT."Login");
        }else{
            $this->SelectSeat();            
        }    
    }
    
    public function SelectSeat($idFunction){
        $function = $this->daoF->searchFunction($idFunction);

        $ticketsList = $this->daoT->getAll();
        $roomList = $this->daoR->getAll();

        $user = $_SESSION['loggedUser'];
        $iduser = $user->getId();
        if(!isset($_SESSION['cantseats'])){
            $_SESSION['cantseats'] = -1;
        }

        require_once(VIEWS_PATH."getTicket.php");
    }

    public function Checkout($message = '', $type=""){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $seats = array();

            $seats = $_POST['seats'];
            $idFunction = $_POST['idFunction'];
            $idRoom = $_POST['idRoom'];
            $cantseats = (count($seats));

            if($cantseats == 0 ){
                $_SESSION['cantseats'] = 0;
                header("Location:".FRONT_ROOT."PayFunction/SelectSeat/".$idFunction);
            }

            $_SESSION['seats'] = $seats;
            $_SESSION['idFunction'] = $idFunction;
            $_SESSION['idRoom'] = $idRoom;

            $function = $this->daoF->searchFunction($idFunction);
            $room = $this->daoR->search($idRoom);
            $price = $room->getPrice();


            $total = $cantseats * $price;
            $_SESSION['total'] = $total;


            require_once(VIEWS_PATH."checkout.php");
        }
    }




    public function validateDate($date){
        $fechaExpiracion = date($date); 
        $fechaActual = date("Y-m-d");
        if($fechaExpiracion <= $fechaActual){
            return false;
        }
        else{
            return true;
        }   
    }

    public function payTicket(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
            $name =$_POST['name'];
            $card = $_POST['cardnumber'];
            $dateexp = $_POST['expirationdate'];
            $code = $_POST['securitycode'];

            if($name || $card || $dateexp || $code){

                $val1 = $this->validate_Date_CreditCard($dateexp);
                $val2 = $this->validate_number_lenght($card,16);
                $val3 = $this->validate_number_lenght($code,3);
                       //$idticket,$idmovie,$idcinema,$date,$price
           
                if($val1 && $val2 && $val3){
                    $function = $this->daoF->searchFunction($_SESSION['idFunction']);
                    $idmovie = $function->getId_Movie();
                    $room = $this->daoR->search($function->getId_Room());
                    $price = $room->getPrice();
                    $idcinema = $room->getId_Cinema();
                    $date = date('Y-m-d');
                    $idticket = 0;                
                    $idUser = $_SESSION['loggedUser'];
                    $creditCard = new CreditCard($idUser->getId(),$card,$dateexp,$code,$name);
                    $seats = $_SESSION['seats'];
                    foreach($seats as $seat){
                        $ticket = new Ticket($_SESSION['idFunction'],$idUser->getId(),$seat);
                        $this->daoT->add($ticket);
                        $idticket = $this->daoT->obtainLastId();
                        $this->daoT->addTicketXmovie($idticket,$idmovie,$idcinema,$date,$price,$_SESSION['idFunction']);
                        
                    }
                    
                    $this->daoC->add($creditCard);
                    $idFunction = $_SESSION['idFunction'];
                    $function = $this->daoF->searchFunction($idFunction);
                    $idRoom = $_SESSION['idRoom'];
                    $room = $this->daoR->search($idRoom);
                
                    $this->sendMail($creditCard,$seats,$idUser,$function,$room);
                    require_once(VIEWS_PATH."successbuy.php");
                
                }else{
                $_SESSION["msjError"] = 'Hubo un error al validar los datos. Verifique de ingresarlos correctamente.';
                require_once(VIEWS_PATH."checkout.php");
                }
               
            }else{
                $_SESSION["msjError"] = 'Hay datos incompletos';
               require_once(VIEWS_PATH."checkout.php");
            }

            
        
        } 
    }

    public function validate_number_lenght($number=0, $lenght=0){// es para validar que la tarjeta tiene una cantidad valida de numeros de tarjeta

        $number = str_replace(" ","", $number);
    

        if( is_numeric($number) AND is_numeric($lenght) AND (strlen($number)==$lenght)){
            return true;
        }else{
            return false;
        }
    
    }

    public function validate_Date_CreditCard($date){
        $date = date($date);
        $actualDate = date('m/y');
        $fechaActual = explode("/", $actualDate);
        $fechaNueva = explode("/", $date);
        if($fechaActual[1] == $fechaNueva[1]){
            if((int)$fechaActual[0] < (int)$fechaNueva[0]){
                return true;
            }
            else{
                return false;
            }
        }
        if((int)$fechaActual[1] > (int)$fechaNueva[1]){
            return false;
        }
        else{
            return true;
        }

     

    }


    public function sendMail($creditCard,$seats,$User,$function,$room){
        $mail = new PHPMailer(true);

        $price = $room->getPrice();
        $movie = $this->daoM->searchIdBdd($function->getId_Movie());
        $cinema = $this->daoCi->searchInBdd($room->getId_Cinema());

        $pdf = $this->ticketPDF($seats,$room,$function,$movie,$cinema);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'tpvmovies@gmail.com';                     // SMTP username
            $mail->Password   = 'nunez123';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('from@gmail.com', 'TPMovies');
            $mail->addAddress($User->getEmail(), $User->getName());     // Add a recipient Destino
            /*$mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');
            */

            // Attachments ENVIOS ARCHIVOS
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            
            $mail->addStringAttachment($pdf, 'ComprobanteTPMOVIES.pdf', 'base64', 'application/pdf');    // Optional name

            //$separado_por_comas = implode(",", $seats);

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'COMPRA EXITOSA DE ENTRADA/S';
            $message = '<html><head>
            <meta charset="UTF-8">
          </head><body>';
            $message .= '<h2>Gracias por su compra '.$creditCard->getName().' </h2><br>';
            $message .= '<h>Su realizo con exito la compra de '.count($seats).' entrada/s </h3>';
            $message .= '</body></html>';

            //$mail->Body    = 'Usted ha <b>comprado</b> '.count($seats)."Tickets "." Con la cuenta de ".$creditCard->getName()." En la sala: ".$room->getName()."  al precio de : ".$room->getPrice()." c/u  sus asientos son: ".$separado_por_comas.".";
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->Body = $message;

            $mail->send();

            //unlink($pdf);
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function ticketPDF($seats,$room,$function,$movie,$cinema){
        $hoy = date('Y-m-d');
        $price = $room->getPrice();
        $theroom = $room->getName();
        $cantSeats = count($seats);
        $total = $price * $cantSeats;
        $seatsSeparados = implode(",", $seats);

        define('EURO',chr(128));
        ob_start();
        $pdf = new FPDF('P','mm',array(80,150));   
        $pdf->AliasNbPages();
        $pdf->AddPage();

        // CABECERA
        $pdf->SetFont('Helvetica','',12);
        $pdf->Cell(60,4,'TPMovies',0,1,'C');
        
        $pdf->Ln(2);
        $pdf->SetFont('Helvetica','',8);
        $pdf->Cell(60,4,'Comprobante de Entrada Moviepass',0,1,'C');
        $pdf->Cell(60,4,'TODO ESTO ES DE MENTIRA, PURA FICCION xD',0,1,'C');
        
        
        $pdf->Ln(5);
        $pdf->Cell(60,4,'Factura Simpl.: xxx-xxxx-000',0,1,'');
        $pdf->Cell(60,4,'Fecha: '.$hoy,0,1,'');
        $pdf->Cell(60,4,'Metodo de pago: Tarjeta',0,1,'');

        
        // DETALLE FUNCION
        $pdf->Ln(5);
        $pdf->SetFont('Helvetica', 'B', 7);
        $pdf->Cell(60,4,'Datos de la funcion',0,1,'');
        $pdf->Ln(2);
        $pdf->Cell(60,0,'','T');
        $pdf->Ln(2);

        $pdf->SetFont('Helvetica', '', 7);
        $pdf->Cell(60,4,'CINE: '.$cinema->getName(),0,1,'');
        $pdf->Cell(60,4,'PELICULA: '.$movie->getTitle(),0,1,'');
        $pdf->Cell(60,4,'SALA: '.$theroom,0,1,'');
        $pdf->Cell(60,4,'BUTACAS: '.$seatsSeparados,0,1,'');
        $pdf->Cell(60,4,'FECHA: '.$function->getDate(),0,1,'');
        $pdf->Cell(60,4,'HORA: '.$function->getHour(),0,1,'');

      
        // TOTAL
        $pdf->Ln(3);
        $pdf->Cell(60,0,'','T');
        $pdf->Ln(2);    
        $pdf->Cell(25, 10, 'Precio por entrada', 0);    
        $pdf->Cell(20, 10, '', 0);
        $pdf->Cell(15, 10, '$'.$room->getPrice(),0,0,'R');
        $pdf->Ln(3);    
  
        $pdf->Cell(25, 10, 'Total pagado por '.$cantSeats.' entrada/s', 0);    
        $pdf->Cell(20, 10, '', 0);
        $pdf->Cell(15, 10, '$'.$total ,0,0,'R');
        
        // PIE DE PAGINA

        $pdf->Ln(10);
        $pdf->Cell(60,0,'ESTE QR DEBERA PRESENTAR EN EL CINE',0,1,'C');
        $pdf->Ln(15);
        $pdf->Image('Views/img/qrcode.jpeg',28,100,25);
        $pdf->Ln(14);
        $pdf->Cell(60,4,'Gracias por su compra',0,1,'C');
        
        ob_end_clean();
        $thepdf = $pdf->Output('S');

        return $thepdf;
    }


}


?>