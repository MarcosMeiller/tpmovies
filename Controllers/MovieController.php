<?php namespace Controllers;

Use Models\Movie as Movie;
Use Dao\movieDAO as movieDAO;

class MovieController
{
    private $dao;

    function __construct(){
        $this->dao = new movieDAO(); 
    }
  

    public function addMovie($id,$name,$genre,$duration,$direct,$description){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $movie = $this->dao->search($id);
            if($movie !== null){
                $this->ViewMovies("La Pelicula ya existe.");
            }
            
            try{
                $newMovie = new Movie($id,$name,$genre,$duration,$direct,$description);
                $this->dao->add($newMovie);
                $this->ViewMovies("Agregado con exito");
            }catch(Exception $e){
                $this->ViewMovies("Error al Registrar Pelicula.");
            }
        }
    }

    public function updateMovie($id,$name,$genre,$duration,$direct,$description){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $cinema = $this->dao->search($id);
            if($cinema == null){
                $this->ViewMovies("La pelicula no existe.");
            }
            
            try{
                $newMovie = new Movie($id,$name,$genre,$duration,$direct,$description);
                $this->dao->update($newMovie);
                $this->ViewMovies("Modificado con exito");
            }catch(Exception $e){
                $this->ViewMovies("Error al modificar pelicula.");
            }
        }
    }

    public function deleteMovies($id){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $movie = $this->dao->search($id);
            if($movie == null){
                $this->ViewMovies("La Pelicula no existe.");
            }
            
            try{
                $this->dao->delete($id);
                $this->ViewMovies("eliminado con exito");
            }catch(Exception $e){
                $this->ViewMovies("Error al eliminar Pelicula.");
            }
        }
    }
    
    public function loadMovie(){
        ///llamar api
        /*$arrayMovies = array();
        foreach($arrayMovies as $movie){
            $name = $movie.name;
        }
        */

    }

    public function ViewPeliculas($message = "")
    {
        $cinemasList = $this->dao->getAll();
        require_once(VIEWS_PATH_ADMIN."/movieslamb.php");
    }        
}


?>