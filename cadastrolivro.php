<?php

// fazer conexão com o banco
$conectar = mysql_connect("localhost","root","");
$banco = mysql_select_db("livraria");

// if para a opção dos botões
if(isset($_POST['enviar'])){
    // capturar as variáveis inseridas no HTML
    $titulo = $_POST['titulo'];
    $nrpaginas = $_POST['nrpaginas'];
    $ano = $_POST['ano'];
    $codautor = $_POST['codautor'];
    $codcategoria = $_POST['codcategoria'];
    $codeditora = $_POST['codeditora'];
    $resenha = $_POST['resenha'];
    $preco = $_POST['preco'];
    $fotocapa1 = $_FILES['fotocapa1'];
    $fotocapa2 = $_FILES['fotocapa2'];

    //criar pasta e mover fotos pra ela
    $diretorio = "imgbanco/";

    $extensao1 = strtolower(substr($_FILES['fotocapa1']['name'], -4));
    $novo_nome1 = md5(time().$extensao1);
    move_uploaded_file($_FILES['fotocapa1']['tmp_name'], $diretorio.$novo_nome1);

    //mudar nome foto2
    $extensao2 = strtolower(substr($_FILES['fotocapa2']['name'], -6));
    $novo_nome2 = md5(time().$extensao2);
    move_uploaded_file($_FILES['fotocapa2']['tmp_name'], $diretorio.$novo_nome2);

    // variável que guarda o comando SQL pro BD
    $sql = mysql_query("insert into livro(titulo, nrpaginas, ano, codautor, codcategoria, codeditora, resenha, preco, fotocapa1, fotocapa2) 
            values('$titulo','$nrpaginas', '$ano', '$codautor', '$codcategoria', '$codeditora', '$resenha', '$preco', '$novo_nome1', '$novo_nome2')");
   
    // analisar resultado
    if (mysql_affected_rows() > 0) {
        echo "<script>alert('Cadastro atualizado com sucesso!'); window.location='cadastrolivro.php';</script>";
    }
    else {
        echo "<script>alert('Não foi possível atualizar o cadastro: " . mysql_error() . "'); window.location='cadastrolivro.php';</script>";
    }
}

if(isset($_POST['alterar'])){
    $codigo = $_POST['codigo'];
    $preco = $_POST['preco'];

    $sql = "update livro set preco='$preco' where codigo='$codigo'";

    $resultado = mysql_query($sql);

    if (mysql_affected_rows() > 0) {
        echo "<script>alert('Cadastro atualizado com sucesso!'); window.location='cadastrolivro.php';</script>";
    }
    else {
        echo "<script>alert('Não foi possível atualizar o cadastro: " . mysql_error() . "'); window.location='cadastrolivro.php';</script>";
    }
}

if(isset($_POST['excluir']))
{
    $codigo = $_POST['codigo'];
    echo $codigo;

    $sql = mysql_query("delete from livro where codigo = '$codigo'");

    echo $sql;

    if (mysql_affected_rows() > 0) {
        echo "<script>alert('Cadastro excluído com sucesso!'); window.location='cadastrolivro.php';</script>";
    }
    else {
        echo "<script>alert('Não foi possível excluir o cadastro: " . mysql_error() . "'); window.location='cadastrolivro.php';</script>";
    }
}

if(isset($_POST['pesquisar'])){
    $codigo = $_POST['codigo'];

    $sql = "select * from livro where codigo = '$codigo'";

    $resultado = mysql_query($sql);

    if (mysql_num_rows($resultado) == 0){
        echo "<script>alert('Não foi possível encontrar o cadastro: " . mysql_error() . "'); window.location='cadastrolivro.php';</script>";
    }
    else{
        echo "<b>"."Pesquisa de Livro: "."</b><br>";
        
        while ($dados = mysql_fetch_object($resultado)){
                echo "Título: ".$dados->titulo."<br>";
                echo "Número de Páginas: ".$dados->nrpaginas."<br>";
                echo "Ano de Publicação: ".$dados->ano."<br>";
                echo "Autor: ".$dados->codautor."<br>";
                echo "Categoria: ".$dados->codcategoria."<br>";
                echo "Editora: ".$dados->codeditora."<br>";
                echo "Resenha: ".$dados->resenha."<br>";
                echo "Preço: ".$dados->preco."<br>";

                echo '<img src="imgbanco/'.$dados->fotocapa1.'"height="200" widht="200" />'." ";
                echo '<img src="imgbanco/'.$dados->fotocapa2.'"height="200" widht="200" />';
            }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">   
    <title> Cadastrar Livro </title>
    <link rel="shortcut icon" href="icone.ico" /> 
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>

    <header>

        <a href="pesquisa.php" id="logo"><img src="Logo.png" height=95></a>
        <a href="login.php" id="logologin"><img src="https://img.icons8.com/?size=100&id=23400&format=png&color=FFFFFF" height=45></a>

    </header>
    
    <div class="mainarea">

        <div id="menublock">

            <form name="formulario" method="POST" action="cadastrolivro.php" enctype="multipart/form-data">

                <h2> Cadastrar Livro </h2>
                Código: <input type="text" name="codigo" id="codigo" size="20">
                <br><br>
                Título: <input type="text" name="titulo" id="titulo" size="20">
                <br><br>
                Número de Páginas: <input type="text" name="nrpaginas" id="nrpaginas" size="20">
                <br><br>
                Ano: <input type="text" name="ano" id="ano" size="20">
                <br><br>
                Código do Autor: <input type="text" name="codautor" id="codautor" size="20">
                <br><br>
                Código da Categoria: <input type="text" name="codcategoria" id="codcategoria" size="20">
                <br><br>
                Código da Editora: <input type="text" name="codeditora" id="codeditora" size="20">
                <br><br>
                Resenha: <input type="text" name="resenha" id="resenha" size="20">
                <br><br>
                Preço: <input type="text" name="preco" id="preco" size="20">
                <br><br>
                Imagem 1: <input type="file" name="fotocapa1" id="fotocapa1" size="20">
                <br><br>
                Imagem 2: <input type="file" name="fotocapa2" id="fotocapa2" size="20">
                <br><br>
                <input type="submit" name="enviar" id="enviar" value="Enviar"> 
                <input type="submit" name="alterar" id="alterar" value="Alterar"> 
                <input type="submit" name="excluir" id="excluir" value="Excluir"> 
                <input type="submit" name="pesquisar" id="pesquisar" value="Pesquisar"> 
        
            </form>

        </div>

    </div>

</body>

</html>