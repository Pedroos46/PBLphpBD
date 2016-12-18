<?php
/**
* @author Roger Pedrós Villorbina
*/
class MySQLcrud{
  private $url = '';
  private $user = '';
  private $pass = '';
  private $bd = '';

  function __construct($url, $user, $pass, $bd){
        $this->url=$url;
        $this->user=$user;
        $this->pass=$pass;
        $this->bd=$bd;
  }

  function __destruct(){}

  function BDconnection(){
        $db = new mysqli($this->url, $this->user, $this->pass);
        if ($db->connect_errno) {
            return false;
            exit;
        }
        $db->close();
  }

    //CRUD ASGINATURES

  function fillAsignatura($nomAsingatura, $DNIAlumne, $Nota){
//     if($this->BDconnection() == false){
//       return "Sense conexió amb la BD";
//       exit;
//     }
     try {
         $db = new mysqli($this->url, $this->user, $this->pass, $this->bd);

         $db->begin_transaction();

         $setencia = 'INSERT INTO asignatures(nom_asignatura,DNI_Alumne, Nota) VALUES (?, ?, ?)';
         $stmt = $db->prepare($setencia);
         $stmt->bind_param('ssi', $nomAsingatura, $DNIAlumne, $Nota);

         $stmt->execute();
         $stmt->close();

         $db->commit();
         return "S'ha insertat la informacio correctament";

         $db->close();
     } catch (Exception $e) {
         $db->rollback();
     }
  }

  function deleteAsignatura($nomAsingatura){
//     if($this->BDconnection() == false){
//       return "Sense conexió amb la BD";
//       exit;
//     }
      try {
         $db = new mysqli($this->url, $this->user, $this->pass, $this->bd);

         $db->begin_transaction();

         $setencia = 'DELETE FROM asignatures WHERE nom_asignatura = ?';
         $stmt = $db->prepare($setencia);
         $stmt->bind_param('s', $nomAsingatura);

         $stmt->execute();
         $stmt->close();

         $db->commit();
         return "S'ha eliminat la informacio correctament";

         $db->close();
     } catch (Exception $e) {
         $db->rollback();
     }
  }

  function updateAsignatura($nomAsingatura, $DNIAlumne, $Nota){
//      if ($this->BDconnection() == false) {
//          return "Sense conexió amb la BD";
//          exit;
//      }
      try {
          $db = new mysqli($this->url, $this->user, $this->pass, $this->bd);

          $db->begin_transaction();

          $setencia = 'UPDATE asignatures SET DNI_Alumne = ?, Nota = ?, WHERE nom_asignatura = ?)';
          $stmt = $db->prepare($setencia);
          $stmt->bind_param('sis', $DNIAlumne, $Nota, $nomAsingatura);

          $stmt->execute();
          $stmt->close();

          $db->commit();
          return "S'ha actualitzat la informacio correctament";

          $db->close();
        } catch (Exception $e) {
          $db->rollback();
      }
  }

  function getAsignaturaProf($nomAsignatura){
//      if ($this->BDconnection() == false) {
//          return "Sense conexió amb la BD";
//          exit;
//      }
      try {
          $db = new mysqli($this->url, $this->user, $this->pass, $this->bd);

          $db->begin_transaction();

          $setencia = 'SELECT * FROM asignatures WHERE nom_asignatura = ?';
          $stmt = $db->prepare($setencia);
          $stmt->bind_param('s', $nomAsignatura);

          $stmt->execute();
          $result = $stmt->get_result();
          while($respostes = $result->fetch_assoc()){
              $resposta[] = $respostes;
          }
          return $resposta;

          $stmt->close();
          $db->commit();

          $db->close();
        } catch (Exception $e) {
          $db->rollback();
      }
  }
  function getAsignaturaAlum($DNIAlumne){
//      if ($this->BDconnection() == false) {
//          return "Sense conexió amb la BD";
//          exit;
//      }
      try {
          $db = new mysqli($this->url, $this->user, $this->pass, $this->bd);

          $db->begin_transaction();

          $setencia = 'SELECT * FROM asignatures WHERE DNI_Alumne = ?';
          $stmt = $db->prepare($setencia);
          $stmt->bind_param('s', $DNIAlumne);

          $stmt->execute();
          $result = $stmt->get_result();

          while($respostes = $result->fetch_assoc()){
              $resposta[] = $respostes;
          }
          return $resposta;

          $stmt->close();
          $db->commit();

          $db->close();
        } catch (Exception $e) {
          $db->rollback();
      }
  }

