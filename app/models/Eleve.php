<?php

require_once "./core/Model.php";

class Eleve extends Model
{
    public $id;
    public $nom;
    public $postnom;
    public $prenom;
    public $sexe;
    public $date_naissance;
    public $lieu_naissance;
    public $noms_pere;
    public $noms_mere;
    public $adresse;
    public $contact_pere;
    public $contact_mere;

    public function createEleves($nom, $postnom, $prenom, $sexe, $date_naissance, $lieu_naissance,$noms_pere, $noms_mere,$adresse, $contact_pere, $contact_mere) 
     {
        $this->nom = $nom;
        $this->postnom = $postnom;
        $this->prenom = $prenom;
        $this->sexe = $sexe;
        $this->date_naissance = $date_naissance;
        $this->lieu_naissance = $lieu_naissance;
        $this->noms_pere = $noms_pere;
        $this->noms_mere = $noms_mere;
        $this->adresse = $adresse;
        $this->contact_pere = $contact_pere;
        $this->contact_mere = $contact_mere;

        $request = $this->db->prepare("INSERT INTO t_eleve(nom, postnom, prenom, sexe, date_naissance,
                              lieu_naissance,nom_pere, nom_mere, addresse, contact_pere, contact_mere)
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

         $request->execute([$this->nom, $this->postnom, $this->prenom, $this->sexe, $this->date_naissance, 
                           $this->lieu_naissance, $this->noms_pere, $this->noms_mere, $this->adresse,
                           $this->contact_pere, $this->contact_mere]);
     }

     public function updateEleve($id, $nom, $postnom, $prenom, $sexe, $date_naissance, $lieu_naissance,$noms_pere, $noms_mere,$adresse, $contact_pere, $contact_mere) 
     {
         $this->id = $id;
         $this->nom = $nom;
         $this->postnom = $postnom;
         $this->prenom = $prenom;
         $this->sexe = $sexe;
         $this->date_naissance = $date_naissance;
         $this->lieu_naissance = $lieu_naissance;
         $this->noms_pere = $noms_pere;
         $this->noms_mere = $noms_mere;
         $this->adresse = $adresse;
         $this->contact_pere = $contact_pere;
         $this->contact_mere = $contact_mere; 

        $request = $this->db->prepare("UPDATE t_eleve SET nom =?, postnom =?, prenom =?, sexe =?, 
                                    date_naissance =?, lieu_naissance =?, nom_pere =?, nom_mere =?, 
                                    addresse =?, contact_pere =?, contact_mere =? WHERE id_eleve =?");

         $request->execute([$this->nom, $this->postnom, $this->prenom, $this->sexe, $this->date_naissance, 
                           $this->lieu_naissance, $this->noms_pere, $this->noms_mere, $this->adresse,
                           $this->contact_pere, $this->contact_mere, $this->id]);
     }

     public function deleteEleve($id)
     {
         $this->id = $id;
         $request = $this->db->prepare("DELETE FROM t_eleve WHERE id_eleve =?");
         $request->execute([$this->id]);
     }

      public function getAllEleve()
      {
         $request = $this->db->prepare("SELECT * FROM t_eleve");
         $request->execute([]);
         return $request->fetchAll();
      }

      public function searchEleve($keyword)
      {
         $request = $this->db->prepare("SELECT * FROM t_eleve WHERE CONCAT(nom, postnom, prenom, date_naissance,
                              addresse, contact_pere, contact_mere) LIKE ?");
         $request->execute(["%$keyword%"]);
         return $request->fetchAll();
      }
}
