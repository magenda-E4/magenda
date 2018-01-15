<?php
if(count($errors) > 0) {
    foreach ($errors as $error) {
        echo $error . "<br />";
    }
}
?>
<form action="?controller=user&action=connect" method="POST">
    <p>
        <label>Email : </label>
        <input type="email" name="email" />
    </p>
    <p>
        <label>Password : </label>
        <input type="text" name="password" />
    </p>
    <p>
        <input type="submit" />
    </p>
</form>