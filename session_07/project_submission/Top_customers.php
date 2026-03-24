<?php
require_once 'Database.php';
$db = Database::getInstance()->getConnection();

$sql = "
SELECT u.name, u.email, SUM(o.total_amount) AS total_spent
FROM users u
JOIN orders o ON u.id = o.user_id
GROUP BY u.id
ORDER BY total_spent DESC
LIMIT 3
";

$stmt = $db->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll();
?>

<table border="1">
<tr><th>Name</th><th>Email</th><th>Total</th></tr>

<?php foreach($data as $d): ?>
<tr>
<td><?= htmlspecialchars($d['name']) ?></td>
<td><?= htmlspecialchars($d['email']) ?></td>
<td><?= $d['total_spent'] ?></td>
</tr>
<?php endforeach; ?>
</table>