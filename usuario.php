<?php
session_start();
$conectar = mysql_connect('localhost','root','');
$banco = mysql_select_db('don juan cavalheiro');

if (isset($_POST['cadastrar']))
{
  $nome  = $_POST['nome'];
  $login = $_POST['login'];
  $senha = $_POST['senha'];

  if ( $nome != "" and $login != "" and $senha != "senha"){
     //gravar no banco as informacoes
   $sql = "INSERT INTO usuario (nome,login,senha)
   VALUES ('$nome','$login','$senha')";

   $resultado = mysql_query($sql);
   if ($resultado === TRUE)
      {
         header("Location:usuario.html");
      }
  }
   }
  else
  {
     echo 'Erro ao gravar dados.';
  }

// ---------------------------------------------

if (isset($_POST['excluir']))
{
    $codigo = $_POST['codigo'];
    $nome       = $_POST['nome'];
  
  $sql = "DELETE FROM classificacao WHERE codigo = '$codigo'";
          
  $resultado = mysql_query($sql);

  if ($resultado === TRUE)
  {
     echo 'Excluido com Sucesso';
  }
  else
  {
     echo 'Erro ao excluir dados.';
  }
}

if (isset($_POST['alterar']))
{
    $codigo = $_POST['codigo'];
    $nome       = $_POST['nome'];

   $sql = "UPDATE classificacao SET nome='$nome' WHERE codigo ='$codigo'";

  $resultado = mysql_query($sql);

  if ($resultado === TRUE)
  {
     echo 'Dados alterados com Sucesso';
  }
  else
  {
     echo 'Erro ao alterar dados.';
  }
}

if (isset($_POST['pesquisar']))
{
   $sql = mysql_query("SELECT codigo,nome FROM classificacao");

   echo "<b>Usuarios Cadastrados:</b><br><br>";
   while ($dados = mysql_fetch_object($sql))
   {
    echo "codigo     :".$dados->codigo." ";
    echo "nome  :".$dados->nome. "<br>";
   }
}
?>
