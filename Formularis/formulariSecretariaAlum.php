<?php
echo '<div class="mdl-card mdl-shadow--6dp">';
echo '<div class="mdl-card__title mdl-color--primary mdl-color-text--white">';
echo'<h2 class="mdl-card__title-text">Gestionar alumnes:</h2>';
echo'</div>';

echo '<div class="mdl-card__supporting-text">';
echo 'Per a introduir o actualizar un alumne cal omplir tot el formulari, per esborrar un alumne amb el DNI es suficient.';
echo '</div>';

echo'<div class="mdl-card__supporting-text">';

echo "<form  id='login' action='../Secretaria/SecretariaAlum.php' method='post' accept-charset='UTF-8'>";
echo '<div class="mdl-textfield mdl-js-textfield">';
echo'<input class="mdl-textfield__input" type="text" name="alumdni" id="alumdni" autocomplete="off" />';
echo'<label class="mdl-textfield__label" for="alumdni">DNI Alumne</label>';
echo'</div>';

echo '<div class="mdl-textfield mdl-js-textfield">';
echo'<input class="mdl-textfield__input" type="text" name="nom" id="nom" autocomplete="off" />';
echo'<label class="mdl-textfield__label" for="nom">Nom</label>';
echo'</div>';

echo '<div class="mdl-textfield mdl-js-textfield">';
echo '<input class="mdl-textfield__input" type="text" name="cognom" id="cognom" autocomplete="off" />';
echo '<label class="mdl-textfield__label" for="cognom">Cognom</label>';
echo '</div>';

echo '<div class="mdl-textfield mdl-js-textfield">';
echo '<input class="mdl-textfield__input" type="text" name="contra" id="contra" autocomplete="off" />';
echo '<label class="mdl-textfield__label" for="contra">Contrasenya</label>';
echo '</div>';


?>