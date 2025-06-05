<?php 
    class MensajesModel extends Mysql{
        private $strMessage;
        private $intIdMessage;
        private $strEmail;
        private $strSubject;

        public function __construct(){
            parent::__construct();
        }
        /*************************Mailbox methods*******************************/
        public function selectMensajes(){
            $sql = "SELECT * ,DATE_FORMAT(date, '%d/%m/%Y') as date FROM contact ORDER BY id DESC";       
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectSentMails(){
            $sql = "SELECT * ,DATE_FORMAT(date, '%d/%m/%Y') as date FROM sendmessage ORDER BY id DESC";       
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectMail(int $id){
            $sql = "UPDATE contact SET status=? WHERE id = $id";
            $arrData = array(1);
            $request = $this->update($sql,$arrData);
            $sql = "SELECT *, DATE_FORMAT(date, '%d/%m/%Y') as date, DATE_FORMAT(date_updated, '%d/%m/%Y') as dateupdated FROM contact WHERE id=$id";
            $request = $this->select($sql);
            return $request;
        }
        public function selectSentMail(int $id){
            $sql = "SELECT *, DATE_FORMAT(date, '%d/%m/%Y') as date FROM sendmessage WHERE id=$id";
            $request = $this->select($sql);
            return $request;
        }
        public function updateMessage($strMessage,$idMessage){
            $this->strMessage = $strMessage;
            $this->intIdMessage = $idMessage;
            $sql = "UPDATE contact SET reply=?, date_updated=NOW() WHERE id = $this->intIdMessage";
            $arrData = array($this->strMessage);
            $request = $this->update($sql,$arrData);
            return $request;
        }
        public function insertMessage($strSubject,$strEmail,$strMessage){
            $this->strMessage = $strMessage;
            $this->strEmail = $strEmail;
            $this->strSubject = $strSubject;

            $sql = "INSERT INTO sendmessage(email,subject,message) VALUES(?,?,?)";
            $arrData = array($this->strEmail,$this->strSubject,$this->strMessage);
            $request = $this->insert($sql,$arrData);
            return $request;
        }
        public function delEmail($id,$option){
            $sql ="";
            if($option == 1){
                $sql = "DELETE FROM contact WHERE id =$id";
            }else{
                $sql = "DELETE FROM sendmessage WHERE id =$id";
            }
            $request = $this->delete($sql);
            return $request;
        }
    }
?>