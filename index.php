<?php
// Database connection
include 'con.php';

// Save new pose
if (isset($_POST['save'])) {
    $m1 = intval($_POST['motor1']);
    $m2 = intval($_POST['motor2']);
    $m3 = intval($_POST['motor3']);
    $m4 = intval($_POST['motor4']);
    $m5 = intval($_POST['motor5']);
    $m6 = intval($_POST['motor6']);
    $conn->query(
        "INSERT INTO poses (motor1,motor2,motor3,motor4,motor5,motor6)
         VALUES ($m1,$m2,$m3,$m4,$m5,$m6)"
    );
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Run pose (set status = 1)
if (isset($_POST['run'])) {
    $id = intval($_POST['pose_id']);
    $conn->query("UPDATE poses SET status=1 WHERE id=$id");
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Remove pose
if (isset($_POST['delete'])) {
    $id = intval($_POST['pose_id']);
    $conn->query("DELETE FROM poses WHERE id=$id");
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Fetch all poses
$result = $conn->query("SELECT * FROM poses ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Robot Arm Control Panel</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .slider { width: 300px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        button { padding: 6px 12px; margin: 0 4px; }
    </style>
</head>
<body>

<h1>Robot Arm Control Panel</h1>

<form method="post">
    <?php for ($i = 1; $i <= 6; $i++): ?>
        <label>
            Motor <?= $i ?>:
            <input
                type="range"
                name="motor<?= $i ?>"
                min="0"
                max="180"
                value="90"
                class="slider">
            <span class="val">90</span>
        </label><br>
    <?php endfor; ?>
    <button name="save">Save Pose</button>
</form>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Motor1</th>
            <th>Motor2</th>
            <th>Motor3</th>
            <th>Motor4</th>
            <th>Motor5</th>
            <th>Motor6</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['motor1'] ?></td>
            <td><?= $row['motor2'] ?></td>
            <td><?= $row['motor3'] ?></td>
            <td><?= $row['motor4'] ?></td>
            <td><?= $row['motor5'] ?></td>
            <td><?= $row['motor6'] ?></td>
            <td><?= $row['status'] ? 'Pending' : 'Ready' ?></td>
            <td>
                <form method="post" style="display:inline">
                    <input type="hidden" name="pose_id" value="<?= $row['id'] ?>">
                    <button name="run">Run</button>
                </form>
                <form method="post" style="display:inline">
                    <input type="hidden" name="pose_id" value="<?= $row['id'] ?>">
                    <button name="delete">Remove</button>
                </form>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

<script>
    document.querySelectorAll('.slider').forEach(slider => {
        const output = slider.nextElementSibling;
        slider.oninput = () => output.textContent = slider.value;
    });
</script>

</body>
</html>
