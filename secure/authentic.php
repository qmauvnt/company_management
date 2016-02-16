<?php

function valid_login($user, $password) {
    global $db;
    $password = sha1($user . $password);

    $query = 'SELECT * FROM employee
              WHERE EId = :user AND pwd = :password';

    $statement = $db->prepare($query);
    $statement->bindValue(':user', $user);
    $statement->bindValue(':password', $password);
    $statement->execute();

    $valid = ($statement->rowCount() == 1);
    $statement->closeCursor();

    return $valid;
}


?>