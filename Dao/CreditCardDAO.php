<?php 
namespace Dao;


use Models\CreditCard as CreditCard;
use Dao\Connection as Connection;
use Exception;
use PDOException;

class TicketDAO{
    private $connection;
    private $tableName = "creditcard";

	
    public function add(CreditCard $newCreditCard) {
        $query = "INSERT INTO ".$this->tableName." (dni, usercard,numbercard,dateexpired,codesecurity,holdername) VALUES ( :dni, :usercard ,:numbercard,:dateexpired,:codesecurity,holdername)";

     
        $parameters['dni'] = $newCreditCard->getDni();
        $parameters['usercard'] = $newCreditCard->getid_User();
        $parameters['numbercard'] = $newCreditCard->getNumberCard();
        $parameters['dateexpired'] = $newCreditCard->getDateExpired();
        $parameters['codesecurity'] = $newCreditCard->getCodeSecurity();
        $parameters['holdername'] = $newCreditCard->getName();
         

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
                $CreditCard = new CreditCard($row["dni"],$row["usercard"],$row['numbercard'],$row["usercard"],$row['dateexpired'],,$row['holdername']);
                $CreditCard->setId($row['codesecurity']);
                array_push($CreditCardList, $CreditCard);
            }

		return $CreditCardList;
	}

    public function getAllByUser($usercard){
        $query = "SELECT * FROM ".$this->tableName."WHERE (usercard = :usercard)";
        try{ 
            $this->connection = Connection::GetInstance();

            $parameters['usercard'] = $usercard;

            $result = $this->connection->Execute($query,$parameters);

            foreach($result as $row)
            {
                $CreditCard = new CreditCard($row["dni"],$row["usercard"],$row['numbercard'],$row["usercard"],$row['dateexpired'],$row['holdername']);
                $CreditCard->setId($row['codesecurity']);
                array_push($CreditCardList, $CreditCard);
            }

            return $CreditCardList;
    }
        catch(PDOException $ex){
            return $ex;
        }

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