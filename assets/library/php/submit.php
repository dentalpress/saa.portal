<?php

    ini_set('display_errors', 1);

    // $post['origem'] = 'http://192.168.10.106/cursos/excelencia/implantodontia/';
    // $post['curso']['nome'] = 'Excelência na Implantodontia';
    // $post['Name'] = 'Fernando';
    // $post['Phone'] = '11 1111-1111';
    // $post['Email'] = 'webmaster@dentalpress.com.br';
    // $post['Msg'] = 'mensagem escrita';

    $post = $_POST;

    // processo o titulo para um html especial
    // $post['curso']['nome'] = htmlspecialchars($post['curso']['nome']);

    // include_once('../../../../_assets/php/PHPMailer_v5.1/class.phpmailer.php');

    // Valida a origem do post
    if ($post['origem'] != '') {
        include_once('../../../../_assets/php/PHPMailer_v5.1/class.phpmailer.php');

        $body = '
            <html>
                <meta charset="utf-8" >
                <head>
                    <style type="text/css">
                        *{ margin:0; padding:0;}
                    </style>
                </head>
                <body>

                    <h4>Contato cursos: '.$post['curso']['nome'].' - '.$post['Name'].'</h4>

                    <strong>Nome:</strong> '.$post['Name'].'<br>
                    <strong>Telefone:</strong> '.$post['Phone'].'<br>
                    <strong>Email:</strong> '.$post['Email'].'<br>
                    <strong>Msg:</strong> '.$post['Msg'].'<br>
                    <br>
                    <i style="color:#bebebe">Origem: '.$post['origem'].'</i><br>
                </body>
            </html>
        ';

        $mail = new PHPMailer();
        
        $mail->IsHTML(true);   
        $mail->ContentType = "text/html";
        $mail->SetLanguage("br");
        //        $mail->SMTPSecure    = "ssl";
        $mail->Host            = "smtp.dentalpress.com.br";
        //$mail->Port            = 465;
        $mail->CharSet        = "iso-8859-1";    
        
        $mail->IsSMTP();                      
        $mail->SMTPAuth = true;     
        $mail->Username = 'site@dentalpress.com.br';
        $mail->Password = 'site753';
        
        $mail->IsSMTP();
        $mail->SMTPAuth   = true; // enable SMTP authentication
        
        $mail->From     = $mail->Username;
        $mail->FromName = html_entity_decode( 'Contato cursos: '.$post['curso']['nome'].' - '.$post['Name']);
        $mail->Subject  = html_entity_decode( 'Contato cursos: '.$post['curso']['nome'].' - '.$post['Name']);

        $mail->AltBody    = $altBody; //Text Body
        $mail->WordWrap   = 50; // set word wrap
        
        $mail->MsgHTML($body);
        
        $mail->AddReplyTo($post['Email']);

        $mail->AddAddress('dental@dentalpress.com.br');
        $mail->AddAddress('cursos1@dentalpress.com.br');
        $mail->AddAddress('cursos2@dentalpress.com.br');
        $mail->AddAddress('cursos3@dentalpress.com.br');
        $mail->AddAddress('cursos4@dentalpress.com.br');
        $mail->AddAddress('cursos5@dentalpress.com.br');

        if(!$mail->Send()) {
            #não enviado
            $return = 'não enviado';
        } 
        else {
            #enviado
            $return = 'enviado';
        }

        //  retorna ao json
        echo $return;
    }




?>