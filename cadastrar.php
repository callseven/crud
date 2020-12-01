<?php
require __DIR__.'/vendor/autoload.php';

define('TITLE','Cadastrar Vaga');

use App\Entity\Vaga;


//validação do post
    if (isset($_POST['titulo'], $_POST['descricao'], $_POST['ativo'])) {
        $obVaga = new Vaga;
        $obVaga->titulo = $_POST['titulo'];
        $obVaga->descricao = $_POST['descricao'];
        $obVaga->ativo = $_POST['ativo'];
        $obVaga->cadastrar();

        header('location: index.php?status=success');
        exit;

        //print_r($obVaga);
    }

    include __DIR__.'/include/header.php';
    include __DIR__.'/include/formulario.php';
    include __DIR__.'/include/footer.php';

