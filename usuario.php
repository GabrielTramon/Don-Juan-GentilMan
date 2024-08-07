<?php
session_start();
$conectar = mysql_connect('localhost','root','');
$banco = mysql_select_db('don juan cavalheiro');

if (isset($_POST['cadastrar']))
{
   $codigo = $_POST['codigo'];
   $nome   = $_POST['nome'];
   $login  = $_POST['login'];
   $senha  = $_POST['senha'];
      if ($codigo != "" and $nome != "" and $login != "" and $senha != ""){
         //gravar no banco as informacoes
         $sql = "INSERT INTO usuario (codigo,nome,login,senha)
         VALUES ('$codigo','$nome','$login','$senha')";
         $resultado = mysql_query($sql);
            if ($resultado === TRUE)
               {
                  header("Location:usuario.html");
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
   $nome   = $_POST['nome'];
   $login  = $_POST['login'];
   $senha  = $_POST['senha'];
  
  $sql = "DELETE FROM usuario WHERE codigo = '$codigo'";
          
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
   $nome   = $_POST['nome'];
   $login  = $_POST['login'];
   $senha  = $_POST['senha'];

   $sql = "UPDATE usuario SET nome='$nome' and login='$login' and senha='$senha',  WHERE codigo ='$codigo'";

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
   $sql = mysql_query("SELECT codigo,nome,login,senha FROM usuario");

   echo "<b>Usuarios Cadastrados:</b><br><br>";
   while ($dados = mysql_fetch_object($sql))
   {
    echo "codigo     :".$dados->codigo."<br>";
    echo "nome  :".$dados->nome. "<br>";
    echo "login  :".$dados->login. "<br>";
    echo "senha  :".$dados->senha. "<br><br>";
   }
}
?>
