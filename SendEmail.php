<?php
//ARQUIVO RESPONSÁVEL PELO FRAMEWORK PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require __DIR__.'/vendor/autoload.php';
//Classe responsável por validar os dados vindos do formulário
class SendEmail{
    /** @method construtor da classe**/
    public function __construct()
    {
        return $this->contact();
    }
        /** @method responsável por configurar o PHPMailer**/
    private function contact()
    {
        /** @var responsável pela integração de dados vindos do formulário**/
        $this->name    = htmlspecialchars($_POST['name']);
        $this->email   = htmlspecialchars($_POST['email']);
        $this->message = htmlspecialchars($_POST['message']);
            //condição que verifica o click no botão enviar do email
        if (isset($_POST['btn-sendEmail'])) {
                    /** @var @return object da classe PHPMailer**/
                $mail = new PHPMailer(true);
                // condição que realiza as configurações de envio de mail
                try {
                        //configurações do servidor
                    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;//Enable verbose debug output
                    $mail->isSMTP(); //Send using SMTP
                    $mail->Host       = 'sandbox.smtp.mailtrap.io';//Set the SMTP server to send through
                    $mail->SMTPAuth   = true; //Enable SMTP authentication
                    $mail->Username   = '5d57087a6829b8'; //SMTP username
                    $mail->Password   = 'bf8d0d3e5cc2ed'; //SMTP password
                    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;//configurar o atributo de segurança da hospedagem[TLS/SSH]            //Enable implicit TLS encryption
                    $mail->Port       = 2525;
                        //Recipients
                    $mail->setFrom($this->email, $this->name);
                    $mail->addAddress('joe@example.net', 'Joe User'); //Add a recipient
                        //Content
                      $mail->isHTML(true); //Set email format to HTML
                      $mail->Subject = '<b>titulo do email<b>';
                      $mail->Body    = 'Mensagem:'.$this->message;
                        // executa o método do PHPMailer
                      $mail->send();
                      // retorna uma mensagem de sucesso
                      $this->msg = json_encode(["error" => false,"msg" => "Mensagem enviada com sucesso"],JSON_UNESCAPED_UNICODE);
                          print $this->msg;
                              exit;
                } catch (\Exception $e) {
                        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        // retorna uma mensagem de erro
                    $this->msg = json_encode(["error" => true,"msg" => "Não foi possível enviar a mensagem: Verifique sua conexão com a internet! Tente Novamente mais tarde"],JSON_UNESCAPED_UNICODE);
                        print $this->msg;
                            exit;
                }
            }
        }
    }
