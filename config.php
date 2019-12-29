

```

try {
    $pdo = new PDO('mysql:host=localhost;dbname=database;charset=utf8mb4', 'root', 'pass');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
``´