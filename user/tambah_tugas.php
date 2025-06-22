<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../koneksi.php';
if (!isset($_SESSION['user']))
    exit;

$user = $_SESSION['user'];
$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
$priorities = $pdo->query("SELECT * FROM priorities")->fetchAll();
?>

<form method="POST" action="simpan_tugas.php" id="formTambahTugas">
    <div class="modal-header">
        <h5 class="modal-title">Tambah Tugas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
    </div>
    <div class="modal-body">
        <input type="text" name="title" class="form-control mb-2" placeholder="Judul" required>
        <textarea name="description" class="form-control mb-2" placeholder="Deskripsi"></textarea>
        <select name="category_id" class="form-control mb-2" required>
            <option value="">Pilih Kategori</option>
            <?php foreach ($categories as $c): ?>
                <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
            <?php endforeach; ?>
        </select>
        <select name="priority_id" class="form-control mb-2" required>
            <option value="">Pilih Prioritas</option>
            <?php foreach ($priorities as $p): ?>
                <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['level']) ?></option>
            <?php endforeach; ?>
        </select>
        <input type="date" name="due_date" class="form-control mb-2" required>
        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
        <input type="hidden" name="status_id" value="1">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-success">Simpan</button>
    </div>
</form>