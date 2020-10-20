<?php namespace Controllers;

Use Models\Genre as Genre;
Use Dao\GenreDAO as GenreDAO;

class GenreControler
{
    private $dao;

    function __construct(){
        $this->dao = new GenreDAO(); 
    }

    public function addGenre($id,$genre){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $controller = $this->dao->search($id);
            if($controller !== null){
                $this->ViewGenre("El Genero ya existe.","alert");
            }
            
            try{
                $newGenre = new Genre($id,$genre);
                $this->dao->add($newGenre);
                $this->ViewGenre("Agregado con exito","success");
            }catch(Exception $e){
                $this->ViewGenre("Error al Registrar Genero.","danger");
            }
        }
    }

    /*public function ControlListGenre(){
        $genres = $this->dao->getAll();
        if(count($genres) === 0){
            $this->dao->retrieveDataFromAPI();
        }
    }*/

    public function deleteGenre($id){
           
            $genre = $this->dao->search($id);
            if($genre === null){
                $this->Cinemas("El Genero no existe.","alert");
            }
            
            try{
             
                $this->dao->delete($id);
                $this->ViewGenre("Eliminado con exito","success");
            }catch(Exception $e){
           
                $this->ViewGenre("Error al eliminar Genero.","danger");
            }

    }


    
}



?>