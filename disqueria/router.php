<?php
require_once 'libs/response.php';
require_once 'config.php';
require_once 'app/middlewares/session.auth.middleware.php';
require_once 'app/middlewares/verify.auth.middleware.php';
require_once 'app/controllers/album.controller.php';
require_once 'app/controllers/autor.controller.php';
require_once 'app/controllers/auth.controller.php';


// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$res = new Response(); // lugar dodne guardar el usuario para no dejarlo suelto, empieza  a agrupar distintas cosas q necesitemos pasar por middlewares
//pasa por los middlewares y los middlewares lo modifican, asi cuando llega al controller, puede ver q datos puede usar

$action = 'home'; //action por def
if (!empty($_GET['action'])){
    $action = $_GET['action'];
}



$params = explode('/', $action);

switch ($params[0]) {
     case 'home':
        //mostrar los albumes disponibles a la venta sin iniciar sesion
        $controller = new AlbumController($res);
        $controller->showAlbum();
        break;

    case 'home-admin':
        //mostrar los albumes disponibles a la venta con sesion iniciada
        sessionAuthMiddleware($res);
        $controller = new AlbumController($res);
        $controller->showAlbum();
        break;

    case 'album':
        $controller = new AlbumController($res);
        $controller->showAlbumDetail($params[1]);
        break;

    case 'album-admin':
    sessionAuthMiddleware($res);
    $controller = new AlbumController($res);
    $controller->showAlbumDetail($params[1]);
        break;

    case 'autores':
        $controller = new AutorController($res);
        $controller->showAutor();
        break;

     case 'autores-admin':
        sessionAuthMiddleware($res);
        $controller = new AutorController($res);
        $controller->showAutor();
        break;

    case 'autor':
        $controller = new AlbumController($res);
        $controller->showAlbumsByAutor($params[1]);
        break;

    case 'showForm-add-album':
        sessionAuthMiddleware($res); 
        $controller = new AlbumController($res);
        $controller->showFormAddAlbum();
        break;

    case 'add-album':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res); 
        $controller = new AlbumController($res);
        $controller->addAlbum();
        break;
    case 'showForm-add-autor':
        sessionAuthMiddleware($res); 
        $controller = new AutorController($res);
        $controller->showFormAddAutor();
        break;

    case 'add-autor':
    sessionAuthMiddleware($res);
    verifyAuthMiddleware($res); 
    $controller = new AutorController($res);
    $controller->addAutor();
        break;

    case 'delete-album':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res); 
        $controller = new AlbumController($res);
        $controller->deleteAlbum($params[1]);
        break;

    case 'delete-autor':
    sessionAuthMiddleware($res); 
    verifyAuthMiddleware($res);
    $controller = new AutorController($res);
    $controller->deleteAutor($params[1]);
        break;

    case 'edit-album':
    sessionAuthMiddleware($res);
     
    $controller = new AlbumController($res);
    $controller->showEditAlbumForm($params[1]); // se espera que el ID del álbum sea pasado como segundo parámetro
        break;

    case 'update-album':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res); 
    $controller = new AlbumController($res);
    $controller->editAlbum($params[1]); // se espera que el ID del álbum sea pasado como segundo parámetro
        break;

    case 'edit-autor':
    sessionAuthMiddleware($res); 
    $controller = new AutorController($res);
    $controller->showEditAutorForm($params[1]); // Mostrar el formulario de edición
        break;

    case 'update-autor':
    sessionAuthMiddleware($res);
    verifyAuthMiddleware($res); 
    $controller = new AutorController($res);
    $controller->editAutor($params[1]); // Manejar la actualización del autor
        break;

    case 'showLogin':
        $controller = new AuthController();
        $controller->showLogin(); //muestra el form
        break;

    case 'login':
        $controller = new AuthController();
        $controller->login(); //chequea si lo q mandamos tiene sentido
        break;

    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
        
    default: 
        echo "404 Page Not Found";
        break;
}