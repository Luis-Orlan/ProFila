<?php
$sql_0 = "SELECT 
`p`.`as_ID`,
`p`.`as_Setor`,
`p`.`as_SenhaPainel`,
`p`.`as_NumeroMesa`,
`p`.`as_NivelPrioridade`,
`m`.`ma_Mesa`
FROM 
`tb_atendimentosenha` AS `p`
INNER JOIN
`tb_mesaatendimento` AS `m`
ON 
    `m`.`ma_Setor` = `p`.`as_Setor`
WHERE
    (`p`.`as_NivelPrioridade` = 2 )
AND
    (`p`.`as_StatusAloca` = 1 )
AND 
    (`m`.`ma_SenhaAlocada` = 1 )
GROUP BY 
`p`.`as_ID`
ORDER BY 
`p`.`as_DataHora` DESC,
`m`.`ma_Mesa` ASC
LIMIT 1";

$sql_1 = "SELECT 
    `p`.`as_ID`,
    `p`.`as_Setor`,
    `p`.`as_SenhaPainel`,
    `p`.`as_NumeroMesa`,
    `p`.`as_NivelPrioridade`,
    `m`.`ma_Mesa`
FROM 
    `tb_atendimentosenha` AS `p`
INNER JOIN
    `tb_mesaatendimento` AS `m`
ON 
        `m`.`ma_Setor` = `p`.`as_Setor`
WHERE
    (`p`.`as_StatusAloca` = 1 )
AND 
    (`m`.`ma_SenhaAlocada` = 1 )
AND
    (`p`.`as_NivelPrioridade` = 1 )
GROUP BY 
    `p`.`as_ID`
ORDER BY 
`p`.`as_DataHora` DESC,
`m`.`ma_Mesa` ASC
LIMIT 1";

$sql_2 = "SELECT 
	`p`.`as_ID`,
    `p`.`as_Setor`,
    `p`.`as_SenhaPainel`,
    `p`.`as_NumeroMesa`,
    `p`.`as_NivelPrioridade`,
    `m`.`ma_Mesa`
FROM 
	`tb_atendimentosenha` AS `p`
INNER JOIN
	`tb_mesaatendimento` AS `m`
ON 
	`m`.`ma_Setor` = `p`.`as_Setor`
WHERE
	`p`.`as_StatusAloca` = 3   
GROUP BY 
	`p`.`as_ID`
ORDER BY 
	`p`.`as_DataHora` DESC,
	`m`.`ma_Mesa` ASC
LIMIT 4
";

$submit_0 = \Sistema\Controle\Conexao::conectar()->prepare($sql_0);
$submit_0->execute();

if ($submit_0->rowCount() > 0) {
	$data = $submit_0->fetchAll(\PDO::FETCH_ASSOC); 
}else{
    $submit_1 = \Sistema\Controle\Conexao::conectar()->prepare($sql_1);
    $submit_1->execute();

    if ($submit_1->rowCount() > 0){
        $data = $submit_1->fetchAll(\PDO::FETCH_ASSOC); 
    }
}

$submit_2= \Sistema\Controle\Conexao::conectar()->prepare($sql_2);
$submit_2->execute();
if ($submit_2->rowCount() > 0) {	$data_old = $submit_2->fetchAll(\PDO::FETCH_ASSOC); }
?>

