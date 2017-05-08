<?php
session_start();
require_once 'config.php';
require_once 'autoloader.php';
$db = new DataBase();
$db->selectDataBase();
$db->connectToDB();
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Управление таблицами</title>
    
</head>
<body>

    <h3 style="text-align: center">Просмотр информации о таблицах в базе данных</h3>

    <form method="post">
        <label for="database">Выберите базу данных:</label>
        <select name="database">
            <?php $databases = $db->getAllDatabases(); foreach ($databases as $database) : foreach ($database as $name) : ?>
                <option value="<?php echo $name ?>" <?php if ($_SESSION['database'] == $name) :?> selected <?php endif; ?> > <?php echo $name ?></option>
            <?php endforeach; endforeach; ?>
        </select>
        <button type="submit">Показать данные</button>
    </form>

    <form method="post">
        <label for="select_table">Выберите таблицу:</label>
        <select name="select_table">
            <?php $tables = $db->getAllTablesNames(); foreach ($tables as $table) : foreach ($table as $name) : ?>
            <option value="<?php echo $name ?>"><?php echo $name ?></option>
            <?php endforeach; endforeach; ?>
        </select>
        <button type="submit">Показать данные</button>
    </form>
    <?php if (isset($_POST['select_table'])) : ?>
    <table>
        <tr>
            <th>Поле</th>
            <th>Тип</th>
            <th>NULL</th>
            <th>Ключ</th>
            <th>Значение по умолчанию</th>
            <th>Дополнительно</th>
        </tr>
        <tr>
         <?php $tableInfo = $db->getInfoAboutTable($_POST['select_table']);
        foreach ($tableInfo as $field): ?>
        <tr>
            <?php foreach ($field as $detail): ?>
            <td>
            <?php echo $detail; ?>
            </td>
            <?php endforeach; ?>
        </tr>
            <?php endforeach; ?>
    </table>
    <?php endif;
    $db->getAllDatabases();?>

    <div style="text-align: center"><a href="session_destroy.php">Завершить сессию</a></div>
</body>
</html>
