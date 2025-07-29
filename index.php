<?php
require 'functions.php';

$contacts = "loadContacts" ();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    if ($name && $email && $phone) {
        "addContact" ($name, $email, $phone);
        header("Location: index.php"); // refresh po odeslání
        exit;
    } else {
        $error = "Vyplň prosím všechna pole.";
    }
}

if (isset($_GET['delete'])) {
    "deleteContact"((int)$_GET['delete']);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Správce kontaktů</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>📒 Správce kontaktů</h1>

    <?php if (!empty($error)): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="name" placeholder="Jméno" required>
        <input type="email" name="email" placeholder="E-mail" required>
        <input type="text" name="phone" placeholder="Telefon" required>
        <button type="submit">Přidat kontakt</button>
    </form>

    <h2>📋 Seznam kontaktů</h2>
    <table>
        <thead>
            <tr><th>Jméno</th><th>Email</th><th>Telefon</th><th>Akce</th></tr>
        </thead>
        <tbody>
        <?php foreach ($contacts as $index => $contact): ?>
            <tr>
                <td><?= htmlspecialchars($contact['name']) ?></td>
                <td><?= htmlspecialchars($contact['email']) ?></td>
                <td><?= htmlspecialchars($contact['phone']) ?></td>
                <td>
                    <a href="?delete=<?= $index ?>" onclick="return confirm('Smazat kontakt?')">❌ Smazat</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>