    //CRUD PROFESOR

    function fillProfesors($DNIProfesor, $NomProfesor, $CognomProfesor, $Asignatura, $Contrasenya){
//     if($this->BDconnection() == false){
//       return "Sense conexió amb la BD";
//       exit;
//     }
     try {
         $db = new mysqli($this->url, $this->user, $this->pass, $this->bd);

         $db->begin_transaction();

         $setencia = 'INSERT INTO profesors(DNI_Profesor, nom, cognom, asignatura,contrasenya) VALUES (?, ?, ?, ?, ?)';
         $stmt = $db->prepare($setencia);
         $stmt->bind_param('sssss', $DNIProfesor, $NomProfesor, $CognomProfesor, $Asignatura, $Contrasenya);

         $stmt->execute();
         $stmt->close();

         $db->commit();
         return "S'ha insertat la informacio correctament";

         $db->close();
     } catch (Exception $e) {
         $db->rollback();
     }
  }

  function deleteProfesor($DNIProfesor){
//     if($this->BDconnection() == false){
//        return "Sense conexió amb la BD";
//        exit;
//     }
      try {
         $db = new mysqli($this->url, $this->user, $this->pass, $this->bd);

         $db->begin_transaction();

         $setencia = 'DELETE FROM profesors WHERE DNI_Profesor = ?';
         $stmt = $db->prepare($setencia);
         $stmt->bind_param('s', $DNIProfesor);

         $stmt->execute();
         $stmt->close();

         $db->commit();
         return "S'ha eliminat la informacio correctament";

         $db->close();
     } catch (Exception $e) {
         $db->rollback();
     }
  }

  function updateProfesor($DNIProfesor, $NomProfesor, $CognomProfesor, $Asignatura, $Contrasenya){
//      if ($this->BDconnection() == false) {
//          echo "Sense conexió amb la BD";
//          exit;
//      }
      try {
          $db = new mysqli($this->url, $this->user, $this->pass, $this->bd);

          $db->begin_transaction();

          $setencia = 'UPDATE asignatures SET nom = ?, cognom = ?, asignatura = ?, contrasenya = ?, WHERE DNI_Profesor = ?);';
          $stmt = $db->prepare($setencia);
          $stmt->bind_param('sssss', $NomProfesor, $CognomProfesor, $Asignatura, $Contrasenya, $DNIProfesor );

          $stmt->execute();
          $stmt->close();

          $db->commit();
          return "S'ha actualitzat la informacio correctament";

            $db->close();
        } catch (Exception $e) {
          $db->rollback();
      }
  }

  function getProfesor($DNI_Profesor){
//      if ($this->BDconnection() == false) {
//          return "Sense conexió amb la BD";
//          exit;
//      }
      try {
          $db = new mysqli($this->url, $this->user, $this->pass, $this->bd);

          $db->begin_transaction();

          $setencia = 'SELECT * FROM profesors WHERE DNI_Profesor = ?';
          $stmt = $db->prepare($setencia);
          $stmt->bind_param('s', $DNI_Profesor);

          $stmt->execute();
          $result = $stmt->get_result();
          $resposta = $result->fetch_assoc();

          return $resposta;

          $stmt->close();
          $db->commit();

          $db->close();
        } catch (Exception $e) {
          $db->rollback();
      }
  }
}

?>
