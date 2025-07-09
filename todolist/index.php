<?php
session_start();

// Initialize tasks array
if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}

$editIndex = isset($_POST['edit']) ? (int)$_POST['edit'] : null;

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add task
    if (isset($_POST['task']) && !empty(trim($_POST['task']))) {
        $_SESSION['tasks'][] = ['text' => trim($_POST['task']), 'done' => false];
    }

    // Delete task
    if (isset($_POST['delete'])) {
        $index = (int)$_POST['delete'];
        if (isset($_SESSION['tasks'][$index])) {
            unset($_SESSION['tasks'][$index]);
            $_SESSION['tasks'] = array_values($_SESSION['tasks']);
        }
    }

    // Toggle status
    if (isset($_POST['toggle'])) {
        $index = (int)$_POST['toggle'];
        if (isset($_SESSION['tasks'][$index])) {
            $_SESSION['tasks'][$index]['done'] = !$_SESSION['tasks'][$index]['done'];
        }
    }

    // Save edited text
    if (isset($_POST['save']) && isset($_POST['updated_text'])) {
        $index = (int)$_POST['save'];
        $updatedText = trim($_POST['updated_text']);
        if (isset($_SESSION['tasks'][$index]) && $updatedText !== '') {
            $_SESSION['tasks'][$index]['text'] = $updatedText;
        }
        $editIndex = null;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>To-Do List</title>
    <style>
        body { font-family: Arial, sans-serif; }
        li { margin: 8px 0; }
        .done { text-decoration: line-through; color: gray; }
        .status {
            font-size: 0.85em;
            font-weight: bold;
            margin-left: 10px;
        }
        .pending { color: red; }
        .completed { color: green; }
        form.inline { display: inline; }
    </style>
</head>
<body>
    <h1>To-Do List</h1>

    <!-- Add Task Form -->
    <form method="post">
        <input type="text" name="task" placeholder="Input Tugas" required>
        <button type="submit">Tambah Tugas</button>
    </form>

    <!-- Task List -->
    <ul>
        <?php foreach ($_SESSION['tasks'] as $index => $task): ?>
            <li>
                <!-- Toggle checkbox -->
                <form method="post" class="inline">
                    <input type="hidden" name="toggle" value="<?php echo $index; ?>">
                    <input type="checkbox" onchange="this.form.submit()" <?php echo $task['done'] ? 'checked' : ''; ?>>
                </form>

                <!-- Edit mode -->
                <?php if ($editIndex === $index): ?>
                    <form method="post" class="inline">
                        <input type="text" name="updated_text" value="<?php echo htmlspecialchars($task['text']); ?>" required>
                        <input type="hidden" name="save" value="<?php echo $index; ?>">
                        <button type="submit">Save</button>
                    </form>
                <?php else: ?>
                    <span class="<?php echo $task['done'] ? 'done' : ''; ?>">
                        <?php echo htmlspecialchars($task['text']); ?>
                    </span>

                    <!-- Status label -->
                    <span class="status <?php echo $task['done'] ? 'completed' : 'pending'; ?>">
                        <?php echo $task['done'] ? 'Selesai!' : 'Belum Selesai'; ?>
                    </span>

                    <!-- Edit Button -->
                    <form method="post" class="inline">
                        <input type="hidden" name="edit" value="<?php echo $index; ?>">
                        <button type="submit">Edit</button>
                    </form>
                <?php endif; ?>

                <!-- Delete Button -->
                <form method="post" class="inline">
                    <input type="hidden" name="delete" value="<?php echo $index; ?>">
                    <button type="submit">Hapus</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
