<?php
    include_once realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FInterface.php");
    
    class EReport implements FInterface{

        private $id;
        private $idUser;
        private $idPost;
        private $idComment;
        private $type;
        private $description;
        private $date;

        public function __construct(int $id, int $idUser, int $idToReport, string $type, string $description, $date) {
            $this->id = $id;
            $this->idUser = $idUser;
            $this->type = $type;
            if($type == "comment"){
                $this->idComment = $idToReport;
                $this->idPost = null;
            } else if($type == "post"){
                $this->idPost = $idToReport;
                $this->idComment = null;
            }
            $this->description = $description;
            $this->date = $date;
        }
        
        public function getValues() {
            $v = array(
                "id" => $this->id,
                "idUser" => $this->idUser,
                "idPost" => $this->idPost,
                "idComment" => $this->idComment,
                "type" => $this->type,
                "description" => $this->description,
                "datetime" => $this->date,
            );
            return $v;
        }
    }
?>