<?php

require ('./../../core/Model.php');

class AnneeScolaire extends Model
{
    public $id;
    public $designation;
   
    public function createAnneeScolaire($designation)
    {
        $this->designation = $designation;

        $request = $this->db->prepare("INSERT INTO t_annee_scolaire(designation) VALUES (?)");
        $request->execute([$this->designation]);
    }

     public function updateAnneeScolaire($id, $designation)
    {
        $this->id = $id;
        $this->designation = $designation;
    
        $request = $this->db->prepare("UPDATE t_annee_scolaire SET designation =? WHERE id_annee = ?");
        return $request->execute([$this->designation, $this->id]);
     }

     public function deleteAnneeScolaire($id)
     {
        $this->id = $id;
        $request = $this->db->prepare("DELETE FROM t_annee_scolaire WHERE id_annee =?");
        return $request->execute([$this->id]);
     }

      public function getAllAnneesScolaires()
      {
         $request = $this->db->prepare("SELECT * FROM t_annee_scolaire");
         $request->execute([]);
         return $resultat = $request->fetchAll();
      }

      public function searchAnneeScolaire($keyword)
      {
         $request = $this->db->prepare("SELECT * FROM t_annee_scolaire WHERE designation LIKE ?");
         $request->execute(["%$keyword%"]);
         return $request->fetchAll();
      }
}


?>