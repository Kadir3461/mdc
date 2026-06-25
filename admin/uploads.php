<?php
require_once '../config/database.php';
requireAdmin();

$db = getDB();
$success = false;
$error = false;

// Datei hochladen
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file']) && isset($_POST['csrf_token'])) {
    if (validateCSRFToken($_POST['csrf_token'])) {
        $customer_id = $_POST['customer_id'] ?? null;
        $file_type = $_POST['file_type']; // 'image' oder 'document'
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $document_type = $_POST['document_type'] ?? '';
        
        $file = $_FILES['file'];
        $allowed_extensions = ($file_type === 'image') 
            ? ['jpg', 'jpeg', 'png', 'gif', 'webp'] 
            : ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'txt'];
        
        $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
        if (!in_array($file_extension, $allowed_extensions)) {
            $error = "Dateityp nicht erlaubt. Erlaubt: " . implode(', ', $allowed_extensions);
        } elseif ($file['size'] > 10 * 1024 * 1024) { // 10 MB
            $error = "Datei ist zu groß (max. 10 MB)";
        } else {
            try {
                $upload_dir = ($file_type === 'image') ? '../uploads/images/' : '../uploads/documents/';
                
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }
                
                $new_filename = uniqid() . '_' . basename($file['name']);
                $file_path = $upload_dir . $new_filename;
                
                if (move_uploaded_file($file['tmp_name'], $file_path)) {
                    $web_path = ($file_type === 'image') 
                        ? '/uploads/images/' . $new_filename 
                        : '/uploads/documents/' . $new_filename;
                    
                    if ($file_type === 'image') {
                        $stmt = $db->prepare("INSERT INTO uploaded_images (customer_id, file_path, original_filename, file_size, mime_type, title, description, uploaded_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                        $stmt->execute([
                            $customer_id,
                            $web_path,
                            $file['name'],
                            $file['size'],
                            $file['type'],
                            $title,
                            $description,
                            $_SESSION['user_id']
                        ]);
                    } else {
                        $stmt = $db->prepare("INSERT INTO uploaded_documents (customer_id, file_path, original_filename, file_size, mime_type, title, description, document_type, uploaded_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        $stmt->execute([
                            $customer_id,
                            $web_path,
                            $file['name'],
                            $file['size'],
                            $file['type'],
                            $title,
                            $description,
                            $document_type,
                            $_SESSION['user_id']
                        ]);
                    }
                    
                    // Activity Log
                    $stmt = $db->prepare("INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES (?, 'file_upload', ?, ?)");
                    $stmt->execute([
                        $_SESSION['user_id'],
                        "Datei hochgeladen: {$file['name']}",
                        $_SERVER['REMOTE_ADDR']
                    ]);
                    
                    $success = "Datei wurde erfolgreich hochgeladen";
                } else {
                    $error = "Upload fehlgeschlagen";
                }
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }
    } else {
        $error = "CSRF-Token ungültig";
    }
}

