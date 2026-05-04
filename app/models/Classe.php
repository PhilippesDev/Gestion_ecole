<?php

require_once "./../../core/Model.php";

class Classe extends Model
{
    public $id;
    public $id_option;
    public $designation;
    public $description;
   

    public function CreateClasse ($design, $desc, $id_opt)
    {
        $this->designation = $design;
        $this->description = $desc;
        $this->id_option = $id_opt;
        $requette = $this->db->prepare('INSERT INTO t_classe (designation,description,id_option) VALUES (?, ?, ?)');
        $requette->execute([$this->designation, $this->description, $this->id_option]);
    }

    public function UpdateClasse ($design, $desc, $id_opt)
    {
        $this->designation = $design;
        $this->description = $desc;
        $this->id_option = $id_opt;
        $requette = $this->db->prepare('UPDATE t_classe SET designation = ?, description = ?, id_option = ? WHERE id_classe = ?');
        $requette->execute ([ $this->designation, $this->description]);
    }

    public function DeleteClasse ($id)
    {
        $this->id = $id;
        $requette = $this->db-> prepare('DELETE FROM t_classe WHERE id_classe = ?');
        return $requette->execute([$this->id]);
    }
    
    public function getAllClass ()
    {
        $requette = $this->db->prepare('SELECT * FROM t_classe');
        $requette->execute([]);
        return $requette->fetchAll();

    }
    public function searchClasse($keyword)
      {
         $request = $this->db->prepare("SELECT * FROM t_classe WHERE designation LIKE ?");
         $request->execute(["%$keyword%"]);
         return $request->fetchAll();
      }
}
?>
