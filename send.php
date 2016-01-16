<?php
  // Clean up the input values
  /*foreach ( $_POST as $key => $value ) {
    if ( ini_get( 'magic_quotes_gpc' ) ) {
      $_POST[ $key ] = stripslashes( $_POST[ $key ] );
    }
    $_POST[ $key ] = htmlspecialchars( strip_tags( $_POST[ $key ] ) );
  }*/
  $quebra_linha = PHP_EOL;

  //print_r($_POST);

  /** Modal de Contato */


    // Assign the input values to variables for easy reference
    $nome     = $_POST["name"];
    $company   = $_POST['company'];
    $email     = $_POST['email'];
    $to       = "cristiano-acosta@hotmail.com";
    $subject  = $_POST["nome_formulario"]." Responder para: $nome";
    $message  = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	    <html xmlns="http://www.w3.org/1999/xhtml">
	    <head>
	    <title>Lotadata - Spatiotemporal Intelligence - Contato</title>
	    <style type="text/css">
            .ReadMsgBody {  width: 100%; }
            .ExternalClass {  width: 100%; background-color:#e7e8e9 !important; }
            .yshortcuts {color: #2979be;}
            body { background-color: #e7e8e9;}
      </style>
	    </head>
	    <body style="background-color:#e7e8e9;">
	      <table border="0" cellspacing="0" cellpadding="0" align="center" style="width: 90%; background-color:#ffffff; padding: 10px;">
          <thead>
            <tr>
              <td colspan="3" style="background-color: #4e4e4; color: #ffffff; font-size: 20px;" align="center" valign="middle">
                <img src="http://maisinsight.com.br/img/layout_lotadata-assets/logo-lotadata-h.png" alt="" width="188" height="41" border="0" />
              </td>
            </tr>
            <tr><th  colspan="3"><h1>Contato Recebido</h1></th><!--<th ></th><th></th>--></tr>
          </thead>
          <tbody>
            <tr><td colspan="3">Entrou em contato:</td></tr>
            <tr><td colspan="3"><strong>Dados do Contato</strong></td></tr>
            <tr><td >Nome</td><td colspan="2">' . $nome . '</td></tr>
            <tr><td>E-mail</td><td colspan="2">' . $email . '</td></tr>
            <tr><td>Telefone</td><td colspan="2">' . $telefone . '</td></tr>
            <tr><td colspan="3">Interesse</td></tr>
            <tr><td colspan="3">' . $_POST['radios'] . '</td></tr>
          </tbody>
        </table>
	    </body>
	    </html>';
    /* Montando o cabeçalho da mensagem */
    // Este sempre deverá existir para garantir a exibição correta dos caracteres
    $headers = "MIME-Version: 1.1" . $quebra_linha;
    // Para enviar o e-mail em formato texto com codificação de caracteres Europeu Ocidental (usado no Brasil)
    $headers .= "Content-type: text/html; charset=iso-8859-1" . $quebra_linha;
    $headers .= "From: Agencia MaisInsight Comunicação Sustentável <" . $to . ">" . $quebra_linha; // remetente
    $headers .= "Return-Path: Agencia MaisInsight Comunicação Sustentável <" . $to . ">" . $quebra_linha;
    // E-mail que receberá a resposta quando se clicar no 'Responder' de seu leitor de e-mails
    $headers .= "Reply-To: " . $nome . "<" . $email . ">" . $quebra_linha;
    // Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)
    if ( mail( $to, $subject, utf8_decode( $message ), $headers ) ) { // Se for Postfix
      mail( "cristiano@insight.art.br", $subject, utf8_decode( $message ), $headers );
      $message_2  = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <title>Lotadata - Spatiotemporal Intelligence - Contato</title>
        <style type="text/css">
              .ReadMsgBody {  width: 100%; }
              .ExternalClass {  width: 100%; background-color:#e7e8e9 !important; }
              .yshortcuts {color: #2979be;}
              body { background-color: #e7e8e9;}
        </style>
        </head>
        <body style="background-color:#e7e8e9;">
          <table border="0" cellspacing="0" cellpadding="0" align="center" style="width: 90%; background-color:#ffffff; padding: 10px;">
            <thead>
              <tr>
                <td colspan="3" style="background-color: #4e4e4; color: #ffffff; font-size: 20px;" align="center" valign="middle">
                  <img src="http://maisinsight.com.br/img/layout_lotadata-assets/logo-lotadata-h.png" alt="" width="188" height="41" border="0" />
                </td>
              </tr>
              <tr><th  colspan="3"><h1>Olá,</h1></th><!--<th ></th><th></th>--></tr>
            </thead>
            <tbody>
              <tr><td colspan="3">' . $nome . ', em breve estaremos entrando em contato com você.</td></tr>
            </tbody>
          </table>
        </body>
        </html>';
      mail( $email, $subject, utf8_decode( $message_2 ), $headers );
      die( "<span class='label label-success'>Sua mensagem foi enviada.</span>" );
    } else {
      die( "<span class='label label-danger'>Sua mensagem não foi enviada.</span>" );
    }