// Datei löschen
if (isset($_GET['delete']) && isset($_GET['type']) && isset($_GET['token'])) {
    if (validateCSRFToken($_GET['token'])) {
        $file_id = $_GET['delete'];
        $file_type = $_GET['type'];
        
        try {
            if ($file_type === 'image') {
                $stmt = $db->prepare("SELECT file_path FROM uploaded_images WHERE id = ?");
                $stmt->execute([$file_id]);
                $file = $stmt->fetch();
                
                if ($file && file_exists('..' . $file['file_path'])) {
                    unlink('..' . $file['file_path']);
                }
                
                $stmt = $db->prepare("DELETE FROM uploaded_images WHERE id = ?");
                $stmt->execute([$file_id]);
            } else {
                $stmt = $db->prepare("SELECT file_path FROM uploaded_documents WHERE id = ?");
                $stmt->execute([$file_id]);
                $file = $stmt->fetch();
                
                if ($file && file_exists('..' . $file['file_path'])) {
                    unlink('..' . $file['file_path']);
                }
                
                $stmt = $db->prepare("DELETE FROM uploaded_documents WHERE id = ?");
                $stmt->execute([$file_id]);
            }
            
            $success = "Datei wurde gelöscht";
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
}

// Alle Kunden für Dropdown
$stmt = $db->query("SELECT u.id, cp.company_name, cp.contact_person, cp.customer_number FROM users u LEFT JOIN customer_profiles cp ON u.id = cp.user_id WHERE u.role = 'customer' ORDER BY cp.customer_number");
$customers = $stmt->fetchAll();

// Alle hochgeladenen Dateien
$stmt = $db->query("
    SELECT 
        ui.id, ui.file_path, ui.original_filename, ui.file_size, ui.title, ui.created_at,
        ui.customer_id, cp.company_name, 'image' as type
    FROM uploaded_images ui
    LEFT JOIN customer_profiles cp ON ui.customer_id = cp.user_id
    UNION ALL
    SELECT 
        ud.id, ud.file_path, ud.original_filename, ud.file_size, ud.title, ud.created_at,
        ud.customer_id, cp.company_name, 'document' as type
    FROM uploaded_documents ud
    LEFT JOIN customer_profiles cp ON ud.customer_id = cp.user_id
    WHERE ud.is_archived = 0
    ORDER BY created_at DESC
");
$files = $stmt->fetchAll();

$page_title = 'Dateien hochladen';
include '../includes/header.php';
?>

<section class="dashboard">
    <div class="container">
        <div class="dashboard-header">
            <h1><i class="fas fa-upload"></i> Dateien hochladen</h1>
            <a href="/dashboard.php" class="btn btn-outline">Zurück zum Dashboard</a>
        </div>
        
        <?php if ($success): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?php echo $success; ?>
            </div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
            </div>
        <?php endif; ?>
        
        <div class="grid grid-2" style="gap: var(--spacing-2xl);">
            <!-- Upload Form -->
            <div class="card">
                <h2><i class="fas fa-cloud-upload-alt"></i> Neue Datei hochladen</h2>
                
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                    
                    <div class="form-group">
                        <label for="file_type">Dateityp *</label>
                        <select id="file_type" name="file_type" class="form-control" required onchange="toggleDocumentType()">
                            <option value="image">Bild (JPG, PNG, GIF)</option>
                            <option value="document">Dokument (PDF, DOC, XLS, TXT)</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="customer_id">Kunde zuordnen</label>
                        <select id="customer_id" name="customer_id" class="form-control">
                            <option value="">-- Kein Kunde (Allgemein) --</option>
                            <?php foreach ($customers as $customer): ?>
                                <option value="<?php echo $customer['id']; ?>">
                                    <?php echo e($customer['customer_number']); ?> - <?php echo e($customer['company_name'] ?: $customer['contact_person']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group" id="document_type_group" style="display: none;">
                        <label for="document_type">Dokumenttyp</label>
                        <select id="document_type" name="document_type" class="form-control">
                            <option value="Vertrag">Vertrag</option>
                            <option value="Rechnung">Rechnung</option>
                            <option value="Bericht">Bericht</option>
                            <option value="Protokoll">Protokoll</option>
                            <option value="Sonstiges">Sonstiges</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="title">Titel</label>
                        <input type="text" id="title" name="title" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Beschreibung</label>
                        <textarea id="description" name="description" class="form-control" rows="3"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="file">Datei auswählen * (max. 10 MB)</label>
                        <input type="file" id="file" name="file" class="form-control" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-upload"></i> Hochladen
                    </button>
                </form>
            </div>
            
            <!-- Info Box -->
            <div>
                <div class="card" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); color: white;">
                    <h3 style="color: white;"><i class="fas fa-info-circle"></i> Hinweise</h3>
                    <ul style="margin: var(--spacing-md) 0; padding-left: 1.5rem;">
                        <li style="margin-bottom: 0.5rem;">Maximale Dateigröße: 10 MB</li>
                        <li style="margin-bottom: 0.5rem;">Erlaubte Bildformate: JPG, PNG, GIF, WEBP</li>
                        <li style="margin-bottom: 0.5rem;">Erlaubte Dokumentformate: PDF, DOC, DOCX, XLS, XLSX, TXT</li>
                        <li style="margin-bottom: 0.5rem;">Bilder werden dem Kunden in der Galerie angezeigt</li>
                        <li style="margin-bottom: 0.5rem;">Dokumente kann der Kunde herunterladen</li>
                        <li>Dateien ohne Kundenzuordnung sind nur für Admins sichtbar</li>
                    </ul>
                </div>
                
                <div class="card" style="margin-top: var(--spacing-md);">
                    <h3><i class="fas fa-chart-bar"></i> Statistiken</h3>
                    <?php
                    $stmt = $db->query("SELECT COUNT(*) as count FROM uploaded_images");
                    $image_count = $stmt->fetch()['count'];
                    
                    $stmt = $db->query("SELECT COUNT(*) as count FROM uploaded_documents WHERE is_archived = 0");
                    $doc_count = $stmt->fetch()['count'];
                    ?>
                    <p style="font-size: 1.125rem; margin: var(--spacing-sm) 0;">
                        <strong><?php echo $image_count; ?></strong> Bilder<br>
                        <strong><?php echo $doc_count; ?></strong> Dokumente
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Dateiliste -->
        <div class="card" style="margin-top: var(--spacing-2xl);">
            <h2><i class="fas fa-list"></i> Hochgeladene Dateien</h2>
            <div class="table-responsive">
                <table id="filesTable">
                    <thead>
                        <tr>
                            <th>Typ</th>
                            <th>Dateiname</th>
                            <th>Titel</th>
                            <th>Kunde</th>
                            <th>Größe</th>
                            <th>Hochgeladen</th>
                            <th>Aktionen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($files as $file): ?>
                        <tr>
                            <td>
                                <?php if ($file['type'] === 'image'): ?>
                                    <span class="badge badge-info"><i class="fas fa-image"></i> Bild</span>
                                <?php else: ?>
                                    <span class="badge"><i class="fas fa-file"></i> Dokument</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($file['original_filename']); ?></td>
                            <td><?php echo e($file['title'] ?: '-'); ?></td>
                            <td><?php echo e($file['company_name'] ?: 'Allgemein'); ?></td>
                            <td><?php echo round($file['file_size'] / 1024, 2); ?> KB</td>
                            <td><?php echo date('d.m.Y H:i', strtotime($file['created_at'])); ?></td>
                            <td>
                                <a href="<?php echo e($file['file_path']); ?>" class="btn btn-sm btn-outline" target="_blank" title="Ansehen">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="?delete=<?php echo $file['id']; ?>&type=<?php echo $file['type']; ?>&token=<?php echo generateCSRFToken(); ?>" 
                                   class="btn btn-sm btn-outline" style="color: var(--error-color);" 
                                   onclick="return confirm('Datei wirklich löschen?')" title="Löschen">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script>
function toggleDocumentType() {
    const fileType = document.getElementById('file_type').value;
    const docTypeGroup = document.getElementById('document_type_group');
    
    if (fileType === 'document') {
        docTypeGroup.style.display = 'block';
    } else {
        docTypeGroup.style.display = 'none';
    }
}
</script>

<?php include '../includes/footer.php'; ?>
