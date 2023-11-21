<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Pedidos</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- arquivo css -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- começo da section header  -->
<?php include 'components/user_header.php'; ?>
<!-- fim da section header -->

<div class="heading">
   <h3>Pedidos</h3>
   <p><a href="html.php">Home</a> <span> / Pedidos</span></p>
</div>

<section class="orders">

   <h1 class="title">Seus pedidos</h1>

   <div class="box-container">

   <?php
      if($user_id == ''){
         echo '<p class="empty">Por favor, faça o login para ver seus pedidos!</p>';
      }else{
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
         $select_orders->execute([$user_id]);
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p>Data do pedido : <span><?= $fetch_orders['name']; ?></span></p>
      <p>E-mail : <span><?= $fetch_orders['email']; ?></span></p>
      <p>Número : <span><?= $fetch_orders['number']; ?></span></p>
      <p>Endereço : <span><?= $fetch_orders['address']; ?></span></p>
      <p>Método de pagamento : <span><?= $fetch_orders['method']; ?></span></p>
      <p>Seus pedidos : <span><?= $fetch_orders['total_products']; ?></span></p>
      <p>Preço Total : <span>R$<?= $fetch_orders['total_price']; ?>/-</span></p>
      <p>Status do pagamento : <span style="color:<?php if($fetch_orders['payment_status'] == 'Pendente'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
   </div>
   <?php
      }
      }else{
         echo '<p class="empty">Não há nenhum pedido!</p>';
      }
      }
   ?>

   </div>

</section>










<!-- começo da section footer  -->
<?php include 'components/footer.php'; ?>
<!-- fim da section footer -->






<!-- arquivo js  -->
<script src="js/script.js"></script>

</body>
</html>