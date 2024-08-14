<?php
session_start();
$conectar = mysql_connect('localhost','root','');
$banco = mysql_select_db('don juan cavalheiro');

if (isset($_POST['cadastrar']))
{
   $codigo = $_POST['codigo'];
   $descricao   = $_POST['descricao'];
   $codmarca = $_POST['codmarca'];
   $codmodelo   = $_POST['codmodelo'];
   $valor = $_POST['valor'];
   $foto1 = $_FILES['foto1'];
   $foto2 = $_FILES['foto2'];

    $diretorio = "fotos/";
    
    $extensao1 = strtolower(substr($_FILES['foto1']['name'], -4));
    $novo_nome1 = md5(time()).$extensao1;
    move_uploaded_file($_FILES['foto1']['tmp_name'], $diretorio.$novo_nome1);

    $extensao2 = strtolower(substr($_FILES['foto2']['name'], -6));
    $novo_nome2 = md5(time()).$extensao2;
    move_uploaded_file($_FILES['foto2']['tmp_name'], $diretorio.$novo_nome2);

      if ($codigo != "" and $descricao != "" and $codmarca != "" and $codmodelo != "" and $valor != ""){
         //gravar no banco as informacoes
         $sql = "INSERT INTO produto (codigo,descricao,codmarca,codmodelo,valor,foto1,foto2)
         VALUES ('$codigo','$descricao','$codmarca','$codmodelo','$valor','$novo_nome1','$novo_nome2')";
         $resultado = mysql_query($sql);
            if ($resultado === TRUE)
               {
                  header("Location:produto.html");
               }
            }
            else
            {
               echo 'Erro ao gravar dados.';
            }
}
// ---------------------------------------------

if (isset($_POST['excluir']))
{
    $codigo = $_POST['codigo'];
    $descricao   = $_POST['descricao'];
    $codmarca = $_POST['codmarca'];
    $codmodelo   = $_POST['codmodelo'];
    $valor = $_POST['valor'];
    $foto1 = $_FILES['foto1'];
    $foto2 = $_FILES['foto2'];

  $sql = "DELETE FROM produto WHERE codigo = '$codigo'";
          
  $resultado = mysql_query($sql);

  if ($resultado === TRUE)
  {
     echo 'Excluido com Sucesso';
  }
  else
  {
   echo 'Erro';
  }
}

if (isset($_POST['alterar']))
{
    $codigo = $_POST['codigo'];
    $descricao   = $_POST['descricao'];
    $codmarca = $_POST['codmarca'];
    $codmodelo   = $_POST['codmodelo'];
    $valor = $_POST['valor'];
    $foto1 = $_FILES['foto1'];
    $foto2 = $_FILES['foto2'];

   $sql = "UPDATE produto SET descricao='$descricao' and codmarca='$codmarca' and codmodelo='$codmodelo'  
   and valor='$valor'  and foto1='$novo_nome1'  and foto2='$novo_nome2' WHERE codigo ='$codigo'";

  $resultado = mysql_query($sql);

  if ($resultado === TRUE)
  {
     echo 'Dados alterados com Sucesso';
  }
  else
  {
   echo 'Erro';
  }
}

if (isset($_POST['pesquisar']))
{
   $sql = mysql_query("SELECT codigo,descricao,codmarca,codmodelo,valor,foto1,foto2 FROM produto");

   echo "<b>marcas Cadastrados:</b><br><br>";
   while ($dados = mysql_fetch_object($sql))
   {
    echo "codigo     :".$dados->codigo."<br>";
    echo "descricao  :".$dados->descricao. "<br>";
    echo "codmarca     :".$dados->codmarca."<br>";
    echo "codmodelo  :".$dados->codmodelo. "<br>";
    echo "valor     :".$dados->valor."<br>";
    echo '<img src="fotos/'.$dados->foto2.'" height="200" width="200" />'."<br><br>";
   }
}
?>
