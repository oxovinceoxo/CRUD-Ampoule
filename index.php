<?php
ob_start();
?>

<div class="bg-content">
    <form action="listeAmpoule.php" method="post">

        <div class="form-group">
            <label for="email">votre Email</label>
            <input type="email" class="form-control" name="email" id="email" />
        </div>

        <div class="form-group">
            <label for="password">password</label>
            <input type="password" class="form-control" name="password" id="password" />
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-outline-danger">Connexion</button>
        </div>

    </form>
</div>

<?php
$content = ob_get_clean();
require "template.php";
?>