<?php
echo '<div class="mdl-card mdl-shadow--6dp">';
echo '<div class="mdl-card__title mdl-color--primary mdl-color-text--white">';
echo'<h2 class="mdl-card__title-text">Gestionar Cursos:</h2>';
echo'</div>';

echo '<div class="mdl-card__supporting-text">';
echo 'Per a introduir o actualizar un curs cal omplir tot el formulari, per esborrar un curs amb el nom es suficient.';
echo '</div>';

echo'<div class="mdl-card__supporting-text">';

echo "<form  id='login' action='../Secretaria/SecretariaCurs.php' method='post' accept-charset='UTF-8'>";
echo '<div class="mdl-textfield mdl-js-textfield">';
echo'<input class="mdl-textfield__input" type="text" name="curs" id="curs" autocomplete="off" />';
echo'<label class="mdl-textfield__label" for="curs">Curs</label>';
echo'</div>';



?>