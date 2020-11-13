<?php 
namespace Dao;


use Models\CreditCard as CreditCard;
use Dao\Connection as Connection;
use PDOException;

class TicketDAO{
    private $connection;
    private $tableName = "creditcard";

	
    public function add(CreditCard $newCreditCard) {
        $query = "INSERT INTO ".$this->tableName." (dni, userCard,numberCard) VALUES ( :dni, :userCard ,:numberCard)";

     
        $parameters['dni'] = $newCreditCard->getDni();
        $parameters['userCard'] = $newCreditCard->getid_User();
        $parameters['numberCard'] = $newCreditCard->getNumberCard();
   
         

        try{
            
            $this->connection = Connection::GetInstance();

            return $this->connection->ExecuteNonQuery($query, $parameters);

        }catch(PDOException $ex){
            throw $ex;
        }
        
    }

	public function getAll(){

            $query = "SELECT * FROM ".$this->tableName;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);

            foreach($result as $row)
            {
                $CreditCard = new CreditCard($row["dni"],$row["userCard"],$row['numberCard']);
                $CreditCard->setId($row['idcreditcards']);
                array_push($CreditCardList, $CreditCard);
            }

		return $CreditCardList;
	}


	
	/*public function search($){
        $query = "SELECT *  FROM ".$this->tableName." WHERE (id_function = :id_function AND id_user = :id_user)";
        $newUser = null;
        $parameters["id_user"] =  $id_User;
        $parameters["id_function"] =  $id_Function;

        $this->connection = Connection::GetInstance();
        $array = $this->connection->Execute($query, $parameters);
        foreach($array as $newArray){
            if($newArray !== null){ 
                $ticket = new CreditCard($newArray["id_Function"],$newArray["id_User"],$newArray['seat']);
                $ticket->setId_Ticket($newArray['idtickets']);
         
            // id user  CHAR
            }
        }
        return $ticket;

		
    }
    */
   

	
  
}


?>