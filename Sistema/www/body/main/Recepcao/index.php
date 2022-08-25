<?php
$sql = "SELECT * FROM `tb_mesaatendimento` GROUP BY `tb_mesaatendimento`.`ma_Setor` ORDER BY `tb_mesaatendimento`.`ma_Setor` ASC";
$submit = \Sistema\Controle\Conexao::conectar()->prepare($sql);
$submit->execute();

if ($submit->rowCount() > 0){
  $data = $submit->fetchAll(\PDO::FETCH_ASSOC);
?>
<main class="container  py-5">
  <div class="card-body text-center">
    <h4>Recepção</h4>
    <h3 style="margin-top: -.6rem;" class="p-2 h6">Escolha para Gerar a Senha</h3>
    <p><sup>IP Alocado: <strong><?=IP_LOCAL?></strong></sup></p>

  </div>
  <div class="card-body text-center">
    <div class="btn-group-vertical col-12 col-md-8 col-lg-6">
      <?php foreach($data as $s_){ ?>
      <?php 
        $setor = str_replace(' ','-', $s_['ma_Setor']);
      ?>
      <a href="\Recepcao\<?php echo $setor; ?>" class="btn btn-outline-dark py-3" >
        <div class="card-body">
        <?php echo $s_['ma_Setor']; ?>
        </div>
      </a>
      <?php } ?>
    </div>
  </div>
  
  </main>
  <?php } ?>
