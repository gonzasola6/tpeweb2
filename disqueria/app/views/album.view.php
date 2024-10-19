<?php

class AlbumView{

    private $user = null;

    public function __construct($user){
        $this->user = $user;
    }


    public function showAlbums($albums){
        require './templates/layout/header.phtml';
        
        
        ?>

        <h1>Discos disponibles a la venta:</h1>
        <ul class="list-group">
        <?php foreach($albums as $album) { ?>
            <li class="list-group-item item-album">
                <div class="label">
                    <b>Titulo:</b> <?= htmlspecialchars($album->nombre)?>
                    <b>Autor:</b> <?= htmlspecialchars($album->autor_nombre)?>
                    
                    <?php if($this->user): ?>
                        <a href="edit-album/<?= $album->ID_Album ?>" class="btn btn-primary btn-sm ml-2">Editar</a>
                        <a href="delete-album/<?= $album->ID_Album ?>" type="button" class='btn btn-danger btn-sm ml-auto'>Borrar</a>
                        <div><a href ="album-admin/<?= $album->ID_Album ?>" class="btnBlue">VER DETALLE</a></div>
                        
                    <?php else: ?>
                            <a href ="album/<?= $album->ID_Album ?>" class="btnBlue">VER DETALLE</a>
                        <?php endif; ?>
                    
            </li>
        <?php }
        
        require './templates/layout/footer.phtml';
    }

    public function showFormAddAlbum($autores) { 
        require './templates/layout/header.phtml';
        require './templates/form_alta_album.phtml';  // Ahora este formulario recibe $autores
        require './templates/layout/footer.phtml';
    }

    public function showError($error){
        require './templates/error.phtml';
    }

    public function showAlbumDetails($album){
        require './templates/layout/header.phtml';
        
        ?>

        <h1>Disco</h1>
        <ul class="list-group">
            <li class="list-group-item item-album">
                <div class="label">
                    <b>Titulo:</b> <?= htmlspecialchars($album->nombre)?>
                    <b>Genero:</b> <?= htmlspecialchars($album->genero)?>
                    <b>Cantidad de canciones:</b> <?= htmlspecialchars($album->cantCanciones)?>
                    <b>Fecha de lanzamiento:</b> <?= htmlspecialchars($album->lanzamiento)?>
                    <b>Autor:</b> <?= htmlspecialchars($album->autor_nombre)?> 
                    <!-- (MOSTRAR AUTOR(SERIA CATEGORIA A LA QUE PERTENECE)) -->
            </li>
        <?php 
        require './templates/layout/footer.phtml';
    

    }

    public function showFormEditAlbum($album,$autores) {
    require './templates/layout/header.phtml';
    require './templates/form_edit_album.phtml';
    require './templates/layout/footer.phtml';
}



}