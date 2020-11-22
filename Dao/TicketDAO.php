<?php 
namespace Dao;


use Models\Ticket as Ticket;
use Dao\Connection as Connection;
use PDOException;

class TicketDAO{
    private $connection;
    private $tableName = "tickets";

	
    public function add(Ticket $newTicket){
        $query = "INSERT INTO ".$this->tableName." (id_function, id_user,seat) VALUES ( :id_function, :id_user, :seat)";

     
        $parameters['id_function'] = $newTicket->getid_Function();
        $parameters['id_user'] = $newTicket->getid_User();
        $parameters['seat'] = $newTicket->getSeat();
   
         

        try{
            
            $this->connection = Connection::GetInstance();

            return $this->connection->ExecuteNonQuery($query, $parameters); // PROBAR CON EXECUTE

        }catch(PDOException $ex){
            throw $ex;
        }
        
    }

    public function obtainLastId(){
      $query = " select *
      from ".$this->tableName." order by idtickets desc
      limit 1;";
      $this->connection = Connection::GetInstance();

      $result = $this->connection->Execute($query);
      return $result[0]["idtickets"];
    }

	public function getAll(){

            $query = "SELECT idtickets, id_function, id_user, seat FROM ".$this->tableName;

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
    
    public function addTicketXmovie($idticket,$idmovie,$idcinema,$date,$price,$idfunction){
        $query = "INSERT INTO ticketxmovie (id_tickets,id_function,id_movie, id_cinema,price,date) VALUES (:id_tickets,:id_function,:id_movie,:id_cinema,:price,:date)";
        $parameters['id_function'] = $idfunction;
        $parameters['id_tickets'] = $idticket;
        $parameters['id_movie'] = $idmovie;
        $parameters['id_cinema'] = $idcinema;
        $parameters['price'] = $price;
        $parameters['date'] = $date;
        

        try{
            
            $this->connection = Connection::GetInstance();

            return $this->connection->ExecuteNonQuery($query, $parameters);

        }catch(PDOException $ex){
            throw $ex;
        }

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
                $ticket = new Ticket($newArray["id_function"],$newArray["id_user"],$newArray['seat']);
                $ticket->setId_Ticket($newArray['idtickets']);
                array_push($array,$ticket);
            // id user  CHAR
            }
        }
        return $array;
    }

    public function getAllInPesos(){
        $query = "SELECT idtickets, id_movie, id_cinema,price,date FROM ticketxmovies";

        $this->connection = Connection::GetInstance();

        $result = $this->connection->Execute($query);
        $total = 0;
        foreach($result as $row)
        {
           $total += $row['price'];
        }

    return $total;
    }

    public function getAllInPesosForMovie($idmovie){
        $query = "SELECT * FROM ticketxmovies WHERE (id_movie = :id_movie)";

        $this->connection = Connection::GetInstance();
        $parameters['id_movie'] = $idmovie;
        $result = $this->connection->Execute($query,$parameters);
        $total = 0;
        foreach($result as $row)
        {
           $total += $row['price'];
        }

    return $total;
    }

    public function getAllInPesosForCinema($id_cinema){
        $query = "SELECT * FROM ticketxmovies WHERE (id_cinema = :id_cinema)";

        $this->connection = Connection::GetInstance();
        $parameters['id_cinema'] = $id_cinema;
        $result = $this->connection->Execute($query,$parameters);
        $total = 0;
        foreach($result as $row)
        {
           $total += $row['price'];
        }

    return $total;
    }

    public function getAllInPesosForCinemaOrMovie($id_movie, $id_cinema){
        $query = "SELECT * FROM ticketxmovies WHERE (id_cinema = :id_cinema) AND (id_movie = :id_movie)";

        $this->connection = Connection::GetInstance();
        $parameters['id_cinema'] = $id_cinema;
        $parameters['id_movie'] = $id_movie;
        $result = $this->connection->Execute($query,$parameters);
        $total = 0;
        foreach($result as $row)
        {
           $total += $row['price'];
        }

    return $total;
    }

    public function getAllInPesosForDates($date1, $date2){//mandar las fechas con tipo datetime();
        $query = "SELECT * FROM ticketxmovies WHERE (date >= :date1) AND (date <= :date2)";

        $this->connection = Connection::GetInstance();
        $parameters['date1'] = $date1;
        $parameters['date2'] = $date2;
        $result = $this->connection->Execute($query,$parameters);
        $total = 0;
        foreach($result as $row)
        {
           $total += $row['price'];
        }

    return $total;
    }
    
    public function SearchFunctionIfTicket($id_Function){
        $query = "SELECT * FROM ".$this->tableName."WHERE (id_function = :id_function)";
        $quantity = 0;
        $this->connection = Connection::GetInstance();
        $parameters['id_function'] = $id_Function;
        $result = $this->connection->Execute($query,$parameters);
        $total = 0;
        if($result){
            $quantity = count($result);     
        }

        return  $quantity;
    }

   


}

    

	
  



?>