<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['send'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_message->execute([$name, $email, $number, $msg]);

   if($select_message->rowCount() > 0){
      $message[] = 'Mensagem já enviada!';
   }else{

      $insert_message = $conn->prepare("INSERT INTO `messages`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
      $insert_message->execute([$user_id, $name, $email, $number, $msg]);

      $message[] = 'Mensagem enviada com sucesso!!';

   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contato</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- arquivo css -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- começo da section header -->
<?php include 'components/user_header.php'; ?>
<!-- fim da section header -->

<div class="heading">
   <h3>Fale Conosco</h3>
   <p><a href="home.php">Home</a> <span> / Contate-nos</span></p>
</div>

<!-- começo da section contato  -->

<section class="contact">

   <div class="row">

      <div class="image">
         <img src="images/contact-img.svg" alt="">
      </div>

      <form action="" method="post">
         <h3>Deixe Aqui sua Sugestão/Dúvida</h3>
         <input type="text" name="name" maxlength="50" class="box" placeholder="Insira seu nome" required>
         <input type="number" name="number" min="0" max="9999999999" class="box" placeholder="Insira seu número" required maxlength="10">
         <input type="email" name="email" maxlength="50" class="box" placeholder="insira seu e-mail" required>
         <textarea name="msg" class="box" required placeholder="Digite sua mensagem" maxlength="500" cols="30" rows="10"></textarea>
         <input type="submit" value="enviar mensagem" name="send" class="btn">
      </form>

   </div>

</section>

<!-- fim da section contato -->










<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->








<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>