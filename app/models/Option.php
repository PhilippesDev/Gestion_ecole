<?php

require_once "../core/Model.php";

class Option extends Model
{
    public $id;
    public $designation;
    public $code;
   
    public function createOption($designation, $code)
     {
        $this->designation = $designation;
        $this->code = $code;  

        $request = $this->db->prepare("INSERT INTO t_option(designation, code) VALUES (?, ?)");
        $request->execute([$this->designation, $this->code]);
     }

     public function updateOption($id, $designation, $code)
    {
        $this->id = $id;
        $this->designation = $designation;
        $this->code = $code;

        $request = $this->db->prepare("UPDATE t_option SET designation =?, code =? WHERE id_option =?");
        $request->execute([$this->designation, $this->code, $this->id]);
     }

     public function deleteOption($id)
     {
         $this->id = $id;
         $request = $this->db->prepare("DELETE FROM t_option WHERE id_option =?");
         $request->execute([$this->id]);
     }

      public function getAllOptions()
      {
         $request = $this->db->prepare("SELECT * FROM t_option");
         $request->execute([]);
         return $request->fetchAll();
      }

      public function searchOption($keyword)
      {
         $request = $this->db->prepare("SELECT * FROM t_option WHERE CONCAT(designation, code) LIKE ?");
         $request->execute(["%$keyword%"]);
         return $request->fetchAll();
      }
}
