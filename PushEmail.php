<?php
//ARQUIVO RESPONSÁVEL POR ENVIAR OS DADOS DO FORMULÁRIO DE CONTATO PARA A CAIXA DE EMAIL!
require_once("ValidaDados.php");
    /** @var object[ValidaDados]  @return object e envia a mensagem para caixa de email**/
$formContact = new ValidaDadosForm();
