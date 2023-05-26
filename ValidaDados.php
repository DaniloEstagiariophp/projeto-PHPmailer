<?php
//ARQUIVO RESPONSÁVEL POR VALIDAR OS DADOS VINDOS DO FORMULÁRIO
class ValidaDadosForm{
        /** @var string[recebe/o/nome/do/usuário]**/
    private $name;
        /** @var string[recebe/o/email/do/usuário]**/
    private $email;
        /** @var string[recebe/a/mensagem/do/usuário]**/
    private $message;
        /** @var array[armazena/menssagens/de/interação/com/usuário]**/
    private $msg = [];
    //método construtor da classe
    public function __construct()
    {
            //retorna o método setDadosForm
        return $this->setDadosForm();
    }
        /** @method responsável por receber os atributos da método setName***/
    private function setDadosForm()
    {
            //condição que verifica o click no botão de envio do formulário
        if (isset($_POST['btn-sendEmail'])) {
                //retorna o método private setName
            return $this->setName();
        }
    }
        /** @method responsável validar o campo nome do formulário e por receber os atributos da método setEmail**/
    private function setName()
    {
            //recebe os dados do campo nome, e realiza a validação de entrada e saída de dados
        $this->name = htmlspecialchars($_POST['name']);
            // condição que verifica se o campo nome não está vazio
        if (!empty($this->name)) {
                    //retorna o método private setEmail
                return $this->setEmail();
                    exit;
            }
                //mensagem de erro do campo Nome
            $this->msg = json_encode(["error" => true,"msg" => "Preencha o campo Nome!"],JSON_UNESCAPED_UNICODE);
                print $this->msg;
                    exit;
    }
        /** @method responsável validar o campo email do formulário e por receber os atributos da método setMessage**/
    private function setEmail()
    {
            //recebe os dados do campo email, e realiza a validação de entrada e saída dos dados
        $this->email = htmlspecialchars($_POST['email']);
        // condição que verifica se o campo email não está vazio
        if (!empty($this->email)) {
                //retorna o método private setMessage
            return $this->setMessage();
        }
            //mensagem de erro do campo E-mail
        $this->msg = json_encode(["error" => true,"msg" => "Preencha o campo E-mail!"],JSON_UNESCAPED_UNICODE);
            print $this->msg;
                exit;
    }
        /** @method responsável validar o campo mensagem do formulário e por receber uma instância da classe SendEmail**/
    private function setMessage()
    {
        //recebe os dados do campo mensagem, e realiza a validação de entrada e saída de dados
        $this->message = htmlspecialchars($_POST['message']);
            //condição que verifica se o campo de mensagem não está vazio
        if (!empty($this->message)) {
            require("SendEmail.php");
                //retorna um objeto da classe SendEmail
            $push = new SendEmail();
                exit;
        }
            //mensagem de erro do campo Mensagem
        $this->msg = json_encode(["error" => true,"msg" => "Necessário preencher o campo com a mensagem!"],JSON_UNESCAPED_UNICODE);
            print $this->msg;
                exit;
    }
}
