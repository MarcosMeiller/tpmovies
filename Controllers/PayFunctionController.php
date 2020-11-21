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

        //$cardList = $this->daoCard->getCardsUser($iduser);

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
                $_SESSION['err'] = true;
                header("Location:".FRONT_ROOT."PayFunction/SelectSeat/".$idFunction);
            }
            $_SESSION['seats'] = $seats;
            $_SESSION['idFunction'] = $idFunction;
         
            $function = $this->daoF->searchFunction($idFunction);
            $room = $this->daoR->search($idRoom);
            $price = $room->getPrice();


            $total = $cantseats * $price;


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

                $this->sendMail();

            }else{
               echo 'no joya';
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

        if($date > $actualDate){
            return true;
        }
        else{
            return false;
        }

    }


    public function sendMail(){
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'tpvmovies@gmail.com';                     // SMTP username
            $mail->Password   = 'nunez123';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('from@gmail.com', 'TPMovies');
            $mail->addAddress('2014thekan@gmail.com', 'Joe User');     // Add a recipient Destino
            /*$mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');
            */

            // Attachments ENVIOS ARCHIVOS
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name


            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'COMPRA TICKET';
            $mail->Body    = 'che <b>comprado!</b>';
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Joya mail';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

}


?>