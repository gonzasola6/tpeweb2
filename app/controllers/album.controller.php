<?php
require_once 'app/models/album.model.php';
require_once 'app/views/album.view.php';

class AlbumController{
    private $model;
    private $view;
    private $autorModel; 

    public function __construct($res){
        $this->model = new AlbumModel();
        $this->view = new AlbumView($res->user);
        $this->autorModel = new AutorModel();
    }

    public function showAlbum(){
        //obtengo los albumes de la db
        $albums = $this->model->getAlbums();

        //mando los albumes a la vista
        $this->view->showAlbums($albums);

    }

    public function showAlbumDetail($ID_Album){
        $album = $this->model->getAlbum($ID_Album); 
        $this->view->showAlbumDetails($album);
    }

    public function showFormAddAlbum() {
        $autores = $this->autorModel->getAutores(); // Obtenemos la lista de autores
        $this->view->showFormAddAlbum($autores); // Mandamos la lista a la vista del formulario
    }

   
    public function addAlbum(){
         if (!isset($_POST['name']) || empty($_POST['name'])) {
            return $this->view->showError("Falta completar el nombre");
        
        }

        if (!isset($_POST['launchDate']) || empty($_POST['launchDate'])) {
            return $this->view->showError("falta completar la fecha lanzamiento");
        }
        if (!isset($_POST['nSongs']) || empty($_POST['nSongs'])) {
            return $this->view->showError("falta completar la cantidad de canciones");
        }

        if (!isset($_POST['genre']) || empty($_POST['genre'])) {
            return $this->view->showError("falta completar el genero");
        }

        if (!isset($_POST['ID_Autor']) || empty($_POST['ID_Autor'])) {
            return $this->view->showError("falta completar el id del autor");
        }
       
        
        $name = $_POST['name'];
        $launchDate = $_POST['launchDate'];
        $nSongs = $_POST['nSongs'];
        $genre = $_POST['genre'];
        $ID_Autor = $_POST['ID_Autor'];

        $id = $this->model->insertAlbum($name,$launchDate,$nSongs,$genre,$ID_Autor);

        // redirijo al home con sesion iniciada
        header('Location: ' . BASE_URL . 'home-admin');

    }

    public function deleteAlbum($id){
    //obtener el album por id
    $album = $this->model->getAlbum($id); 

    if (!$album) {
        return $this->view->showError("No existe el album con el id=$id");
    }

    //borro el album y redirijo
    $this->model->eraseAlbum($id);

    header('Location: ' . BASE_URL . 'home-admin');
}

    public function showAlbumsByAutor($ID_Autor){
        $albums = $this->model->getAlbumsByAutor($ID_Autor);
    
        if (empty($albums)) {
            return $this->view->showError("No hay álbumes para este autor.");
        }

        $this->view->showAlbums($albums);
        
    }
    

    public function editAlbum($ID_Album) {
    // Verificamos si se está enviando el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validar campos
        if (!isset($_POST['name']) || empty($_POST['name'])) {
            return $this->view->showError("Falta completar el nombre");
        }
        if (!isset($_POST['launchDate']) || empty($_POST['launchDate'])) {
            return $this->view->showError("Falta completar la fecha de lanzamiento");
        }
        if (!isset($_POST['nSongs']) || empty($_POST['nSongs'])) {
            return $this->view->showError("Falta completar la cantidad de canciones");
        }
        if (!isset($_POST['genre']) || empty($_POST['genre'])) {
            return $this->view->showError("Falta completar el género");
        }
        if (!isset($_POST['ID_Autor']) || empty($_POST['ID_Autor'])) {
            return $this->view->showError("Falta completar el ID del autor");
        }

        // Obtener datos del formulario
        $name = $_POST['name'];
        $launchDate = $_POST['launchDate'];
        $nSongs = $_POST['nSongs'];
        $genre = $_POST['genre'];
        $ID_Autor = $_POST['ID_Autor'];

        // Actualizar álbum en la base de datos
        $this->model->updateAlbum($ID_Album, $name, $launchDate, $nSongs, $genre, $ID_Autor);
        
        // Redirigir a la página de álbumes
        header('Location: ' . BASE_URL . 'home-admin');
        exit;
    }

    // Obtener álbum para mostrar en el formulario
    $album = $this->model->getAlbum($ID_Album);
    $autores = $this->autorModel->getAutores(); // Obtener autores para el select
    $this->view->showFormEditAlbum($album, $autores); // Mostrar el formulario con los datos actuales
}

    public function showEditAlbumForm($ID_Album) {
        $album = $this->model->getAlbum($ID_Album);
        $autores = $this->autorModel->getAutores(); // Obtener lista de autores para el dropdown
        $this->view->showFormEditAlbum($album, $autores); // Mostrar el formulario de edición
    }
}