<?php
echo '<div class="mdl-card mdl-shadow--6dp">';
echo '<div class="mdl-card__title mdl-color--primary mdl-color-text--white">';
echo'<h2 class="mdl-card__title-text">Gestionar notes:</h2>';
echo'</div>';
echo'<div class="mdl-card__supporting-text">';

echo "<form  id='login' action='../PanelProf.php' method='post' accept-charset='UTF-8'>";
echo '<div class="mdl-textfield mdl-js-textfield">';
echo'<input class="mdl-textfield__input" type="text" name="alumdni" id="alumdni" autocomplete="off" />';
echo'<label class="mdl-textfield__label" for="alumdni">DNI Alumne</label>';
echo'</div>';

echo '<div class="mdl-textfield mdl-js-textfield">';
echo'<input class="mdl-textfield__input" type="text" name="aign" id="aign" autocomplete="off" />';
echo'<label class="mdl-textfield__label" for="alumdni">Asignatura</label>';
echo'</div>';

echo '<div class="mdl-textfield mdl-js-textfield">';
echo '<input class="mdl-textfield__input" type="text" name="nota" id="nota" autocomplete="off" />';
echo '<label class="mdl-textfield__label" for="alumdni">Nota</label>';
echo '</div>';


?>