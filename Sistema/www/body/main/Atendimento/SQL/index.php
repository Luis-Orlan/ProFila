<?php 
$setor = str_replace('-',' ', URL_1);
$sql = "SELECT * FROM `tb_mesaatendimento` WHERE `tb_mesaatendimento`.`ma_Setor` = '$setor' AND `ma_SenhaAlocada` = 0 ORDER BY `tb_mesaatendimento`.`ma_ID` ASC";
$submit = \Sistema\Controle\Conexao::conectar()->prepare($sql);
$submit->execute();

if ($submit->rowCount() > 0) {
    $data = $submit->fetchAll(\PDO::FETCH_ASSOC); 
}
?>