<?php namespace Controllers;


//Use Models\Room as Room;
Use Dao\RoomDAO as RoomDao;
//Use Models\Movie as Movie;
//Use Dao\MovieDAO as movieDAO;
//use Models\FunctionCinema as FunctionCinema;
Use Dao\FunctionCinemaDAO as FunctionCinemaDAO;
//Use Dao\CinemaDAO as cinemaDAO;
//use Models\Cinema as Cinema;
Use Models\CreditCard as CreditCard;
use Dao\TicketDAO as ticketDAO;
use Dao\CreditCardDAO as CreditCardDAO;
use DateTime;
use models\Ticket;

// phpMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//require_once FRONT_ROOT.'fpdf182/fpdp.php';

class PayFunctionController
{
    private $daoF;
    private $daoR;
    private $daoT;
    private $daoC;
  

    public function __construct(){
        $this->daoF = new FunctionCinemaDAO();
        $this->daoR = new RoomDao();
        $this->daoT = new ticketDAO();
        $this->daoC = new CreditCardDAO();
        //require_once('fpdf182/fpdf.php');

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

                if($val1 && $val2 && $val3){
                                    
                    $idUser = $_SESSION['loggedUser'];
                    $creditCard = new CreditCard($idUser->getId(),$card,$dateexp,$code,$name);
                    $seats = $_SESSION['seats'];
                    foreach($seats as $seat){
                        $ticket = new Ticket($_SESSION['idFunction'],$idUser->getId(),$seat);
                        $this->daoT->add($ticket);
                    }
                    $this->daoC->add($creditCard);
                    $idFunction = $_SESSION['idFunction'];
                    $function = $this->daoF->searchFunction($idFunction);
                    $idRoom = $_SESSION['idRoom'];
                    $room = $this->daoR->search($idRoom);
                
                    require_once(VIEWS_PATH."successbuy.php");
                    $this->sendMail($creditCard,$seats,$idUser,$function,$room);
                
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

        //$pdf = $this->ticketPDF();

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
            //$mail->addAttachment($pdf, 'ComprobanteTPMOVIES.jpg');    // Optional name

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

    public function ticketPDF(){
        define('EURO',chr(128));
        $pdf = new FPDF('P','mm',array(80,150));
        $pdf->AddPage();
        
        // CABECERA
        $pdf->SetFont('Helvetica','',12);
        $pdf->Cell(60,4,'TPMovies',0,1,'C');
        $pdf->SetFont('Helvetica','',8);
        $pdf->Cell(60,4,'C.I.F.: 01234567A',0,1,'C');
        $pdf->Cell(60,4,'C/ Arturo Soria, 1',0,1,'C');
        $pdf->Cell(60,4,'C.P.: 28028 Madrid (Madrid)',0,1,'C');
        $pdf->Cell(60,4,'999 888 777',0,1,'C');
        $pdf->Cell(60,4,'alfredo@lacodigoteca.com',0,1,'C');
        
        // DATOS FACTURA        
        $pdf->Ln(5);
        $pdf->Cell(60,4,'Factura Simpl.: F2019-000001',0,1,'');
        $pdf->Cell(60,4,'Fecha: 28/10/2019',0,1,'');
        $pdf->Cell(60,4,'Metodo de pago: Tarjeta',0,1,'');
        
        // COLUMNAS
        $pdf->SetFont('Helvetica', 'B', 7);
        $pdf->Cell(30, 10, 'Articulo', 0);
        $pdf->Cell(5, 10, 'Ud',0,0,'R');
        $pdf->Cell(10, 10, 'Precio',0,0,'R');
        $pdf->Cell(15, 10, 'Total',0,0,'R');
        $pdf->Ln(8);
        $pdf->Cell(60,0,'','T');
        $pdf->Ln(0);
        
        // PRODUCTOS
        $pdf->SetFont('Helvetica', '', 7);
        $pdf->MultiCell(30,4,'Manzana golden 1Kg',0,'L'); 
        $pdf->Cell(35, -5, '2',0,0,'R');
        $pdf->Cell(10, -5, number_format(round(3,2), 2, ',', ' ').EURO,0,0,'R');
        $pdf->Cell(15, -5, number_format(round(2*3,2), 2, ',', ' ').EURO,0,0,'R');
        $pdf->Ln(3);
        $pdf->MultiCell(30,4,'Malla naranjas 3Kg',0,'L'); 
        $pdf->Cell(35, -5, '1',0,0,'R');
        $pdf->Cell(10, -5, number_format(round(1.25,2), 2, ',', ' ').EURO,0,0,'R');
        $pdf->Cell(15, -5, number_format(round(1.25,2), 2, ',', ' ').EURO,0,0,'R');
        $pdf->Ln(3);
        $pdf->MultiCell(30,4,'Uvas',0,'L'); 
        $pdf->Cell(35, -5, '5',0,0,'R');
        $pdf->Cell(10, -5, number_format(round(1,2), 2, ',', ' ').EURO,0,0,'R');
        $pdf->Cell(15, -5, number_format(round(1*5,2), 2, ',', ' ').EURO,0,0,'R');
        $pdf->Ln(3);
        
        // SUMATORIO DE LOS PRODUCTOS Y EL IVA
        $pdf->Ln(6);
        $pdf->Cell(60,0,'','T');
        $pdf->Ln(2);    
        $pdf->Cell(25, 10, 'TOTAL SIN I.V.A.', 0);    
        $pdf->Cell(20, 10, '', 0);
        $pdf->Cell(15, 10, number_format(round((round(12.25,2)/1.21),2), 2, ',', ' ').EURO,0,0,'R');
        $pdf->Ln(3);    
        $pdf->Cell(25, 10, 'I.V.A. 21%', 0);    
        $pdf->Cell(20, 10, '', 0);
        $pdf->Cell(15, 10, number_format(round((round(12.25,2)),2)-round((round(2*3,2)/1.21),2), 2, ',', ' ').EURO,0,0,'R');
        $pdf->Ln(3);    
        $pdf->Cell(25, 10, 'TOTAL', 0);    
        $pdf->Cell(20, 10, '', 0);
        $pdf->Cell(15, 10, number_format(round(12.25,2), 2, ',', ' ').EURO,0,0,'R');
        
        // PIE DE PAGINA
        $pdf->Ln(10);
        $pdf->Cell(60,0,'EL PERIODO DE DEVOLUCIONES',0,1,'C');
        $pdf->Ln(3);
        $pdf->Cell(60,0,'CADUCA EL DIA  01/11/2019',0,1,'C');
        
        return $pdf->Output('ticket.pdf','i');
    }

}


?>