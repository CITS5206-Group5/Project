<?php
class SMTP {
    public $username;
    public $password;
    public $host;
    public $from;
    public $port;
    public $charset;
    public $boundary;
    public $addFile = false;
    public $multipart = '';

    public function __construct($from, $username, $password, $host, $port = '25', $charset = 'utf-8') {
        $this->from = $from;
        $this->username = $username;
        $this->password = $password;
        $this->host = $host;
        $this->port = $port;
        $this->charset = $charset;
        $this->boundary = "--".md5(uniqid(time()));
    }

    function send($to, $subject, $message) {
        $contentMail = $this->getContentMail($subject, $message, $to);
        try {
            if(!$socket = @fsockopen($this->host, $this->port, $errorNumber, $errorDescription, 30)){
                throw new Exception($errorNumber.".".$errorDescription);
            }
            if (!$this->_parseServer($socket, "220")){
                throw new Exception('Connection error');
            }

            $server_name = $_SERVER["SERVER_NAME"];
            fputs($socket, "EHLO $server_name\r\n");
            if(!$this->_parseServer($socket, "250")){
                // если сервер не ответил на EHLO, то отправляем HELO
                fputs($socket, "HELO $server_name\r\n");
                if (!$this->_parseServer($socket, "250")) {
                    fclose($socket);
                    throw new Exception('Error of command sending: HELO');
                }
            }

            fputs($socket, "AUTH LOGIN\r\n");
            if (!$this->_parseServer($socket, "334")) {
                fclose($socket);
                throw new Exception('Autorization error');
            }

            fputs($socket, base64_encode($this->username) . "\r\n");
            if (!$this->_parseServer($socket, "334")) {
                fclose($socket);
                throw new Exception('Autorization error');
            }

            fputs($socket, base64_encode($this->password) . "\r\n");
            if (!$this->_parseServer($socket, "235")) {
                fclose($socket);
                throw new Exception('Autorization error');
            }

            fputs($socket, "MAIL FROM: <".$this->username.">\r\n");
            if (!$this->_parseServer($socket, "250")) {
                fclose($socket);
                throw new Exception('Error of command sending: MAIL FROM');
            }

            $to = str_replace(" ", "", $to);
            $emails_to_array = explode(',', $to);
            foreach($emails_to_array as $email) {
                fputs($socket, "RCPT TO: <{$email}>\r\n");
                if (!$this->_parseServer($socket, "250")) {
                    fclose($socket);
                    throw new Exception('Error of command sending: RCPT TO');
                }
            }

            fputs($socket, "DATA\r\n");
            if (!$this->_parseServer($socket, "354")) {
                fclose($socket);
                throw new Exception('Error of command sending: DATA');
            }

            fputs($socket, $contentMail."\r\n.\r\n");
            if (!$this->_parseServer($socket, "250")) {
                fclose($socket);
                throw new Exception("E-mail didn't sent");
            }

            fputs($socket, "QUIT\r\n");
            fclose($socket);
        } catch (Exception $e) {
            return  $e->getMessage();
        }
        return true;
    }


    // добавление файла в письмо
    public function addFile($path){
        $file = @fopen($path, "rb");
        if(!$file) {
            throw new Exception("File `{$path}` didn't open");
        }
        $data = fread($file,  filesize( $path ) );
        fclose($file);
        $filename = basename($path);
        $multipart  =  "\r\n--{$this->boundary}\r\n";
        $multipart .= "Content-Type: application/octet-stream; name=\"$filename\"\r\n";
        $multipart .= "Content-Transfer-Encoding: base64\r\n";
        $multipart .= "Content-Disposition: attachment; filename=\"$filename\"\r\n";
        $multipart .= "\r\n";
        $multipart .= chunk_split(base64_encode($data));

        $this->multipart .= $multipart;
        $this->addFile = true;
    }

    // парсинг ответа сервера
    private function _parseServer($socket, $response) {
        $responseServer = '';
        while (@substr($responseServer, 3, 1) != ' ') {
            if (!($responseServer = fgets($socket, 256))) {
                return false;
            }
        }
        if (!(substr($responseServer, 0, 3) == $response)) {
            return false;
        }
        return true;
    }

    // подготовка содержимого письма
    private function getContentMail($subject, $message, $to){
        // если кодировка windows-1251, то перекодируем тему
        if( strtolower($this->charset) == "windows-1251" ){
            $subject = iconv('utf-8', 'windows-1251', $subject);
        }
        $contentMail = "Date: " . date("D, d M Y H:i:s") . " UT\r\n";
        $contentMail .= 'Subject: =?' . $this->charset . '?B?'  . base64_encode($subject) . "=?=\r\n";

        // заголовок письма
        $headers = "MIME-Version: 1.0\r\n";
        // кодировка письма
        if($this->addFile){
            // если есть файлы
            $headers .= "Content-Type: multipart/mixed; boundary=\"{$this->boundary}\"\r\n";
        }else{
            $headers .= "Content-type: text/html; charset={$this->charset}\r\n";
        }
        $headers .= "From: {$this->from[0]} <{$this->from[1]}>\r\n"; // от кого письмо
        $headers.= "To: ".$to."\r\n"; // кому
        $contentMail .= $headers . "\r\n";

        if($this->addFile){
            // если есть файлы
            $multipart  = "--{$this->boundary}\r\n";
            $multipart .= "Content-Type: text/html; charset=utf-8\r\n";
            $multipart .= "Content-Transfer-Encoding: base64\r\n";
            $multipart .= "\r\n";
            $multipart .= chunk_split(base64_encode($message));

            // файлы
            $multipart .= $this->multipart;
            $multipart .= "\r\n--{$this->boundary}--\r\n";

            $contentMail .= $multipart;
        }else{
            $contentMail .= $message . "\r\n";
        }

        // если кодировка windows-1251, то все письмо перекодируем
        if( strtolower($this->charset) == "windows-1251" ){
            $contentMail = iconv('utf-8', 'windows-1251', $contentMail);
        }

        return $contentMail;
    }

}

$from = array(
    'innerworkscounselling',
    'litaoakes2@gmail.com'
);
$username = 'litaoakes2@gmail.com';
$password = '';
$host = 'ssl://smtp.gmail.com';
$port = '465';

$to      = 'k.tagintsev@gmail.com';