<?php namespace Controllers;

Use Models\Movie as Movie;
Use Dao\MovieDAO as movieDAO;
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

   // agregar movie a la admin
   public function addMoviexAdmin($idmovie){
       
       $idmoviedb = $this->dao->getMovieFromAPI($idmovie); // se fija si esta en la db cargado y sino lo buscar en la api y lo guarda en db
       $user = $_SESSION['loggedUser'];
       $id = $user->getId();
       $this->dao->addMoviexAdmin($id,$idmoviedb); // agrega en moviexadmin
       $adminmovies = $this->dao->getMoviexAdmin($id);
       $this->MoviesNowPlaying();
   }

   public function deleteMoviexAdmin($idmoviesxadmin){


        $this->dao->deleteMovieforAdmin($idmoviesxadmin);

        $user = $_SESSION['loggedUser'];
        $id = $user->getId();
        $adminmovies = $this->dao->getMoviexAdmin($id);
        $this->MoviesNowPlaying();
   }


    public function DetailsMovie($id){
        $genresList = $this->gDao->getAll();
        $movie = $this->dao->searchMovieID($id);
        require_once(VIEWS_PATH."detailsMovie.php");
    }

    public function getForGenre($genre){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $genreList = $this->dao->getForGenre($genre);
        }

    }
    
    public function MoviesNowPlaying($id = 0){

       // $this->gDao->retrieveDataFromAPI();        

        if(isset($_SESSION['loggedUser'])){          
            unset($_SESSION['id']);

            $user = $_SESSION['loggedUser'];
            $id = $user->getId();

            $genresList = $this->gDao->getAll();
            $moviesList = $this->dao->retriveMoviexAdmin();
            $adminmovies = $this->dao->getMoviexAdmin($id);

            require_once(VIEWS_PATH_ADMIN."/moviesnowplaying.php");             
        }else{
            header("Location: ".FRONT_ROOT);
        }
    }

    public function MoviesAdmin(){
        // MARCOS
        // traer todas las movies de una tabla que sea MovieXadmin
        // y traer todas las movies de la api parecido a retrieveDataFromAPI 
        // que esta en el movieDAO
        // guardar esas 2 lista y redirigir a la pantalla de movieadmin (que falta hacer)
    }

    public function MoviesNowPByGenre($id){
        if(isset($_SESSION['loggedUser'])){  
            $_SESSION['id'] = $id;
            $genresList = $this->gDao->getAll();
            $moviesList = $this->dao->getAll($id);
            require_once(VIEWS_PATH."moviesnowp.php");
        }else{
            header("Location: ".FRONT_ROOT);
        }
    }


 
}


?>