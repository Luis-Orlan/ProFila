<?php
$sql = "SELECT * FROM `tb_mesaatendimento` GROUP BY `tb_mesaatendimento`.`ma_Setor` ORDER BY `tb_mesaatendimento`.`ma_Setor` ASC";
$submit = \Sistema\Controle\Conexao::conectar()->prepare($sql);
$submit->execute();

if ($submit->rowCount() > 0){
  $data = $submit->fetchAll(\PDO::FETCH_ASSOC);
?>
<main class="container  py-5">
  <div class="card-body text-center">
    <h5>Escolha a Mesa para o</h5>
    <h3 style="margin-top: -1.2rem;" class="p-2">Atendimento</h3>
    <p><sup>IP Alocado: <strong><?=IP_LOCAL?></strong></sup></p>
  </div>
  <div class="card-body text-center">
    <div class="btn-group-vertical col-12 col-md-8 col-lg-6">
      <?php foreach($data as $s_){ ?>
      <?php 
        $setor = str_replace(' ','-', $s_['ma_Setor']);
      ?>
      <a href="\Atendimento\<?php echo $setor; ?>" class="btn btn-outline-dark py-3" >
        <div class="card-body">
        <?php echo $s_['ma_Setor']; ?>
        </div>
      </a>
      <?php } ?>
    </div>
  </div>
  
  </main>
  <?php } ?>

  <?php
  if (!empty($_SESSION['mesaAtendimento']['mesa'])) {
    $mesa = $_SESSION['mesaAtendimento']['mesa'];
    $ip = IP_LOCAL;
    $sqli = "UPDATE `tb_mesaatendimento` SET `ma_SenhaAlocada` = '0', `ma_IP_Local_CloseMesa` = '$ip' WHERE `tb_mesaatendimento`.`ma_ID` = '$mesa'";

    $submiti = \Sistema\Controle\Conexao::conectar()->prepare($sqli);
    $submiti->execute();

    if ($submiti->rowCount() > 0) { 
      unset($_SESSION['mesaAtendimento']);
      unset($_SESSION['mesaAtendimento']['mesa']);
      unset($_SESSION['mesaAtendimento']['setor']);
    }
  }

  ?>
