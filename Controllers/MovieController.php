<?php namespace Controllers;

Use Models\Movie as Movie;
Use Dao\movieDAO as movieDAO;
Use Dao\GenreDAO as genreDAO;

class MovieController
{
    private $dao;

    function __construct(){
        $this->dao = new movieDAO(); 
        $this->gDao = new genreDAO();
    }
  

    public function addArrayMovie($array){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            foreach($array as $movie){
                $this->dao->add($movie);
            }
            if($movie == null){
                $this->ViewMovies("error al buscar la pelicula.");
            }
        }
    }

    /*public function addMovie($id,$id_Movie,$title,$genres_id,$duration,$overview,$poster_Path,$backdrop,$adult,$language,$original_language,$release_date){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $movie = $this->dao->search($id);
            if($movie !== null){
                $this->ViewMovies("La Pelicula ya existe.");
            }
            
            try{
                $newMovie = new Movie($id,$id_Movie,$title,$genres_id,$overview,$poster_Path,$backdrop,$adult,$language,$original_language,$release_date);
                $this->dao->add($newMovie);
                $this->ViewMovies("Agregado con exito");
            }catch(Exception $e){
                $this->ViewMovies("Error al Registrar Pelicula.");
            }
        }
    }

    public function updateMovie($id,$id_Movie,$title,$genres_id,$overview,$poster_Path,$backdrop,$adult,$language,$original_language,$release_date){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $cinema = $this->dao->search($id);
            if($cinema == null){
                $this->ViewMovies("La pelicula no existe.");
            }
            
            try{
                $newMovie = new Movie($id,$id_Movie,$title,$genres_id,$overview,$poster_Path,$backdrop,$adult,$language,$original_language,$release_date);
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
    */
    /*public function loadMovie(){
        llamar api
        $arrayMovies = array();
        foreach($arrayMovies as $movie){
            $name = $movie.name;
        }
       

    }*/

    public function getForGenre($genre){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $genreList = $this->dao->getForGenre($genre);
        }

    }
    
    public function VievMoviewsNowPlaying(){
        $genresList = $this->gDao->getAll();
        require_once(VIEWS_PATH."moviesnowp.php");
    }

    public function VievMoviewsListing(){
        $movieList = $this->dao->getAll();
        require_once(VIEWS_PATH."movieslistings.php");
    }


   /* public function ViewMoviewsAdmin($message = "")
    {
        $movieList = $this->dao->getAll();
        require_once(VIEWS_PATH_ADMIN."/movieslamb.php");
    }
    */        
}


?>