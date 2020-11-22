<?php 

namespace Controllers;

Use Models\Room as Room;
Use Dao\RoomDAO as RoomDao;
Use Models\Movie as Movie;
Use Dao\MovieDAO as movieDAO;
use Models\FunctionCinema as FunctionCinema;
Use Dao\FunctionCinemaDAO as FunctionCinemaDAO;
Use Models\Cinema as Cinema;
Use Dao\CinemaDAO as cinemaDAO;
Use Dao\GenreDAO as GenreDAO;
use Exception;

class ShowtimesController{
    private $dao;
    private $daoR;
    private $daoM; 
    private $daoG;

    public function __construct(){
        $this->dao = new FunctionCinemaDAO();
        $this->daoR = new RoomDao();
        $this->daoM = new movieDAO();
        $this->daoC = new cinemaDAO(); 
        $this->daoG = new GenreDAO();

    }

    public function dateFilter($date){
        
        $functionsList = $this->dao->FilterListForDate($date);
        if($date){ 
        $idmovies = array();
        foreach($functionsList as $function){
            $idmovies[] = $function->getId_Movie();
        }

        $idsmovies = array_unique($idmovies);

        $arrayGenresandMovie= array();
        foreach($idmovies as $id){
            $arrayGenresandMovie[] = $this->daoM->getGenresofMovie($id);  
        }   

        $genresandmovies = [];
        foreach($arrayGenresandMovie as $genrexmovie){
            array_push($genresandmovies,$genrexmovie); 
        }


        $arraygenres = array_unique($arrayGenresandMovie,SORT_REGULAR);



        $_SESSION['date'] = $date;


        //header("Location: /tpmovies/Showtimes/Listing");
        $roomList = $this->daoR->getAll();
        $moviesList = $this->daoM->getAll(0);
        $cinemasList = $this->daoC->getAll();
        $genresList = $this->daoG->getAll();
        require_once(VIEWS_PATH."/movieslisting.php");
    }
    else{
        $this->listing("error ingresado no valido","danger");
    }
    }

    public function genreFilter($idgenre){
        
        if($idgenre == 0){
            $_SESSION['idgenre'] = $idgenre;
            $this->Listing();   
        }

        $functionsList = $this->dao->getAll();
       
        
        $idmovies = array();
        foreach($functionsList as $function){
            $idmovies[] = $function->getId_Movie();
        }

        $idsmovies = array_unique($idmovies);
        $moviesList = array();
        $moviesFilter = $this->daoM->getMoviesForGenre($idgenre);
        foreach($idsmovies as $ids){
            foreach($moviesFilter as $filter){
                if($ids == $filter->getId()){ 
                $moviesList[] = $this->daoM->searchIdBdd($ids);
            }
            }
        }
      
    
        $arrayGenresandMovie= array();
        foreach($idmovies as $id){
            $arrayGenresandMovie[] = $this->daoM->getGenresofMovie($id);  
        }   
       
        $genresandmovies = [];
        foreach($arrayGenresandMovie as $genrexmovie){
            array_push($genresandmovies,$genrexmovie); 
        }
        

        $arraygenres = array_unique($arrayGenresandMovie,SORT_REGULAR);
       
        $_SESSION['idgenre'] = $idgenre;
        //header("Location: /tpmovies/Showtimes/Listing");
        $roomList = $this->daoR->getAll();
        $cinemasList = $this->daoC->getAll();
        $genresList = $this->daoG->getAll();
        require_once(VIEWS_PATH."/movieslisting.php");
    }

    public function Listing($message = "",$type= "",$id = 0){
        
        if(isset($_SESSION['cantseats'])){
            $_SESSION['cantseats'] = -1;
        }

        if(isset($_SESSION['msjError'])){
            $_SESSION["msjError"] = '';
        }


        
                
                $functionsList = $this->dao->getAll();

                $idmovies = array();
                foreach($functionsList as $function){
                    $idmovies[] = $function->getId_Movie();
                }

                $idsmovies = array_unique($idmovies);

                $arrayGenresandMovie= array();
                foreach($idmovies as $id){
                    $arrayGenresandMovie[] = $this->daoM->getGenresofMovie($id);  
                }   

                $genresandmovies = [];
                foreach($arrayGenresandMovie as $genrexmovie){
                    array_push($genresandmovies,$genrexmovie); 
                }


                $arraygenres = array_unique($arrayGenresandMovie,SORT_REGULAR);


                $roomList = $this->daoR->getAll();
                $moviesList = $this->daoM->getAll($id);
                $cinemasList = $this->daoC->getAll();

                $genresList = $this->daoG->getAll();

                if(isset($_SESSION['date'])){
                    unset($_SESSION['date']);
                }

                require_once(VIEWS_PATH."/movieslisting.php");
                //header("Location: /tpmovies/Showtimes/Listing");
        
     
    }
    
       
            

}



?>