<?php
require __DIR__.'/vendor/autoload.php';

define('TITLE', 'Editar Vaga');

use App\Entity\Vaga;

//Validacao do ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location: index.php?status=error');
    exit;
}

//Consulta a Vaga
$obVaga = Vaga::getVaga($_GET['id']);

//validacao a vaga
if(!$obVaga instanceof Vaga){
    header('location: index.php?status=error');
    exit;
}
//echo "<pre>"; print_r($obVaga); echo "</pre>"; exit;


//validação do post
    if (isset($_POST['titulo'],$_POST['descricao'],$_POST['ativo'])) {
        $obVaga->titulo = $_POST['titulo'];
        $obVaga->descricao = $_POST['descricao'];
        $obVaga->ativo = $_POST['ativo'];
        //echo "<pre>"; print_r($obVaga); echo "</pre>"; exit;
        $obVaga->atualizar();

        header('location: index.php?status=success');
        exit;

        //print_r($obVaga);
    }

    include __DIR__.'/include/header.php';
    include __DIR__.'/include/formulario.php';
    include __DIR__.'/include/footer.php';

