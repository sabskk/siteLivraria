<?php
    $connect = mysql_connect("localhost","root","");
    $db = mysql_select_db("livraria");

    session_start();
    $status="";

    if (isset($_POST['codigo']) && $_POST['codigo']!="") {
        $codigo = $_POST['codigo'];
        $resultado = mysql_query("SELECT nome, preco, foto1 FROM produto WHERE codigo = '$codigo'");

        $row = mysql_fetch_assoc($resultado);

        $nome = $row['nome'];
        $preco = $row['preco'];
        $foto1 = $row['foto1'];

        $cartArray = array($codigo=>array('nome'=>$nome,'preco'=>$preco,'quantity'=>1,'foto'=>$foto1));

        if(empty($_SESSION["shopping_cart"])) {
            $_SESSION["shopping_cart"] = $cartArray;
            $status = "<div class='box'> O produto foi adicionado ao carrinho! </div>";
        }
        else {
            $array_keys = array_keys($_SESSION["shopping_cart"]);

            if(in_array($codigo,$array_keys)) {
                $status = "<div class='box'> Produto já está no carrinho! </div>";
            }
            else {
                $_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
                $status = "<div class='box'> Produto foi adicionado ao carrinho! </div>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title> Página Inicial </title>
    <link rel="shortcut icon" href="icone.ico" /> 
    <link rel="stylesheet" href="styles.css"><link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Special+Gothic&display=swap" rel="stylesheet">
</head>

<body>

    <header>

        <a href="pesquisa.php" id="logo"><img src="Logo.png" height=95></a>
        <a href="login.php" id="logologin"><img src="https://img.icons8.com/?size=100&id=23400&format=png&color=FFFFFF" height=45></a>
        <a href="carrinho.php">
            <img src="https://img.icons8.com/?size=100&id=rMXM_J0hBtPS&format=png&color=FFFFFF" height=45>
            <?php
                if (!empty($_SESSION["shopping_cart"])) {
                    $cart_count = count(array_keys($_SESSION["shopping_cart"]));
                    echo "<span>$cart_count</span>";
                }
            ?>
        </a>
 
    </header>

    <div style="clear:both;"></div>
        <div class="messagebox" style="margin:10px 0px;">
        <?php echo $status; ?>
    </div>

    <div id="homepage">

        <div id="barrapesquisa">

            <form name="formulario" method="post" action="pesquisa.php" id="formpesquisa">

                <!-- pesquisar Autor -->
                <label> Autor: </label>
                <select name="autor">
                <option value="" selected="selected"> Selecione... </option>

                <?php
                $query = mysql_query("SELECT codigo, nome FROM autor");
                while($autor = mysql_fetch_array($query))
                {?>
                <option value="<?php echo $autor['codigo']?>">
                               <?php echo $autor['nome']?></option>
                <?php }
                ?>
                </select>

                <!-- pesquisar Categorias -->
                <label> Categorias: </label>
                <select name="categoria">
                <option value="" selected="selected"> Selecione... </option>

                <?php
                $query = mysql_query("SELECT codigo, nome FROM categoria");
                while($categorias = mysql_fetch_array($query))
                {?>
                <option value="<?php echo $categorias['codigo']?>">
                               <?php echo $categorias['nome']?></option>
                <?php }
                ?>
                </select>

                <!-- pesquisar Editora -->
                <label> Editora: </label>
                <select name="editora">
                <option value="" selected="selected"> Selecione... </option>

                <?php
                $query = mysql_query("SELECT codigo, nome FROM editora");
                while($editora = mysql_fetch_array($query))
                {?>
                <option value="<?php echo $editora['codigo']?>">
                               <?php echo $editora['nome']?></option>
                <?php }
                ?>
                </select>

                <input type="submit" name="pesquisar" value="Pesquisar">

            </form>

        </div>

        <?php
            /* pesquisar produtos qdo carrega a pagina 1vez  */
            $sql_livros = "SELECT livro.codigo,livro.titulo,livro.nrpaginas,livro.ano,livro.codautor,livro.codcategoria,livro.codeditora,livro.resenha,livro.preco,livro.fotocapa1,livro.fotocapa2 FROM livro";
            $seleciona_livros = mysql_query($sql_livros);    

            if (isset($_POST['pesquisar'])) //verifica que a opção marca e modelo foi selecionada ou não
            {
            /* pesquisar livros qdo pessiona pesquisar */
            $sql_livros = "SELECT livro.codigo,livro.titulo,livro.nrpaginas,livro.ano,livro.codautor,livro.codcategoria,livro.codeditora,livro.resenha,livro.preco,livro.fotocapa1,livro.fotocapa2 FROM livro";
            $seleciona_livros = mysql_query($sql_livros);

            $autor = (empty($_POST['autor']))? 'null' : $_POST['autor'];
            $categoria = (empty($_POST['categoria']))? 'null' : $_POST['categoria'];
            $editora = (empty($_POST['editora']))? 'null' : $_POST['editora'];

            if (($autor <> 'null') and ($categoria == 'null') and ($editora == 'null')) //pesquisar Autor escolhido
                    {
                        $sql_livros = "SELECT livro.codigo,livro.titulo,livro.nrpaginas,livro.ano,livro.codautor,livro.codcategoria,livro.codeditora,livro.resenha,livro.preco,livro.fotocapa1,livro.fotocapa2
                                        FROM livro, autor, categoria, editora
                                        WHERE livro.codautor = autor.codigo
                                        and livro.codcategoria = categoria.codigo
                                        and livro.codeditora = editora.codigo
                                        and autor.codigo = '$autor'";
                                                
                        $seleciona_livros = mysql_query($sql_livros);
                    }

            if (($autor == 'null') and ($categoria <> 'null') and ($editora == 'null')) //pesquisar Categoria escolhida
                    {
                        $sql_livros = "SELECT livro.codigo,livro.titulo,livro.nrpaginas,livro.ano,livro.codautor,livro.codcategoria,livro.codeditora,livro.resenha,livro.preco,livro.fotocapa1,livro.fotocapa2
                                        FROM livro, autor, categoria, editora
                                        WHERE livro.codautor = autor.codigo
                                        and livro.codcategoria = categoria.codigo
                                        and livro.codeditora = editora.codigo
                                        and categoria.codigo = '$categoria'";
                                                
                        $seleciona_livros = mysql_query($sql_livros);
                    }

            if (($autor == 'null') and ($categoria == 'null') and ($editora <> 'null')) //pesquisar Editora escolhida
                    {
                        $sql_livros = "SELECT livro.codigo,livro.titulo,livro.nrpaginas,livro.ano,livro.codautor,livro.codcategoria,livro.codeditora,livro.resenha,livro.preco,livro.fotocapa1,livro.fotocapa2
                                        FROM livro, autor, categoria, editora
                                        WHERE livro.codautor = autor.codigo
                                        and livro.codcategoria = categoria.codigo
                                        and livro.codeditora = editora.codigo
                                        and editora.codigo = '$editora'";
                                                
                        $seleciona_livros = mysql_query($sql_livros);
                    }

            if (($autor <> 'null') and ($categoria <> 'null') and ($editora == 'null')) //pesquisar Autor e Categoria escolhidas
                    {
                        $sql_livros = "SELECT livro.codigo,livro.titulo,livro.nrpaginas,livro.ano,livro.codautor,livro.codcategoria,livro.codeditora,livro.resenha,livro.preco,livro.fotocapa1,livro.fotocapa2
                                        FROM livro, autor, categoria, editora
                                        WHERE livro.codautor = autor.codigo
                                        and livro.codcategoria = categoria.codigo
                                        and livro.codeditora = editora.codigo
                                        and autor.codigo = '$autor'
                                        and categoria.codigo = '$categoria'";
                                                
                        $seleciona_livros = mysql_query($sql_livros);
                    }

            if (($autor == 'null') and ($categoria <> 'null') and ($editora <> 'null')) //pesquisar Categoria e Editora escolhidos
                    {
                        $sql_livros = "SELECT livro.codigo,livro.titulo,livro.nrpaginas,livro.ano,livro.codautor,livro.codcategoria,livro.codeditora,livro.resenha,livro.preco,livro.fotocapa1,livro.fotocapa2
                                        FROM livro, autor, categoria, editora
                                        WHERE livro.codautor = autor.codigo
                                        and livro.codcategoria = categoria.codigo
                                        and livro.codeditora = editora.codigo
                                        and editora.codigo = '$editora'
                                        and categoria.codigo = '$categoria'";
                                                
                        $seleciona_livros = mysql_query($sql_livros);
                    }

            if (($autor <> 'null') and ($categoria == 'null') and ($editora <> 'null')) //pesquisar Autor e Editora escolhidos
                    {
                        $sql_livros = "SELECT livro.codigo,livro.titulo,livro.nrpaginas,livro.ano,livro.codautor,livro.codcategoria,livro.codeditora,livro.resenha,livro.preco,livro.fotocapa1,livro.fotocapa2
                                        FROM livro, autor, categoria, editora
                                        WHERE livro.codautor = autor.codigo
                                        and livro.codcategoria = categoria.codigo
                                        and livro.codeditora = editora.codigo
                                        and autor.codigo = '$autor'
                                        and editora.codigo = '$editora'";
                                                
                        $seleciona_livros = mysql_query($sql_livros);
                    }

            if (($autor <> 'null') and ($categoria <> 'null') and ($editora <> 'null')) //pesquisar Autor, Categoria e Editora escolhidos
                    {
                        $sql_livros = "SELECT livro.codigo,livro.titulo,livro.nrpaginas,livro.ano,livro.codautor,livro.codcategoria,livro.codeditora,livro.resenha,livro.preco,livro.fotocapa1,livro.fotocapa2
                                        FROM livro, autor, categoria, editora
                                        WHERE livro.codautor = autor.codigo
                                        and livro.codcategoria = categoria.codigo
                                        and livro.codeditora = editora.codigo
                                        and autor.codigo = '$autor'
                                        and editora.codigo = '$editora'
                                        and categoria.codigo = '$categoria'";
                                                
                        $seleciona_livros = mysql_query($sql_livros);
                    }
                }
            
            // mostrar as informações dos livros 
            if(mysql_num_rows($seleciona_livros) == 0) {
                echo '<h1> Desculpe, sua busca não retornou resultados. </h1>';
            }
            else {
                echo "<div id='prodgrid'>";
                while ($dados = mysql_fetch_object($seleciona_livros)) {
                    echo "<form method='post' action=''>";
                        echo "<div id='divresult'>";
                            echo "<div id='imgprods'>";
                                echo '<img src="imgbanco/'.$dados->fotocapa1.'" height="250"/>'." ";
                            echo "</div>";
                            echo "<div id='divprods'>";
                                echo "<input type='hidden' name='codigo' value='{$dados->codigo}'>";
                                echo "<h3>".$dados->titulo."</h3>";
                                echo "<p> R$".$dados->preco."</p>";
                                echo "<button type='submit' class='buy'> Comprar </button>";
                            echo "</div>";
                        echo "</div>";
                    echo "</form>";
                }
                echo "</div>";
            }
        ?>

    </div>
