<?php
/**
 * @author Roger Pedrós Villorbina, Aldair Ñique del Aguila, Alejandro Rodriguez Garcia.
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
//Esta clase permite la conexion con la base de datos mediante la url, el usuario, y el password.
  function BDconnection(){
        $db = new mysqli($this->url, $this->user, $this->pass);
        if ($db->connect_errno) {
            return false;
            exit;
        }
        $db->close();
  }

    //CRUD PROFESOR permite realizar las funciones READ,READ,UPLOAD y DELETE

    function fillProfesors($DNIProfesor, $NomProfesor, $CognomProfesor, $Asignatura, $Contrasenya){
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
     }catch (Exception $e) {
         $db->rollback();
     }
  }

//Esta funcion permite borrar profesores por DNI_Profesor

  function deleteProfesor($DNIProfesor){
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
      }catch (Exception $e) {
         $db->rollback();
     }
  }
//Esta funcion permite modificar al profesor sus datos, las asignaturas que realiza.

  function updateProfesor($DNIProfesor, $NomProfesor, $CognomProfesor, $Asignatura, $Contrasenya){
      try {
          $db = new mysqli($this->url, $this->user, $this->pass, $this->bd);

          $db->begin_transaction();

          $setencia = 'UPDATE profesors SET nom = ?, cognom = ?, asignatura = ?, contrasenya = ? WHERE DNI_Profesor = ?;';
          $stmt = $db->prepare($setencia);
          $stmt->bind_param('sssss', $NomProfesor, $CognomProfesor, $Asignatura, $Contrasenya, $DNIProfesor);

          $stmt->execute();
          $stmt->close();

          $db->commit();
          return "S'ha actualitzat la informacio correctament";

            $db->close();
      }catch (Exception $e) {
          $db->rollback();
      }
  }
//seleccion al profesor mediante su DNI

  function getProfesor($DNI_Profesor){
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
      }catch (Exception $e) {
          $db->rollback();
      }
  }
    //seleccion de tots els profesors

    function getTotsProfesor(){
      try {
          $db = new mysqli($this->url, $this->user, $this->pass, $this->bd);

          $db->begin_transaction();

          $setencia = 'SELECT * FROM profesors';
          $stmt = $db->prepare($setencia);

          $stmt->execute();
          $result = $stmt->get_result();

          while($respostes = $result->fetch_assoc()){
              $resposta[] = $respostes;
          }
          return $resposta;

          $stmt->close();
          $db->commit();

          $db->close();
      }catch (Exception $e) {
          $db->rollback();
      }
  }


  //CRUD CURS
  function fillCurs($DNIProfesor, $NomCurs){
      try {
          $db = new mysqli($this->url, $this->user, $this->pass, $this->bd);
          $db->begin_transaction();

          $setencia = 'INSERT INTO curs(nom_curs, profesor) VALUES (?, ?)';
          $stmt = $db->prepare($setencia);
          $stmt->bind_param('ss', $NomCurs, $DNIProfesor);

          $stmt->execute();
          $stmt->close();
          $db->commit();
              return "S'ha insertat la informacio correctament";

              $db->close();
          }catch (Exception $e) {
              $db->rollback();
          }
  }

  function deleteCurs($NomCurs){
      try {
          $db = new mysqli($this->url, $this->user, $this->pass, $this->bd);
          $db->begin_transaction();

          $setencia = 'DELETE FROM curs WHERE nom_curs = ?';
          $stmt = $db->prepare($setencia);
          $stmt->bind_param('s', $NomCurs);

          $stmt->execute();
          $stmt->close();

          $db->commit();
          return "S'ha eliminat la informacio correctament";

          $db->close();
      }catch (Exception $e) {
          $db->rollback();
      }
  }

  function updateCurs($DNIProfesor, $NomCurs){
      try {
          $db = new mysqli($this->url, $this->user, $this->pass, $this->bd);

          $db->begin_transaction();

          $setencia = 'UPDATE curs SET profesor = ? WHERE nom_curs = ?';
          $stmt = $db->prepare($setencia);
          $stmt->bind_param('ss', $DNIProfesor, $NomCurs);

          $stmt->execute();
          $stmt->close();

          $db->commit();
          return "S'ha actualitzat la informacio correctament";

          $db->close();
      } catch (Exception $e) {
          $db->rollback();
      }
  }

  function getProfesorsByCurs($NomCurs){
      try {
          $db = new mysqli($this->url, $this->user, $this->pass, $this->bd);
          $db->begin_transaction();

          $setencia = 'SELECT * FROM curs WHERE nom_curs = ?';
          $stmt = $db->prepare($setencia);
          $stmt->bind_param('s', $NomCurs);

          $stmt->execute();
          $result = $stmt->get_result();

          while($respostes = $result->fetch_assoc()){
              $resposta[] = $respostes;
          }
          return $resposta;

          $stmt->close();
          $db->commit();

          $db->close();
      }catch (Exception $e) {
          $db->rollback();
      }
  }

  function getCursdeProfe($DNIProfesor){
      try {
          $db = new mysqli($this->url, $this->user, $this->pass, $this->bd);
          $db->begin_transaction();

          $setencia = 'SELECT * FROM curs WHERE profesor = ?';
          $stmt = $db->prepare($setencia);
          $stmt->bind_param('s', $DNIProfesor);

          $stmt->execute();
          $result = $stmt->get_result();

          while($respostes = $result->fetch_assoc()){
              $resposta[] = $respostes;
          }
          return $resposta;

          $stmt->close();
          $db->commit();

          $db->close();
      }catch (Exception $e) {
          $db->rollback();
      }
  }

  function getTotsCursos(){
      try {
          $db = new mysqli($this->url, $this->user, $this->pass, $this->bd);
          $db->begin_transaction();

          $setencia = 'SELECT * FROM curs';
          $stmt = $db->prepare($setencia);

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
  //CRUD ASGINATURES
    //Esta funcion se encarga por asi decirlo de llenar los campos con los valores que ingresamos dentro de asignatures.
  function fillAsignatura($nomAsingatura, $DNIAlumne, $Nota, $Curs){
      try {
          $db = new mysqli($this->url, $this->user, $this->pass, $this->bd);
          $db->begin_transaction();

          $setencia = 'INSERT INTO asignatures(nom_asignatura,DNI_Alumne, nota, curs) VALUES (?, ?, ?,?)';
          $stmt = $db->prepare($setencia);
          $stmt->bind_param('ssi', $nomAsingatura, $DNIAlumne, $Nota, $Curs);

          $stmt->execute();
          $stmt->close();

          $db->commit();
          return "S'ha insertat la informacio correctament";

          $db->close();
      } catch (Exception $e) {
          $db->rollback();
      }
  }

  function creaAsignatura($nomAsingatura, $Curs){
      try {
          $db = new mysqli($this->url, $this->user, $this->pass, $this->bd);
          $db->begin_transaction();

          $setencia = 'INSERT INTO asignatures(nom_asignatura, curs) VALUES (?, ?)';
          $stmt = $db->prepare($setencia);
          $stmt->bind_param('ss', $nomAsingatura, $Curs);

          $stmt->execute();
          $stmt->close();

          $db->commit();
          return "S'ha insertat la informacio correctament";

          $db->close();
      } catch (Exception $e) {
          $db->rollback();
      }
  }
//esta funcion borra la asignatura indicada mediante su nombre.

  function deleteAsignatura($nomAsingatura){
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
//Esta funcion se encarga de borrar la nota de la asignatura del alumno indicados por "$nom_asignatura" y "$DNI_Alumne".
  function deleteNotaAsignatura($nomAsingatura, $DNIAlumne){
      try {
          $db = new mysqli($this->url, $this->user, $this->pass, $this->bd);
          $db->begin_transaction();

          $setencia = 'DELETE FROM asignatures WHERE nom_asignatura = ? AND DNI_Alumne = ?';
          $stmt = $db->prepare($setencia);
          $stmt->bind_param('ss', $nomAsingatura, $DNIAlumne);

          $stmt->execute();
          $stmt->close();

          $db->commit();
          return "S'ha eliminat la informacio correctament";

          $db->close();
      } catch (Exception $e) {
          $db->rollback();
      }
  }

//esta funcion se encarga de modificar los campos(nom_asignatura, Nota) de la tabla "asignatures"
//mediante el DNI_Alumne como identificador.
  function updateAsignatura($nomAsingatura, $DNIAlumne, $Nota, $Curs){
      try {
          $db = new mysqli($this->url, $this->user, $this->pass, $this->bd);
          $db->begin_transaction();

          $sentencia = 'UPDATE asignatures SET nom_asignatura = ?, nota = ? , curs = ? WHERE DNI_Alumne = ?';
          $stmt = $db->prepare($sentencia);
          $stmt->bind_param('sis', $nomAsingatura, $Nota, $Curs, $DNIAlumne);

          $stmt->execute();
          $stmt->close();

          $db->commit();
          return "S'ha actualitzat la informacio correctament";

          $db->close();
      } catch (Exception $e) {
          $db->rollback();
      }
  }

  function updateSimpleAsignatura($nomAsingatura, $Curs){
      try {
          $db = new mysqli($this->url, $this->user, $this->pass, $this->bd);
          $db->begin_transaction();

          $sentencia = 'UPDATE asignatures SET curs = ? WHERE  nom_asignatura = ?';
          $stmt = $db->prepare($sentencia);
          $stmt->bind_param('ss', $Curs, $nomAsingatura);

          $stmt->execute();
          $stmt->close();

          $db->commit();
          return "S'ha actualitzat la informacio correctament";

          $db->close();
      } catch (Exception $e) {
          $db->rollback();
      }
  }
//Esta funcion permite seleccionar asignatura por su nombre

  function getAsignaturaProf($nomAsignatura){
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
    //esta funcion permite seleccionar todas las asignaturas
  function getTotesAsignatures(){
      try {
          $db = new mysqli($this->url, $this->user, $this->pass, $this->bd);
          $db->begin_transaction();

          $setencia = 'SELECT * FROM asignatures';
          $stmt = $db->prepare($setencia);

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

    //esta funcion permite seleccionar todas las asignaturas de un alumno mediante su DNI.
  function getAsignaturaAlum($DNIAlumne){
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
//esta funcion permite ver mediante el DNI del alumno las asignaturas que cursa y nombrarlas
  function getAsignaturaxAlum($DNIAlumne, $nomAsignatura){
      try {
          $db = new mysqli($this->url, $this->user, $this->pass, $this->bd);
          $db->begin_transaction();

          $setencia = 'SELECT * FROM asignatures WHERE DNI_Alumne = ? AND nom_asignatura = ? ';
          $stmt = $db->prepare($setencia);
          $stmt->bind_param('ss', $DNIAlumne, $nomAsignatura);

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

}

?>
