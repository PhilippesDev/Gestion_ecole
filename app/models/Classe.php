<?php

require_once './../../core/Model.php';

class Classe extends Model
{
    public $id;

    public $id_option;
    public $designation;
    public $description;

    public function createClasse($designation, $description, $id_option)
    {
        $this->designation = $designation;
        $this->description = $description;
        $this->id_option = $id_option;

        $request = $this->db->prepare("INSERT INTO t_classe (designation, description, id_option) VALUES (?, ?, ?)");
        return $request->execute([$this->designation, $this->description, $this->id_option]);
    }

    public function updateClasse($id, $designation, $description, $id_option)
    {
        $this->id = $id;
        $this->designation = $designation;
        $this->description = $description;
        $this->id_option = $id_option;

        $request = $this->db->prepare("UPDATE t_classe SET designation = ?, description = ?, id_option = ? WHERE id_classe = ?");
        return $request->execute([$this->designation, $this->description, $this->id_option, $this->id]);
    }

    public function deleteClasse($id)
    {
        $this->id = $id;
        $request = $this->db->prepare("DELETE FROM t_classe WHERE id_classe = ?");
        return $request->execute([$this->id]);
    }

    public function getAllClasses()
    {
        $request = $this->db->query("
            SELECT c.*, o.designation as option_nom 
            FROM t_classe c 
            LEFT JOIN t_option o ON c.id_option = o.id_option
        ");
        return $request->fetchAll();
    }

    public function getClasseById($id)
    {
        $request = $this->db->prepare("SELECT * FROM t_classe WHERE id_classe = ?");
        $request->execute([$id]);
        return $request->fetch();
    }

    public function searchClasse($keyword)
    {
        $request = $this->db->prepare("
            SELECT c.*, o.designation as option_nom 
            FROM t_classe c 
            LEFT JOIN t_option o ON c.id_option = o.id_option 
            WHERE c.designation LIKE ? OR c.description LIKE ?
        ");
        $request->execute(["%$keyword%", "%$keyword%"]);
        return $request->fetchAll();
    }
}

?>
