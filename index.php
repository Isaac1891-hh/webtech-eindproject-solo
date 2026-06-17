<?php
require_once 'includes/db.php';
require_once 'includes/header.php';

$tasks = $pdo->query('SELECT * FROM tasks ORDER BY created_at DESC')->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="card">
    <h2>Taak toevoegen</h2>
    <p>Deze form gebruikt jQuery en Ajax. De taak wordt opgeslagen via PHP zonder pagina-refresh.</p>

    <form id="taskForm">
        <div class="form-row">
            <label for="title">Titel</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div class="form-row">
            <label for="description">Beschrijving</label>
            <textarea id="description" name="description"></textarea>
        </div>
        <div class="form-row">
            <label for="status">Status</label>
            <select id="status" name="status">
                <option value="open">Open</option>
                <option value="bezig">Bezig</option>
                <option value="klaar">Klaar</option>
            </select>
        </div>
        <button type="submit">Taak opslaan</button>
    </form>
    <p id="message"></p>
</section>

<section class="card">
    <h2>Takenlijst</h2>
    <div id="taskList">
        <?php foreach ($tasks as $task): ?>
            <div class="task" id="task-<?= $task['id'] ?>">
                <h3><?= htmlspecialchars($task['title']) ?></h3>
                <p><?= nl2br(htmlspecialchars($task['description'])) ?></p>
                <span class="badge">Status: <?= htmlspecialchars($task['status']) ?></span>
                <button class="deleteTask" data-id="<?= $task['id'] ?>">Verwijderen</button>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="assets/js/tasks.js"></script>
<?php require_once 'includes/footer.php'; ?>
