<?php
require_once '../config/database.php';
requireAdmin();

$db = getDB();
$success = false;
$error = false;

// Kunde hinzufügen/bearbeiten
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if (validateCSRFToken($_POST['csrf_token'])) {
        $action = $_POST['action'];
        
        try {
            if ($action === 'add' || $action === 'edit') {
                $email = $_POST['email'];
                $password = $_POST['password'] ?? '';
                $company_name = $_POST['company_name'];
                $contact_person = $_POST['contact_person'];
                $phone = $_POST['phone'] ?? '';
                $street = $_POST['street'] ?? '';
                $postal_code = $_POST['postal_code'] ?? '';
                $city = $_POST['city'] ?? '';
                $customer_number = $_POST['customer_number'];
                $status = $_POST['status'] ?? 'active';
                
                if ($action === 'add') {
                    // Neuen Benutzer anlegen
                    if (empty($password)) {
                        throw new Exception('Passwort ist erforderlich');
                    }
                    
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    
                    $db->beginTransaction();
                    
                    $stmt = $db->prepare("INSERT INTO users (email, password, role, status) VALUES (?, ?, 'customer', ?)");
                    $stmt->execute([$email, $hashed_password, $status]);
                    $user_id = $db->lastInsertId();
                    
                    $stmt = $db->prepare("INSERT INTO customer_profiles (user_id, company_name, contact_person, phone, street, postal_code, city, customer_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$user_id, $company_name, $contact_person, $phone, $street, $postal_code, $city, $customer_number]);
                    
                    $db->commit();
                    
                    // Activity Log
                    $stmt = $db->prepare("INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES (?, 'customer_create', ?, ?)");
                    $stmt->execute([$_SESSION['user_id'], "Kunde $customer_number angelegt", $_SERVER['REMOTE_ADDR']]);
                    
                    $success = "Kunde wurde erfolgreich angelegt";
                } else {
                    // Bestehenden Benutzer bearbeiten
                    $user_id = $_POST['user_id'];
                    
                    $db->beginTransaction();
                    
                    if (!empty($password)) {
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                        $stmt = $db->prepare("UPDATE users SET email = ?, password = ?, status = ? WHERE id = ?");
                        $stmt->execute([$email, $hashed_password, $status, $user_id]);
                    } else {
                        $stmt = $db->prepare("UPDATE users SET email = ?, status = ? WHERE id = ?");
                        $stmt->execute([$email, $status, $user_id]);
                    }
                    
                    $stmt = $db->prepare("UPDATE customer_profiles SET company_name = ?, contact_person = ?, phone = ?, street = ?, postal_code = ?, city = ?, customer_number = ? WHERE user_id = ?");
                    $stmt->execute([$company_name, $contact_person, $phone, $street, $postal_code, $city, $customer_number, $user_id]);
                    
                    $db->commit();
                    
                    // Activity Log
                    $stmt = $db->prepare("INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES (?, 'customer_update', ?, ?)");
                    $stmt->execute([$_SESSION['user_id'], "Kunde $customer_number aktualisiert", $_SERVER['REMOTE_ADDR']]);
                    
                    $success = "Kunde wurde erfolgreich aktualisiert";
                }
            } elseif ($action === 'delete') {
                $user_id = $_POST['user_id'];
                
                $db->beginTransaction();
                
                // Hole Kundennummer für Log
                $stmt = $db->prepare("SELECT customer_number FROM customer_profiles WHERE user_id = ?");
                $stmt->execute([$user_id]);
                $customer = $stmt->fetch();
                
                // Lösche Profil und Benutzer
                $stmt = $db->prepare("DELETE FROM customer_profiles WHERE user_id = ?");
                $stmt->execute([$user_id]);
                
                $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
                $stmt->execute([$user_id]);
                
                $db->commit();
                
                // Activity Log
                $stmt = $db->prepare("INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES (?, 'customer_delete', ?, ?)");
                $stmt->execute([$_SESSION['user_id'], "Kunde {$customer['customer_number']} gelöscht", $_SERVER['REMOTE_ADDR']]);
                
                $success = "Kunde wurde erfolgreich gelöscht";
            }
        } catch (Exception $e) {
            if ($db->inTransaction()) {
                $db->rollBack();
            }
            error_log("Admin-Bereich: " . $e->getMessage());
            $error = "Die Aktion konnte nicht ausgefuehrt werden. Bitte versuchen Sie es erneut.";
        }
    } else {
        $error = "CSRF-Token ungültig";
    }
}

