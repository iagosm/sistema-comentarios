<?php
try {
$pdo = new PDO("mysql:host=localhost;dbname=senhas", 'root', '');
}catch(PDOException $e) {
  echo "ERROR: " .$e->getMessage();
}

if(isset($_POST['nome']) && empty($_POST['nome']) == false) {
  $nome = $_POST['nome'];
  $mensagem = $_POST['mensagem'];

  $sql = $pdo->prepare("INSERT INTO mensagens SET nome = :nome, msg = :msg, data_msg = NOW()");
  $sql->bindValue(":nome", $nome);
  $sql->bindValue(":msg", $mensagem);
  $sql->execute();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <fieldset>
    <form action="" method="POST">
      <label for="nome">Nome</label> <br>
      <input type="text" name="nome"><br><br>
      <label for="mensagem">Mensagem</label><br>
      <textarea name="mensagem" id="" cols="30" rows="10"></textarea>
      <br><br>
      <input type="submit" value="Enviar mensagem">
    </form>
  </fieldset>
  <br><br>

  <?php

  $sql = "SELECT * FROM mensagens ORDER BY data_msg DESC";
  $sql = $pdo->query($sql);
  if($sql->rowCount() > 0) {
    foreach($sql->fetchAll() as $mensagem) :
      ?>
      <strong><?php echo $mensagem['nome']?></strong><br>
       <small><?php echo $mensagem['data_msg'];?> </small> <br><br>
      <?php echo $mensagem['msg']?>
      <hr>
    <?php endforeach;
    }else {
      echo "Não há mensagens.";}?>
</body>
</html>