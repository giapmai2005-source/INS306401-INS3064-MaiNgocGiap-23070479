<?php
require_once 'Database.php';
$db = Database::getInstance()->getConnection();

$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';

$sql = "
SELECT p.id, p.name, p.price, p.stock, c.category_name
FROM products p
LEFT JOIN categories c ON p.category_id = c.id
WHERE 1
";

$params = [];

// SEARCH
if (!empty($search)) {
    $sql .= " AND p.name LIKE :search";
    $params['search'] = "%$search%";
}

// FILTER
if (!empty($category)) {
    $sql .= " AND p.category_id = :category";
    $params['category'] = $category;
}

$stmt = $db->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();

$categories = $db->query("SELECT * FROM categories")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
<style>
body {
    font-family: 'Segoe UI';
    background: #f5f7fb;
}

.container {
    width: 1000px;
    margin: auto;
}

.card {
    background: white;
    padding: 20px;
    margin-top: 20px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

input, select {
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ddd;
}

button {
    padding: 10px;
    background: #4f46e5;
    color: white;
    border: none;
    border-radius: 8px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th {
    background: #f1f5f9;
    padding: 10px;
}

td {
    padding: 10px;
    border-bottom: 1px solid #eee;
}

tr:hover {
    background: #f9fafb;
}

.low {
    background: #fee2e2;
    color: #b91c1c;
}
</style>
</head>

<body>
<div class="container">

<h2>⭐ Product Dashboard</h2>

<div class="card">
<form>
<input name="search" placeholder="🔍 Search..." value="<?= htmlspecialchars($search) ?>">

<select name="category">
<option value="">All Categories</option>
<?php foreach($categories as $c): ?>
<option value="<?= $c['id'] ?>" <?= $category == $c['id'] ? 'selected' : '' ?>>
<?= $c['category_name'] ?>
</option>
<?php endforeach; ?>
</select>

<button>Filter</button>
</form>
</div>

<div class="card">
<table>
<tr>
<th>ID</th>
<th>Name</th>
<th>Price</th>
<th>Category</th>
<th>Stock</th>
</tr>

<?php foreach($products as $p): ?>
<tr class="<?= $p['stock'] < 10 ? 'low' : '' ?>">
<td><?= $p['id'] ?></td>
<td>⭐ <?= htmlspecialchars($p['name']) ?></td>
<td>$<?= number_format($p['price']) ?></td>
<td><?= $p['category_name'] ?? 'None' ?></td>
<td><?= $p['stock'] ?></td>
</tr>
<?php endforeach; ?>

</table>
</div>

</div>
</body>
</html>