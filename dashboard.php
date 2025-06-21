<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['user']))
    header("Location: index.php");

$user = $_SESSION['user'];

$kategoriStmt = $pdo->query("SELECT * FROM categories");
$kategoriList = $kategoriStmt->fetchAll();

$statusStmt = $pdo->query("SELECT * FROM statuses");
$statusList = $statusStmt->fetchAll();

$filterKategori = $_GET['kategori'] ?? '';
$filterStatus = $_GET['status'] ?? '';

$query = "SELECT t.*, c.name as category, p.level, s.name as status, s.id as status_id 
          FROM tasks t
          JOIN categories c ON t.category_id = c.id
          JOIN priorities p ON t.priority_id = p.id
          JOIN statuses s ON t.status_id = s.id
          WHERE 1=1 AND t.user_id = ?";
$params = [$user['id']];

if ($filterKategori) {
    $query .= " AND t.category_id = ?";
    $params[] = $filterKategori;
}
if ($filterStatus) {
    $query .= " AND t.status_id = ?";
    $params[] = $filterStatus;
}

$query .= " ORDER BY t.due_date ASC, p.level DESC";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$tasks = $stmt->fetchAll();

$belum = array_filter($tasks, fn($t) => $t['status_id'] != 3);
$selesai = array_filter($tasks, fn($t) => $t['status_id'] == 3);
include 'header.php'; 
?>


<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .col-status {
            width: 50px;
            text-align: center;
            vertical-align: middle !important;
        }

        .col-status form {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            margin: 0;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function bukaModalEdit(id) {
            $('#editFormContent').load('edit_tugas.php?id=' + id, function () {
                var modal = new bootstrap.Modal(document.getElementById('modalEditTugas'));
                modal.show();
            });
        }
    </script>
</head>


<body class="p-4">
    <div class="container">
        <h3>Hai, <?= htmlspecialchars($user['username']) ?> | <a href="logout.php">Logout</a></h3>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahTugas">+ Tambah
            Tugas</button>

        <form method="get" class="row mb-3">
            <div class="col-md-4">
                <select name="kategori" class="form-select">
                    <option value="">-- Semua Kategori --</option>
                    <?php foreach ($kategoriList as $k): ?>
                        <option value="<?= $k['id'] ?>" <?= $filterKategori == $k['id'] ? 'selected' : '' ?>><?= $k['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <button class="btn btn-success" type="submit">Filter</button>
                <a href="dashboard.php" class="btn btn-secondary">Reset</a>
            </div>
        </form>

        <h4>Task List</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="col-status">Status</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Prioritas</th>
                    <th>Deadline</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($belum as $task): ?>
                    <tr>
                        <td class="col-status">
                            <form method="post" action="ubah_status.php" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $task['id'] ?>">
                                <input type="hidden" name="status_id" value="3">
                                <input type="checkbox" onchange="this.form.submit()">
                            </form>
                        </td>

                        <td>
                            <?= htmlspecialchars($task['title']) ?>
                            <div class="text-muted small"><?= nl2br(htmlspecialchars($task['description'])) ?></div>
                        </td>

                        <td><?= $task['category'] ?></td>
                        <td><?= $task['level'] ?></td>
                        <td>
                            <?php
                            $now = new DateTime();
                            $due = new DateTime($task['due_date']);
                            if ($due > $now) {
                                $interval = $now->diff($due);
                                $days = $interval->d;
                                $hours = $interval->h;
                                $minutes = $interval->i;

                                if ($interval->days >= 1) {
                                    echo "{$days} days {$hours} hours";
                                } else {
                                    echo "{$hours} hours {$minutes} minutes";
                                }
                            } else {
                                echo "<span class='text-danger'>Expired</span>";
                            }
                            ?>
                        </td>


                        <td>
                            <a href="javascript:void(0)" onclick="bukaModalEdit(<?= $task['id'] ?>)"
                                class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus_tugas.php?id=<?= $task['id'] ?>" onclick="return confirm('Hapus?')"
                                class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h4 class="mt-4">Completed Task</h4>
        <table class="table table-bordered table-success">
            <thead>
                <tr>
                    <th class="col-status">Status</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Prioritas</th>
                    <th>Deadline</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($selesai as $task): ?>
                    <tr>
                        <td class="col-status">
                            <form method="post" action="ubah_status.php" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $task['id'] ?>">
                                <input type="hidden" name="status_id" value="1">
                                <input type="checkbox" onchange="this.form.submit()" checked>
                            </form>
                        </td>

                        <td>
                            <s><?= htmlspecialchars($task['title']) ?></s>
                            <div class="text-muted small"><s><?= nl2br(htmlspecialchars($task['description'])) ?></s></div>
                        </td>

                        <td><?= $task['category'] ?></td>
                        <td><?= $task['level'] ?></td>
                        <td><?= $task['due_date'] ?></td>
                        <td>
                            <a href="hapus_tugas.php?id=<?= $task['id'] ?>" onclick="return confirm('Hapus?')"
                                class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="modalTambahTugas" tabindex="-1" aria-labelledby="modalTambahTugasLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php include 'tambah_tugas.php'; ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditTugas" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-3">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Tugas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="editFormContent">
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<?php include 'footer.php'; ?>
