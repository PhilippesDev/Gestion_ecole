<?php

require_once "../core/Model.php";

class Inscription extends Model
{
    public $id_eleve;
    public $id_classe;
    public $id_annee_scolaire;
    public $date_inscription;

    public function createInscription($id_eleve, $id_classe, $id_annee_scolaire)
    {
        
        $check = $this->db->prepare("SELECT * FROM t_inscrire WHERE id_eleve = ? AND id_classe = ? AND id_annee_scolaire = ?");
        $check->execute([$id_eleve, $id_classe, $id_annee_scolaire]);
        
        if ($check->rowCount() > 0) {
            return false;
        }

        $this->id_eleve = $id_eleve;
        $this->id_classe = $id_classe;
        $this->id_annee_scolaire = $id_annee_scolaire;
        $this->date_inscription = date('Y-m-d');

        $request = $this->db->prepare("INSERT INTO t_inscrire (id_eleve, id_classe, id_annee_scolaire, date_inscription) VALUES (?, ?, ?, ?)");
        return $request->execute([$this->id_eleve, $this->id_classe, $this->id_annee_scolaire, $this->date_inscription]);
    }

    public function deleteInscription($id_eleve, $id_classe, $id_annee_scolaire)
    {
        $request = $this->db->prepare("DELETE FROM t_inscrire WHERE id_eleve = ? AND id_classe = ? AND id_annee_scolaire = ?");
        return $request->execute([$id_eleve, $id_classe, $id_annee_scolaire]);
    }

    public function getStudentClasses($id_eleve)
    {
        $request = $this->db->prepare("
            SELECT i.*, c.designation as classe_nom, a.designation as annee_nom 
            FROM t_inscrire i 
            JOIN t_classe c ON i.id_classe = c.id_classe 
            JOIN t_annee_scolaire a ON i.id_annee_scolaire = a.id_annee 
            WHERE i.id_eleve = ?
        ");
        $request->execute([$id_eleve]);
        return $request->fetchAll();
    }

    public function getClassStudents($id_classe)
    {
        $request = $this->db->prepare("
            SELECT i.*, e.nom, e.postnom, e.prenom, a.designation as annee_nom 
            FROM t_inscrire i 
            JOIN t_eleve e ON i.id_eleve = e.id_eleve 
            JOIN t_annee_scolaire a ON i.id_annee_scolaire = a.id_annee 
            WHERE i.id_classe = ?
        ");
        $request->execute([$id_classe]);
        return $request->fetchAll();
    }

    public function getAllInscriptions()
    {
        $request = $this->db->query("
            SELECT i.*, e.nom as eleve_nom, e.postnom, e.prenom, c.designation as classe_nom, a.designation as annee_nom 
            FROM t_inscrire i 
            JOIN t_eleve e ON i.id_eleve = e.id_eleve 
            JOIN t_classe c ON i.id_classe = c.id_classe 
            JOIN t_annee_scolaire a ON i.id_annee_scolaire = a.id_annee
        ");
        return $request->fetchAll();
    }
}
?>

