/**
 * MDC Facility Management - Main JavaScript
 */

// ===== Mobile Menu Toggle =====
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    const hasDropdown = document.querySelectorAll('.has-dropdown');
    
    // Mobile menu toggle
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function() {
            navMenu.classList.toggle('active');
            this.classList.toggle('active');
        });
    }
    
    // Mobile dropdown toggle
    hasDropdown.forEach(function(item) {
        const link = item.querySelector('a');
        link.addEventListener('click', function(e) {
            if (window.innerWidth <= 768) {
                e.preventDefault();
                item.classList.toggle('active');
            }
        });
    });
    
    // Close mobile menu when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.main-nav')) {
            navMenu.classList.remove('active');
            if (mobileMenuToggle) {
                mobileMenuToggle.classList.remove('active');
            }
        }
    });
});

// ===== Scroll to Top Button =====
const scrollToTopBtn = document.getElementById('scrollToTop');

if (scrollToTopBtn) {
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            scrollToTopBtn.classList.add('visible');
        } else {
            scrollToTopBtn.classList.remove('visible');
        }
    });
    
    scrollToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

// ===== Smooth Scrolling for Anchor Links =====
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            e.preventDefault();
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// ===== Cookie Consent =====
function checkCookieConsent() {
    const consent = localStorage.getItem('cookieConsent');
    if (!consent) {
        const cookieConsent = document.getElementById('cookieConsent');
        if (cookieConsent) {
            cookieConsent.style.display = 'block';
        }
    }
}

function acceptCookies() {
    localStorage.setItem('cookieConsent', 'accepted');
    document.getElementById('cookieConsent').style.display = 'none';
}

function rejectCookies() {
    localStorage.setItem('cookieConsent', 'rejected');
    document.getElementById('cookieConsent').style.display = 'none';
}

// Check cookie consent on page load
checkCookieConsent();

// ===== Form Validation =====
function validateContactForm(form) {
    const requiredFields = form.querySelectorAll('[required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            isValid = false;
            field.classList.add('error');
        } else {
            field.classList.remove('error');
        }
    });
    
    // Email validation
    const emailField = form.querySelector('input[type="email"]');
    if (emailField && emailField.value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(emailField.value)) {
            isValid = false;
            emailField.classList.add('error');
            showMessage('Bitte geben Sie eine gültige E-Mail-Adresse ein.', 'error');
        }
    }
    
    // Phone validation
    const phoneField = form.querySelector('input[type="tel"]');
    if (phoneField && phoneField.value) {
        const phoneRegex = /^[0-9\s\+\-\(\)\/]+$/;
        if (!phoneRegex.test(phoneField.value)) {
            isValid = false;
            phoneField.classList.add('error');
            showMessage('Bitte geben Sie eine gültige Telefonnummer ein.', 'error');
        }
    }
    
    // Privacy checkbox validation
    const privacyCheckbox = form.querySelector('input[name="privacy"]');
    if (privacyCheckbox && !privacyCheckbox.checked) {
        isValid = false;
        showMessage('Bitte akzeptieren Sie die Datenschutzbestimmungen.', 'error');
    }
    
    return isValid;
}

// ===== Contact Form Handler =====
const contactForm = document.getElementById('contactForm');
if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
        // Validierung im Browser; der Versand erfolgt per normalem POST an kontakt.php
        if (!validateContactForm(this)) {
            e.preventDefault();
        }
    });
}

