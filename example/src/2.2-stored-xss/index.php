<?php

$db = new mysqli("mysql", "root", "password", "mysql");

ensure_db_exists($db);

if (isset($_POST['q'])) {
    insert_query($db);

    header('Location: /2.2-stored-xss/');
}

$items = fetch_items($db);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>2.1 - Reflected XSS</title>
    </head>
    <body>
        <p><a href="/">Back to index page</a></p>
        <form action="index.php" method="post">
            <input type="text" name="q" value="<?php echo $_GET['q']; ?>">
            <input type="submit" value="Submit">
        </form>
        <p>Latest queries:</p>
        <ul>
        <?php foreach ($items as $item) { ?>
            <li><?php echo $item; ?></li>
        <?php } ?>
        </ul>
    </body>
</html>
<?php

function ensure_db_exists($db) {
    if (!$db->query("CREATE TABLE IF NOT EXISTS `queries` (`id` INT PRIMARY KEY AUTO_INCREMENT, `query` VARCHAR(255) NOT NULL);")) {
        die($db->errno . " " . $db->error);
    }
}

function insert_query($db) {
    $statement = $db->prepare("INSERT INTO `queries` (`query`) VALUES (?);");

    $statement->bind_param("s", $query);

    $query = $_POST['q'];

    if (!$statement->execute()) {
        die($db->errno . " " . $db->error);
    }
}

function fetch_items($db) {
    if (!$result = $db->query("SELECT `query` FROM `queries` ORDER BY `id` DESC LIMIT 10;")) {
        die($db->errno . " " . $db->error);
    }

    $items = array();

    while ($row = $result->fetch_assoc()) {
        $items[] = $row['query'];
    }

    return $items;
}
