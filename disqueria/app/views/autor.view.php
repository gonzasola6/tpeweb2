<?php

class AutorView{

    private $user = null;

    public function __construct($user){
        $this->user = $user;
    }


    public function showAutores($autores){
        require './templates/layout/header.phtml';
        
        ?>
        <h1>Autores</h1>
        <ul class="list-group">
        <?php foreach($autores as $autor) { ?>
            <li class="list-group-item item-autor">
                <div class="label">
                    <b>Nombre:</b> <?= htmlspecialchars($autor->nombre)?>
                    <b>Pais:</b> <?= htmlspecialchars($autor->pais)?>
                    <b>Álbumes publicados a la fecha:</b> <?= htmlspecialchars($autor->cantAlbumes)?>
                    
                    <?php if($this->user): ?>
                        
                        <a href="edit-autor/<?= $autor->ID_Autor ?>" class="btn btn-primary btn-sm ml-2">Editar</a>
                        <a href="delete-autor/<?= $autor->ID_Autor ?>" type="button" class='btn btn-danger btn-sm ml-auto'>Borrar</a>
                    <?php endif; ?>
                    <div><a href="autor/<?= $autor->ID_Autor ?>" class="btnBlue">Ver álbumes disponibles en venta</a></div>
            </li>
        <?php }
        require './templates/layout/footer.phtml';
    }

    public function showError($error){
        require './templates/error.phtml';
    }

    public function showFormEditAutor($autor) {
    require './templates/layout/header.phtml';
    require './templates/form_edit_autor.phtml'; 
    require './templates/layout/footer.phtml';
}
   public function showFormAddAutor() { 
        require './templates/layout/header.phtml';
        require './templates/form_alta_autor.phtml';  
        require './templates/layout/footer.phtml';
    }
}