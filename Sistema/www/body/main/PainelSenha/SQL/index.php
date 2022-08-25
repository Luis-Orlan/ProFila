<?php

$sql_N2 = "SELECT * FROM `tb_atendimentosenha` WHERE `as_StatusAloca` = 1 AND `as_NivelPrioridade` = 2 ORDER BY `tb_atendimentosenha`.`as_DataHora` ASC, `tb_atendimentosenha`.`as_ID` DESC LIMIT 1";

$sql_N1 = "SELECT * FROM `tb_atendimentosenha` WHERE `as_StatusAloca` = 1 AND `as_NivelPrioridade` = 1 ORDER BY `tb_atendimentosenha`.`as_DataHora` ASC, `tb_atendimentosenha`.`as_ID` DESC LIMIT 1";

$submit_N2 = \Sistema\Controle\Conexao::conectar()->prepare($sql_N2);
$submit_N2->execute();

if ($submit_N2->rowCount() > 0){
    $s_ = $submit_N2->fetchAll(\PDO::FETCH_ASSOC);
    
    $setor =$s_[0]['as_Setor'];
    $sql_Mesa = "SELECT * FROM `tb_mesaatendimento` 
                     WHERE `ma_SenhaAlocada` = 1 
                     AND `ma_Setor` = '$setor'
                     ORDER BY `tb_mesaatendimento`.`ma_DataHora` DESC, `tb_mesaatendimento`.`ma_ID` DESC LIMIT 1";

    $submit_Mesa = \Sistema\Controle\Conexao::conectar()->prepare($sql_Mesa);
    $submit_Mesa->execute();

    if ($submit_Mesa->rowCount() > 0){
        $r_ = $submit_Mesa->fetchAll(\PDO::FETCH_ASSOC);
            foreach($s_ AS $painel){
                foreach($r_ as $data){
                        $update_SQL = "UPDATE `tb_atendimentosenha` SET `as_NumeroMesa` = '".$data['ma_Mesa']."' WHERE `tb_atendimentosenha`.`as_SenhaPainel` = '".$painel['as_SenhaPainel']."' ";
                        $submit_SQL= \Sistema\Controle\Conexao::conectar()->prepare($update_SQL);
                        $submit_SQL->execute();
                    
                }
            }
    }
}else{
    $submit_N1 = \Sistema\Controle\Conexao::conectar()->prepare($sql_N1);
    $submit_N1->execute();

    

    if ($submit_N1->rowCount() > 0){
            $s_ = $submit_N1->fetchAll(\PDO::FETCH_ASSOC);
            $setor =$s_[0]['as_Setor'];
            $sql_Mesa = "SELECT * FROM `tb_mesaatendimento` 
                         WHERE `ma_SenhaAlocada` = 1 
                         AND `ma_Setor` = '$setor'
                         ORDER BY `tb_mesaatendimento`.`ma_DataHora` DESC LIMIT 1";

            $submit_Mesa = \Sistema\Controle\Conexao::conectar()->prepare($sql_Mesa);
            $submit_Mesa->execute();

            if ($submit_Mesa->rowCount() > 0){
                $r_ = $submit_Mesa->fetchAll(\PDO::FETCH_ASSOC);
                    foreach($s_ AS $painel){
                        foreach($r_ as $data){
                                $update_SQL = "UPDATE `tb_atendimentosenha` SET `as_NumeroMesa` = '".$data['ma_Mesa']."' WHERE `tb_atendimentosenha`.`as_SenhaPainel` = '".$painel['as_SenhaPainel']."' ";
                                $submit_SQL= \Sistema\Controle\Conexao::conectar()->prepare($update_SQL);
                                $submit_SQL->execute();
                            
                        }
                    }
            }
        }
}

$sql_OLD = "SELECT * FROM `tb_atendimentosenha` WHERE `as_NumeroMesa` > 0 AND `tb_atendimentosenha`.`as_StatusAloca` = '3' ORDER BY `as_DataHora` DESC LIMIT 4 ";

$submit_OLD = \Sistema\Controle\Conexao::conectar()->prepare($sql_OLD);
$submit_OLD->execute();
if ($submit_OLD->rowCount() > 0) {    
    $data_old = $submit_OLD->fetchAll(\PDO::FETCH_ASSOC);
}
?>