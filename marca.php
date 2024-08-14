<?php
session_start();
$conectar = mysql_connect('localhost','root','');
$banco = mysql_select_db('don juan cavalheiro');

if (isset($_POST['cadastrar']))
{
   $codigo = $_POST['codigo'];
   $nome   = $_POST['nome'];
      if ($codigo != "" and $nome != ""){
         //gravar no banco as informacoes
         $sql = "INSERT INTO marca (codigo,nome)
         VALUES ('$codigo','$nome')";
         $resultado = mysql_query($sql);
            if ($resultado === TRUE)
               {
                  header("Location:marca.html");
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
  
  $sql = "DELETE FROM marca WHERE codigo = '$codigo'";
          
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


   $sql = "UPDATE marca SET nome='$nome' WHERE codigo ='$codigo'";

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
   $sql = mysql_query("SELECT codigo,nome FROM marca");

   echo "<b>marcas Cadastrados:</b><br><br>";
   while ($dados = mysql_fetch_object($sql))
   {
    echo "codigo     :".$dados->codigo."<br>";
    echo "nome  :".$dados->nome. "<br><br>";
   }
}
?>
