<?php
require_once 'config/database.php';
requireLogin();

$db = getDB();
$user_id = $_SESSION['user_id'];

// Benutzerdaten abrufen
$stmt = $db->prepare("SELECT u.*, cp.* FROM users u LEFT JOIN customer_profiles cp ON u.id = cp.user_id WHERE u.id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

$page_title = 'Dashboard';
include 'includes/header.php';
?>

<section class="dashboard">
    <div class="container">
        <div class="dashboard-header">
            <h1>
                <?php if (isAdmin()): ?>
                    <i class="fas fa-user-shield"></i> Admin-Dashboard
                <?php else: ?>
                    <i class="fas fa-user"></i> Mein Kundenbereich
                <?php endif; ?>
            </h1>
            <p>Willkommen, <?php echo e($user['contact_person'] ?? $user['email']); ?>!</p>
        </div>
        
        <div class="dashboard-grid">
            <!-- Sidebar Navigation -->
            <aside class="dashboard-sidebar">
                <nav>
                    <ul class="dashboard-nav">
                        <li><a href="#ubersicht" class="active"><i class="fas fa-home"></i> Übersicht</a></li>
                        <li><a href="#profil"><i class="fas fa-user-edit"></i> Mein Profil</a></li>
                        
                        <?php if (isAdmin()): ?>
                            <li><a href="/admin/kunden.php"><i class="fas fa-users"></i> Kunden verwalten</a></li>
                            <li><a href="/admin/uploads.php"><i class="fas fa-upload"></i> Dateien hochladen</a></li>
                            <li><a href="/admin/kontaktanfragen.php"><i class="fas fa-envelope"></i> Kontaktanfragen</a></li>
                            <li><a href="/admin/nachrichten.php"><i class="fas fa-comments"></i> Nachrichten</a></li>
                            <li><a href="/admin/aktivitaeten.php"><i class="fas fa-history"></i> Aktivitäten</a></li>
                        <?php else: ?>
                            <li><a href="#bilder"><i class="fas fa-images"></i> Meine Bilder</a></li>
                            <li><a href="#dokumente"><i class="fas fa-file-alt"></i> Meine Dokumente</a></li>
                            <li><a href="#archiv"><i class="fas fa-archive"></i> Archiv</a></li>
                            <li><a href="#nachrichten"><i class="fas fa-comments"></i> Nachrichten</a></li>
                        <?php endif; ?>
                        
                        <li style="margin-top: var(--spacing-md); border-top: 1px solid var(--border-color); padding-top: var(--spacing-md);">
                            <a href="/logout.php"><i class="fas fa-sign-out-alt"></i> Abmelden</a>
                        </li>
                    </ul>
                </nav>
            </aside>
            
            <!-- Main Content -->
            <main class="dashboard-main">
                <?php if (isAdmin()): ?>
                    <!-- Admin Dashboard -->
                    <div id="ubersicht">
                        <h2>Statistiken</h2>
                        <div class="grid grid-3" style="margin-bottom: var(--spacing-xl);">
                            <?php
                            $stmt = $db->query("SELECT COUNT(*) as count FROM users WHERE role = 'customer'");
                            $customer_count = $stmt->fetch()['count'];
                            
                            $stmt = $db->query("SELECT COUNT(*) as count FROM contact_requests WHERE status = 'new'");
                            $new_requests = $stmt->fetch()['count'];
                            
                            $stmt = $db->query("SELECT COUNT(*) as count FROM messages WHERE is_read = 0");
                            $unread_messages = $stmt->fetch()['count'];
                            ?>
                            
                            <div class="card text-center">
                                <div style="font-size: 2.5rem; font-weight: bold; color: var(--primary-color); margin-bottom: 0.5rem;">
                                    <?php echo $customer_count; ?>
                                </div>
                                <div style="color: var(--text-light);">Kunden</div>
                            </div>
                            
                            <div class="card text-center">
                                <div style="font-size: 2.5rem; font-weight: bold; color: var(--accent-color); margin-bottom: 0.5rem;">
                                    <?php echo $new_requests; ?>
                                </div>
                                <div style="color: var(--text-light);">Neue Anfragen</div>
                            </div>
                            
                            <div class="card text-center">
                                <div style="font-size: 2.5rem; font-weight: bold; color: var(--secondary-color); margin-bottom: 0.5rem;">
                                    <?php echo $unread_messages; ?>
                                </div>
                                <div style="color: var(--text-light);">Ungelesene Nachrichten</div>
                            </div>
                        </div>
                        
                        <h3>Letzte Kontaktanfragen</h3>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Datum</th>
                                        <th>Firma / Name</th>
                                        <th>E-Mail</th>
                                        <th>Leistung</th>
                                        <th>Status</th>
                                        <th>Aktion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stmt = $db->query("SELECT * FROM contact_requests ORDER BY created_at DESC LIMIT 10");
                                    while ($request = $stmt->fetch()):
                                    ?>
                                    <tr>
                                        <td><?php echo date('d.m.Y H:i', strtotime($request['created_at'])); ?></td>
                                        <td><?php echo e($request['company_name'] ?: $request['contact_person']); ?></td>
                                        <td><?php echo e($request['email']); ?></td>
                                        <td><?php echo e($request['service_type'] ?? '-'); ?></td>
                                        <td>
                                            <?php
                                            $status_badges = [
                                                'new' => '<span class="badge badge-warning">Neu</span>',
                                                'in_progress' => '<span class="badge badge-info">In Bearbeitung</span>',
                                                'completed' => '<span class="badge badge-success">Erledigt</span>',
                                                'archived' => '<span class="badge">Archiviert</span>'
                                            ];
                                            echo $status_badges[$request['status']] ?? '-';
                                            ?>
                                        </td>
                                        <td>
                                            <a href="/admin/kontaktanfragen.php?id=<?php echo $request['id']; ?>" class="btn btn-sm btn-outline">
                                                Ansehen
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                <?php else: ?>
                    <!-- Customer Dashboard -->
                    <div id="ubersicht">
                        <h2>Willkommen in Ihrem Kundenbereich</h2>
                        <p>Hier finden Sie alle Informationen und Dokumente zu Ihrer Reinigungsbetreuung.</p>
                        
                        <div class="grid grid-2" style="margin-top: var(--spacing-xl);">
                            <?php
                            $stmt = $db->prepare("SELECT COUNT(*) as count FROM uploaded_images WHERE customer_id = ?");
                            $stmt->execute([$user_id]);
                            $image_count = $stmt->fetch()['count'];
                            
                            $stmt = $db->prepare("SELECT COUNT(*) as count FROM uploaded_documents WHERE customer_id = ? AND is_archived = 0");
                            $stmt->execute([$user_id]);
                            $doc_count = $stmt->fetch()['count'];
                            ?>
                            
                            <div class="card">
                                <div class="card-icon">
                                    <i class="fas fa-images"></i>
                                </div>
                                <h3><?php echo $image_count; ?> Bilder</h3>
                                <p>Ansehen Sie die hochgeladenen Bilder Ihrer Reinigungsarbeiten.</p>
                                <a href="#bilder" class="btn btn-outline">Bilder ansehen</a>
                            </div>
                            
                            <div class="card">
                                <div class="card-icon">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <h3><?php echo $doc_count; ?> Dokumente</h3>
                                <p>Laden Sie Ihre Dokumente wie Verträge und Berichte herunter.</p>
                                <a href="#dokumente" class="btn btn-outline">Dokumente ansehen</a>
                            </div>
                        </div>
                    </div>
                    
                    <div id="bilder" style="margin-top: var(--spacing-2xl);">
                        <h2>Meine Bilder</h2>
                        <?php
                        $stmt = $db->prepare("SELECT * FROM uploaded_images WHERE customer_id = ? ORDER BY created_at DESC LIMIT 12");
                        $stmt->execute([$user_id]);
                        $images = $stmt->fetchAll();
                        
                        if (count($images) > 0):
                        ?>
                        <div class="grid grid-3" style="margin-top: var(--spacing-md);">
                            <?php foreach ($images as $image): ?>
                            <div class="card">
                                <img src="<?php echo e($image['file_path']); ?>" alt="<?php echo e($image['title'] ?? $image['original_filename']); ?>" 
                                     style="width: 100%; height: 200px; object-fit: cover; border-radius: var(--radius-md); margin-bottom: var(--spacing-sm);">
                                <h4><?php echo e($image['title'] ?? $image['original_filename']); ?></h4>
                                <p style="font-size: 0.875rem; color: var(--text-light);">
                                    Hochgeladen am <?php echo date('d.m.Y', strtotime($image['created_at'])); ?>
                                </p>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php else: ?>
                        <p style="color: var(--text-light);">Noch keine Bilder vorhanden.</p>
                        <?php endif; ?>
                    </div>
                    
                    <div id="dokumente" style="margin-top: var(--spacing-2xl);">
                        <h2>Meine Dokumente</h2>
                        <?php
                        $stmt = $db->prepare("SELECT * FROM uploaded_documents WHERE customer_id = ? AND is_archived = 0 ORDER BY created_at DESC");
                        $stmt->execute([$user_id]);
                        $documents = $stmt->fetchAll();
                        
                        if (count($documents) > 0):
                        ?>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Dateiname</th>
                                        <th>Typ</th>
                                        <th>Datum</th>
                                        <th>Größe</th>
                                        <th>Aktion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($documents as $doc): ?>
                                    <tr>
                                        <td><?php echo e($doc['title'] ?? $doc['original_filename']); ?></td>
                                        <td><?php echo e($doc['document_type'] ?? 'Dokument'); ?></td>
                                        <td><?php echo date('d.m.Y', strtotime($doc['created_at'])); ?></td>
                                        <td><?php echo round($doc['file_size'] / 1024, 2); ?> KB</td>
                                        <td>
                                            <a href="<?php echo e($doc['file_path']); ?>" class="btn btn-sm btn-primary" download>
                                                <i class="fas fa-download"></i> Download
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php else: ?>
                        <p style="color: var(--text-light);">Noch keine Dokumente vorhanden.</p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                
                <div id="profil" style="margin-top: var(--spacing-2xl);">
                    <h2>Mein Profil</h2>
                    <div class="card">
                        <div class="grid grid-2">
                            <div>
                                <p><strong>E-Mail:</strong><br><?php echo e($user['email']); ?></p>
                                <?php if ($user['company_name']): ?>
                                <p><strong>Firma:</strong><br><?php echo e($user['company_name']); ?></p>
                                <?php endif; ?>
                                <?php if ($user['contact_person']): ?>
                                <p><strong>Ansprechpartner:</strong><br><?php echo e($user['contact_person']); ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <?php if ($user['phone']): ?>
                                <p><strong>Telefon:</strong><br><?php echo e($user['phone']); ?></p>
                                <?php endif; ?>
                                <?php if ($user['street']): ?>
                                <p><strong>Adresse:</strong><br>
                                <?php echo e($user['street']); ?><br>
                                <?php echo e($user['postal_code']); ?> <?php echo e($user['city']); ?>
                                </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
