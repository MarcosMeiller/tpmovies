<?php 
namespace Dao;


use Models\Ticket as Ticket;
use Dao\Connection as Connection;
use PDOException;

class TicketDAO{
    private $connection;
    private $tableName = "tickets";

	
    public function add(Ticket $newTicket) {
        $query = "INSERT INTO ".$this->tableName." (id_function, id_user,seat) VALUES ( :id_function, :id_user, :seat)";

     
        $parameters['id_function'] = $newTicket->getid_Function();
        $parameters['id_user'] = $newTicket->getid_User();
        $parameters['seat'] = $newTicket->getSeat();
   
         

        try{
            
            $this->connection = Connection::GetInstance();

            return $this->connection->ExecuteNonQuery($query, $parameters);

        }catch(PDOException $ex){
            throw $ex;
        }
        
    }

	public function getAll(){

            $query = "SELECT idtickets, id_function, id_user FROM ".$this->tableName;

            $ticketList = array();
            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);

            foreach($result as $row)
            {
                $ticket = new Ticket($row["id_function"],$row["id_user"],$row['seat']);
                $ticket->setId_Ticket($row['idtickets']);
                array_push($ticketList, $ticket);
            }

		return $ticketList;
	}


	
	public function search($id_Function,$id_User){
        $query = "SELECT *  FROM ".$this->tableName." WHERE (id_function = :id_function AND id_user = :id_user)";
        $newUser = null;
        $parameters["id_user"] =  $id_User;
        $parameters["id_function"] =  $id_Function;

        $this->connection = Connection::GetInstance();
        $array = $this->connection->Execute($query, $parameters);
        foreach($array as $newArray){
            if($newArray !== null){ 
                $ticket = new Ticket($newArray["id_Function"],$newArray["id_User"],$newArray['seat']);
                $ticket->setId_Ticket($newArray['idtickets']);
         
            // id user  CHAR
            }
        }
        return $ticket;

		
    }
    
    public function getAllTicketForShow($id_Function){
        $query = "SELECT *  FROM ".$this->tableName." WHERE (id_function = :id_function)";
        $newUser = null;
        $array = array();
        $parameters["id_function"] =  $id_Function;

        $this->connection = Connection::GetInstance();
        $array = $this->connection->Execute($query, $parameters);
        foreach($array as $newArray){
            if($newArray !== null){ 
                $ticket = new Ticket($newArray["id_Function"],$newArray["id_User"],$newArray['seat']);
                $ticket->setId_Ticket($newArray['idtickets']);
                array_push($array,$ticket);
            // id user  CHAR
            }
        }
        return $array;
    }

    public function getAllInPesos(){
        $query = "SELECT idtickets, id_Function, id_User FROM ".$this->tableName;

        $this->connection = Connection::GetInstance();

        $result = $this->connection->Execute($query);
        $total = 0;
        foreach($result as $row)
        {
            $ticket = new Ticket($row["id_Function"],$row["id_User"],$row['seat']);
            $ticket->setId_Ticket($row['idtickets']);
            //$total += 
        }

    return $total;
    }


	
  
}


?>