// ===== Show Message Function =====
function showMessage(message, type = 'info') {
    // Remove existing messages
    const existingMessages = document.querySelectorAll('.alert');
    existingMessages.forEach(msg => msg.remove());
    
    // Create new message
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type}`;
    alertDiv.innerHTML = message;
    
    // Insert at the top of the form
    const form = document.querySelector('form');
    if (form) {
        form.insertBefore(alertDiv, form.firstChild);
        
        // Scroll to message
        alertDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
        
        // Auto-remove after 5 seconds
        setTimeout(() => {
            alertDiv.remove();
        }, 5000);
    }
}

// ===== Intersection Observer for Animations =====
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -100px 0px'
};

const observer = new IntersectionObserver(function(entries) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('fade-in');
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

// Observe elements
document.querySelectorAll('.card, .hero-content').forEach(el => {
    observer.observe(el);
});

// ===== FAQ Accordion =====
document.querySelectorAll('.faq-question').forEach(question => {
    question.addEventListener('click', function() {
        const faqItem = this.closest('.faq-item');
        const isActive = faqItem.classList.contains('active');
        
        // Close all FAQ items
        document.querySelectorAll('.faq-item').forEach(item => {
            item.classList.remove('active');
        });
        
        // Open clicked item if it wasn't active
        if (!isActive) {
            faqItem.classList.add('active');
        }
    });
});

// ===== Image Gallery =====
function initImageGallery() {
    const galleryImages = document.querySelectorAll('.gallery-image');
    
    galleryImages.forEach(img => {
        img.addEventListener('click', function() {
            // Create modal overlay
            const modal = document.createElement('div');
            modal.className = 'image-modal';
            modal.innerHTML = `
                <div class="modal-content">
                    <span class="modal-close">&times;</span>
                    <img src="${this.src}" alt="${this.alt}">
                </div>
            `;
            
            document.body.appendChild(modal);
            document.body.style.overflow = 'hidden';
            
            // Close modal
            modal.querySelector('.modal-close').addEventListener('click', function() {
                modal.remove();
                document.body.style.overflow = '';
            });
            
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.remove();
                    document.body.style.overflow = '';
                }
            });
        });
    });
}

initImageGallery();

// ===== File Upload Preview =====
function handleFileUpload(input) {
    const fileList = input.parentElement.querySelector('.file-list');
    if (!fileList) return;
    
    fileList.innerHTML = '';
    
    Array.from(input.files).forEach((file, index) => {
        const fileItem = document.createElement('div');
        fileItem.className = 'file-item';
        fileItem.innerHTML = `
            <i class="fas fa-file"></i>
            <span>${file.name}</span>
            <span class="file-size">(${formatFileSize(file.size)})</span>
            <button type="button" onclick="removeFile(this, ${index})" class="btn-remove">
                <i class="fas fa-times"></i>
            </button>
        `;
        fileList.appendChild(fileItem);
    });
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
}

function removeFile(button, index) {
    // This is a simplified version - full implementation would require managing FileList
    button.closest('.file-item').remove();
}

// ===== Dashboard Table Sorting =====
function sortTable(table, column, asc = true) {
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    
    const sortedRows = rows.sort((a, b) => {
        const aText = a.children[column].textContent.trim();
        const bText = b.children[column].textContent.trim();
        
        return asc ? aText.localeCompare(bText, 'de') : bText.localeCompare(aText, 'de');
    });
    
    sortedRows.forEach(row => tbody.appendChild(row));
}

// ===== Confirm Dialog =====
function confirmAction(message, callback) {
    if (confirm(message)) {
        callback();
    }
}

// ===== AJAX Helper Function =====
async function apiRequest(url, method = 'GET', data = null) {
    const options = {
        method: method,
        headers: {
            'Content-Type': 'application/json',
        }
    };
    
    if (data) {
        options.body = JSON.stringify(data);
    }
    
    try {
        const response = await fetch(url, options);
        const result = await response.json();
        return result;
    } catch (error) {
        console.error('API Error:', error);
        throw error;
    }
}

// ===== Auto-save Draft (for long forms) =====
function enableAutoSave(form, interval = 30000) {
    setInterval(() => {
        const formData = new FormData(form);
        const data = Object.fromEntries(formData);
        localStorage.setItem(`draft_${form.id}`, JSON.stringify(data));
    }, interval);
}

// Load draft on page load
function loadDraft(form) {
    const draft = localStorage.getItem(`draft_${form.id}`);
    if (draft) {
        const data = JSON.parse(draft);
        Object.keys(data).forEach(key => {
            const field = form.elements[key];
            if (field) {
                field.value = data[key];
            }
        });
    }
}

// ===== Print Function =====
function printPage() {
    window.print();
}

// ===== Copy to Clipboard =====
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        showMessage('Text wurde in die Zwischenablage kopiert.', 'success');
    }).catch(err => {
        console.error('Copy failed:', err);
        showMessage('Kopieren fehlgeschlagen.', 'error');
    });
}

// ===== Initialize Tooltips (if needed) =====
function initTooltips() {
    const tooltips = document.querySelectorAll('[data-tooltip]');
    tooltips.forEach(element => {
        element.addEventListener('mouseenter', function() {
            const tooltip = document.createElement('div');
            tooltip.className = 'tooltip';
            tooltip.textContent = this.dataset.tooltip;
            document.body.appendChild(tooltip);
            
            const rect = this.getBoundingClientRect();
            tooltip.style.top = (rect.top - tooltip.offsetHeight - 10) + 'px';
            tooltip.style.left = (rect.left + rect.width / 2 - tooltip.offsetWidth / 2) + 'px';
        });
        
        element.addEventListener('mouseleave', function() {
            document.querySelectorAll('.tooltip').forEach(t => t.remove());
        });
    });
}

initTooltips();

// ===== Console Welcome Message =====
console.log('%cMDC Facility Management', 'font-size: 24px; font-weight: bold; color: #0066CC;');
console.log('%cProfessionelle Gebäudereinigung in München', 'font-size: 14px; color: #666;');
console.log('Website developed with modern web technologies');
