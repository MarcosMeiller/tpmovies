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
        //if ($_SERVER["REQUEST_METHOD"] == "POST") {
           
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
        //}
    }

    public function moviesForGenre($genreString){///mas o menos lo adapte para recibir un string de generos sin separar y te devuelve una lista de peliculas con sus generos, aunque quizas deberiamos traer el array de peliculas para buscarlos.
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $array =  explode(',',$genreString);
            $this->dao->getForGenre($array);
            if($movie == null){
                $this->ViewMovies("Error al agregar la lista");
            }
        

    }
}

    /*public function ViewGenre($message = "")
    {
        $genreList = $this->dao->getAll();
        if($message === '' && $type === ''){
            //unset($_SESSION['msjCinemas']);
            //unset($_SESSION["bgMsgCinemas"]);
            //require_once(VIEWS_PATH_ADMIN."/cinemaslamb.php");
        }else{
            //$_SESSION['msjCinemas'] = $message;
            //$_SESSION["bgMsgCinemas"] = $type;
            //header("Location: /tpmovies/Cinema/ViewCinemas/"); ponele la ruta cuando la crees carlos
        }
    } */    
    
}



?>