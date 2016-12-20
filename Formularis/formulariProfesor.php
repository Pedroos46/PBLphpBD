<?php
echo '<div class="mdl-card mdl-shadow--6dp">';
echo '<div class="mdl-card__title mdl-color--primary mdl-color-text--white">';
echo'<h2 class="mdl-card__title-text">Gestionar notes:</h2>';
echo'</div>';
echo'<div class="mdl-card__supporting-text">';

echo "<form  id='login' action='../Panel.php' method='post' accept-charset='UTF-8'>";
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

echo '<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">';
echo '<input type="radio" id="option-1" class="mdl-radio__button" name="options" value="Introduir">';
echo '<span class="mdl-radio__label">Introduir</span>';
echo '</label>';

echo '<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">';
echo '<input type="radio" id="option-2" class="mdl-radio__button" name="options" value="Actualitzar">';
echo '<span class="mdl-radio__label">Actualitza</span>';
echo '</label>';

echo '<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">';
echo '<input type="radio" id="option-3" class="mdl-radio__button" name="options" value="Eliminar">';
echo '<span class="mdl-radio__label">Eliminar</span>';
echo '</label>';


echo '<div class="mdl-card__actions mdl-card--border">';
echo '<button type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" name="Submit"> Dale';
echo '</button>';
echo '</div>';
echo '</form>';
echo '</div>';
echo '</div>';
?>