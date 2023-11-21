<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

if(isset($_POST['submit'])){

   $address = $_POST['rua'] .', '.$_POST['numero_casa'].', '.$_POST['bairro'].', '.$_POST['cidade'] ;
   $address = filter_var($address, FILTER_SANITIZE_STRING);

   $update_address = $conn->prepare("UPDATE `users` set address = ? WHERE id = ?");
   $update_address->execute([$address, $user_id]);

   $message[] = 'Endereço salvo!';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Insira o seu endereço</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- arquivo css -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php' ?>

<section class="form-container">

   <form action="" method="post">
      <h3>Novo Endereço</h3>
      <input type="text" class="box" placeholder="Rua" required maxlength="50" name="rua">
      <input type="text" class="box" placeholder="Número da Casa" required maxlength="50" name="numero_casa">
      <input type="text" class="box" placeholder="Bairro" required maxlength="50" name="bairro">
      <input type="text" class="box" placeholder="Cidade" required maxlength="50" name="cidade">

      <input type="submit" value="Salvar endereço" name="submit" class="btn">
   </form>

</section>










<?php include 'components/footer.php' ?>







<!-- arquivo js -->
<script src="js/script.js"></script>

</body>
</html>