// Alle Kunden abrufen
$stmt = $db->query("
    SELECT u.id, u.email, u.status, u.last_login, u.created_at,
           cp.company_name, cp.contact_person, cp.phone, cp.customer_number
    FROM users u
    LEFT JOIN customer_profiles cp ON u.id = cp.user_id
    WHERE u.role = 'customer'
    ORDER BY cp.customer_number DESC
");
$customers = $stmt->fetchAll();

$page_title = 'Kunden verwalten';
include '../includes/header.php';
?>

<section class="dashboard">
    <div class="container">
        <div class="dashboard-header">
            <h1><i class="fas fa-users"></i> Kunden verwalten</h1>
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
        
        <div style="margin-bottom: var(--spacing-lg);">
            <button onclick="showAddModal()" class="btn btn-primary">
                <i class="fas fa-plus"></i> Neuen Kunden anlegen
            </button>
        </div>
        
        <div class="card">
            <div class="table-responsive">
                <table id="customersTable">
                    <thead>
                        <tr>
                            <th>Kundennummer</th>
                            <th>Firma</th>
                            <th>Ansprechpartner</th>
                            <th>E-Mail</th>
                            <th>Telefon</th>
                            <th>Status</th>
                            <th>Letzter Login</th>
                            <th>Aktionen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($customers as $customer): ?>
                        <tr>
                            <td><?php echo e($customer['customer_number']); ?></td>
                            <td><?php echo e($customer['company_name']); ?></td>
                            <td><?php echo e($customer['contact_person']); ?></td>
                            <td><?php echo e($customer['email']); ?></td>
                            <td><?php echo e($customer['phone'] ?: '-'); ?></td>
                            <td>
                                <?php
                                $badges = [
                                    'active' => '<span class="badge badge-success">Aktiv</span>',
                                    'inactive' => '<span class="badge">Inaktiv</span>',
                                    'locked' => '<span class="badge badge-error">Gesperrt</span>'
                                ];
                                echo $badges[$customer['status']] ?? '-';
                                ?>
                            </td>
                            <td><?php echo $customer['last_login'] ? date('d.m.Y H:i', strtotime($customer['last_login'])) : 'Nie'; ?></td>
                            <td>
                                <button onclick='editCustomer(<?php echo json_encode($customer, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>)' class="btn btn-sm btn-outline" title="Bearbeiten">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteCustomer(<?php echo $customer['id']; ?>, '<?php echo e($customer['customer_number']); ?>')" class="btn btn-sm btn-outline" style="color: var(--error-color);" title="Löschen">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Modal für Kunde hinzufügen/bearbeiten -->
<div id="customerModal" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 1000; overflow-y: auto;">
    <div style="max-width: 700px; margin: 50px auto; background: white; border-radius: var(--radius-lg); padding: var(--spacing-xl);">
        <h2 id="modalTitle">Neuen Kunden anlegen</h2>
        
        <form id="customerForm" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
            <input type="hidden" name="action" id="formAction" value="add">
            <input type="hidden" name="user_id" id="userId" value="">
            
            <div class="grid grid-2">
                <div class="form-group">
                    <label for="customer_number">Kundennummer *</label>
                    <input type="text" id="customer_number" name="customer_number" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="status">Status *</label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="active">Aktiv</option>
                        <option value="inactive">Inaktiv</option>
                        <option value="locked">Gesperrt</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="company_name">Firmenname *</label>
                <input type="text" id="company_name" name="company_name" class="form-control" required>
            </div>
            
            <div class="grid grid-2">
                <div class="form-group">
                    <label for="contact_person">Ansprechpartner *</label>
                    <input type="text" id="contact_person" name="contact_person" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="phone">Telefon</label>
                    <input type="tel" id="phone" name="phone" class="form-control">
                </div>
            </div>
            
            <div class="form-group">
                <label for="email">E-Mail-Adresse *</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="password">Passwort <span id="passwordHint">(leer lassen = nicht ändern)</span></label>
                <input type="password" id="password" name="password" class="form-control">
            </div>
            
            <div class="form-group">
                <label for="street">Straße</label>
                <input type="text" id="street" name="street" class="form-control">
            </div>
            
            <div class="grid grid-2">
                <div class="form-group">
                    <label for="postal_code">PLZ</label>
                    <input type="text" id="postal_code" name="postal_code" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="city">Stadt</label>
                    <input type="text" id="city" name="city" class="form-control">
                </div>
            </div>
            
            <div style="display: flex; gap: var(--spacing-md); margin-top: var(--spacing-lg);">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Speichern
                </button>
                <button type="button" onclick="closeModal()" class="btn btn-outline">
                    Abbrechen
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function showAddModal() {
    document.getElementById('modalTitle').textContent = 'Neuen Kunden anlegen';
    document.getElementById('formAction').value = 'add';
    document.getElementById('customerForm').reset();
    document.getElementById('userId').value = '';
    document.getElementById('passwordHint').style.display = 'none';
    document.getElementById('customerModal').style.display = 'block';
}

function editCustomer(customer) {
    document.getElementById('modalTitle').textContent = 'Kunde bearbeiten';
    document.getElementById('formAction').value = 'edit';
    document.getElementById('userId').value = customer.id;
    document.getElementById('customer_number').value = customer.customer_number;
    document.getElementById('company_name').value = customer.company_name;
    document.getElementById('contact_person').value = customer.contact_person;
    document.getElementById('email').value = customer.email;
    document.getElementById('phone').value = customer.phone || '';
    document.getElementById('street').value = customer.street || '';
    document.getElementById('postal_code').value = customer.postal_code || '';
    document.getElementById('city').value = customer.city || '';
    document.getElementById('status').value = customer.status;
    document.getElementById('passwordHint').style.display = 'inline';
    document.getElementById('customerModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('customerModal').style.display = 'none';
}

function deleteCustomer(userId, customerNumber) {
    if (confirm(`Möchten Sie den Kunden ${customerNumber} wirklich löschen? Diese Aktion kann nicht rückgängig gemacht werden.`)) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.innerHTML = `
            <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="user_id" value="${userId}">
        `;
        document.body.appendChild(form);
        form.submit();
    }
}
</script>

<?php include '../includes/footer.php'; ?>
