<?php
/**
 * Customer Management - Add New Customer
 * Form untuk menambah customer baru
 */

define('APP_ACCESS', true);
require_once '../../config/config.php';
require_once '../../includes/functions.php';

// Require admin access
requireAdmin();

$page_title = 'Add New Customer - ' . APP_NAME;
$is_admin_page = true;

// Check for flash messages
$flash = getFlashMessage();

// Include header
include '../../includes/header.php';
?>
?>

<div class="d-flex">
    <?php include '../../includes/admin_sidebar.php'; ?>
    
    <div class="admin-content flex-grow-1">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2><i class="fas fa-user-plus me-2"></i>Add New Customer</h2>
                <p class="text-muted mb-0">Create a new customer account</p>
            </div>
            <a href="index.php" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Customers
            </a>
        </div>

        <!-- Form -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Customer Information</h5>
                    </div>
                    <div class="card-body">
                        <?php if ($flash): ?>
                            <div class="alert alert-<?= $flash['type'] === 'error' ? 'danger' : $flash['type'] ?> alert-dismissible fade show">
                                <i class="fas fa-<?= $flash['type'] === 'success' ? 'check-circle' : ($flash['type'] === 'error' ? 'exclamation-triangle' : 'info-circle') ?> me-2"></i>
                                <?= htmlspecialchars($flash['message']) ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="process.php" class="needs-validation" novalidate>
                            <input type="hidden" name="action" value="create">
                            <input type="hidden" name="csrf_token" value="<?= generateCSRFToken() ?>">
                            <div class="row g-3">
                                <!-- Name -->
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="name" 
                                           name="name" 
                                           required>
                                    <div class="invalid-feedback">
                                        Please provide a valid customer name.
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" 
                                           class="form-control" 
                                           id="email" 
                                           name="email" 
                                           required>
                                    <div class="invalid-feedback">
                                        Please provide a valid email address.
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" 
                                           class="form-control" 
                                           id="phone" 
                                           name="phone" 
                                           placeholder="+1234567890">
                                </div>

                                <!-- Status -->
                                <div class="col-md-6">
                                    <label for="is_active" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select" 
                                            id="is_active" 
                                            name="is_active" 
                                            required>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <!-- Address -->
                                <div class="col-12">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" 
                                              id="address" 
                                              name="address" 
                                              rows="3"
                                              placeholder="Street address, apartment, suite, etc."></textarea>
                                </div>

                                <!-- City -->
                                <div class="col-md-6">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="city" 
                                           name="city">
                                </div>

                                <!-- Postal Code -->
                                <div class="col-md-6">
                                    <label for="postal_code" class="form-label">Postal Code</label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="postal_code" 
                                           name="postal_code">
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="d-flex justify-content-between">
                                <a href="index.php" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-2"></i>Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Create Customer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Help -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Guidelines</h6>
                    </div>
                    <div class="card-body">
                        <h6>Required Information:</h6>
                        <ul class="small">
                            <li>Full name is required</li>
                            <li>Valid email address</li>
                            <li>Customer status (active/inactive)</li>
                        </ul>

                        <h6>Optional Information:</h6>
                        <ul class="small">
                            <li>Phone number</li>
                            <li>Address details</li>
                            <li>City and postal code</li>
                        </ul>

                        <h6>Tips:</h6>
                        <ul class="small">
                            <li>Email must be unique</li>
                            <li>Phone numbers can include country codes</li>
                            <li>Active customers can place orders</li>
                        </ul>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-lightbulb me-2"></i>Quick Actions</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-outline-info btn-sm" onclick="fillSampleData()">
                                <i class="fas fa-magic me-2"></i>Fill Sample Data
                            </button>
                            <a href="index.php" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-list me-2"></i>View All Customers
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Form validation
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

// Fill sample data for testing
function fillSampleData() {
    document.getElementById('name').value = 'John Doe';
    document.getElementById('email').value = 'john.doe@example.com';
    document.getElementById('phone').value = '+1234567890';
    document.getElementById('address').value = '123 Main Street, Apt 4B';
    document.getElementById('city').value = 'New York';
    document.getElementById('postal_code').value = '10001';
}

// Real-time email validation
document.getElementById('email').addEventListener('blur', function() {
    const email = this.value;
    if (email) {
        // You could add AJAX check for email existence here
        // For now, just validate format
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            this.setCustomValidity('Please enter a valid email address');
        } else {
            this.setCustomValidity('');
        }
    }
});
</script>
