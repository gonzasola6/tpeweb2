<?php
require_once 'app/models/autor.model.php';
require_once 'app/views/autor.view.php';

class AutorController{
    private $model;
    private $view;

    public function __construct($res){
        $this->model = new AutorModel();
        $this->view = new AutorView($res->user);
    }

    public function showAutor(){
        //obtengo los autores de la db
        $autores = $this->model->getAutores();

        //mando las autores a la vista
        $this->view->showAutores($autores);

    }

    public function addAutor(){
         if (!isset($_POST['name']) || empty($_POST['name'])) {
            return $this->view->showError("Falta completar el nombre");
        
        }

        if (!isset($_POST['pais']) || empty($_POST['pais'])) {
            return $this->view->showError("falta completar el pais");
        }
        if (!isset($_POST['nAlbums']) || empty($_POST['nAlbums'])) {
            return $this->view->showError("falta completar la cantidad de albumes");
        }

     
        $name = $_POST['name'];
        $pais = $_POST['pais'];
        $nAlbums = $_POST['nAlbums'];
        
        $id = $this->model->insertAutor($name,$pais,$nAlbums);

        // redirijo a la vista de autores pero modo admin
        header('Location: ' . BASE_URL . 'autores-admin');

    }

      public function showFormAddAutor() { 
        
        $this->view->showFormAddAutor(); // Mandamos a la vista del formulario
    }




    public function deleteAutor($id){
    //obtener el autor por id
    $autor = $this->model->getAutor($id); 

    if (!$autor) {
        return $this->view->showError("No existe el autor con el id=$id");
    }
    try {
    //borro el autor y redirijo
    $this->model->eraseAutor($id);

    header('Location: ' . BASE_URL . 'autores-admin');
    } catch (Exception $e) {
        return $this->view->showError($e->getMessage());
        }
    }

   

public function editAutor($id) {
    if (!isset($_POST['name']) || empty($_POST['name'])) {
        return $this->view->showError("Falta completar el nombre");
    }
    
    if (!isset($_POST['pais']) || empty($_POST['pais'])) {
        return $this->view->showError("Falta completar el país");
    }
    
    if (!isset($_POST['nAlbums']) || empty($_POST['nAlbums'])) {
        return $this->view->showError("Falta completar la cantidad de álbumes");
    }

    $name = $_POST['name'];
    $pais = $_POST['pais'];
    $nAlbums = $_POST['nAlbums'];

    // Actualizar el autor en la base de datos
    $this->model->updateAutor($id, $name, $pais, $nAlbums);

    // Redirigir a la vista de autores administrados
    header('Location: ' . BASE_URL . 'autores-admin');
}

 public function showEditAutorForm($id) {
    // Obtener el autor por ID
    $autor = $this->model->getAutor($id);

    if (!$autor) {
        return $this->view->showError("No existeeee el autor con el id=$id");
    }
    $this->view->showFormEditAutor($autor); // Mostrar el formulario de edición
    
   
}
}