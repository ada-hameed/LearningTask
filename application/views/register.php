<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Registration</title>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap">
  <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">

  <style>
    body {
      background-color: #eef2f7;
      font-family: 'Inter', sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }

    .register-box {
      width: 100%;
      max-width: 480px;
    }

    .card {
      border: none;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    }

    .card-body {
      padding: 2.5rem;
    }

    .register-title {
      font-size: 1.75rem;
      font-weight: 600;
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .form-control {
      border-radius: 8px;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: #007bff;
      box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.15);
    }

    .btn-primary {
      border-radius: 8px;
      font-weight: 600;
      padding: 0.6rem;
      transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }

    .input-group-text {
      border-radius: 0 8px 8px 0;
    }

    .alert {
      font-size: 0.95rem;
      padding: 0.75rem;
      margin-bottom: 1.25rem;
    }
  </style>
</head>
<body>

<div class="register-box">
  <div class="card">
    <div class="card-body">
      <div class="register-title">User Registration</div>
     <?php if ($this->session->flashdata('toastr_error')): ?>
  <div class="alert alert-danger" role="alert">
    <?= strip_tags($this->session->flashdata('toastr_error')) ?>
    
  </div>
<?php endif; ?>


<form id="registerForm" action="<?= base_url('register/save') ?>" method="post" novalidate>
  <div class="input-group mb-3">
    <input type="text" name="name" class="form-control" placeholder="Full Name" required>
    <div class="input-group-append">
      <div class="input-group-text"><i class="fas fa-user"></i></div>
    </div>
    <div class="invalid-feedback">Please enter your full name.</div>
  </div>

  <div class="input-group mb-3">
    <input type="email" name="email" class="form-control" placeholder="Email" required>
    <div class="input-group-append">
      <div class="input-group-text"><i class="fas fa-envelope"></i></div>
    </div>
    <div class="invalid-feedback">Please enter a valid email address.</div>
  </div>

  <div class="input-group mb-3">
    <input type="tel" name="mobile" class="form-control" placeholder="Mobile Number" pattern="[0-9]{10}" maxlength="10" required oninput="this.value=this.value.replace(/[^0-9]/g,'');">
    <div class="input-group-append">
      <div class="input-group-text"><i class="fas fa-phone"></i></div>
    </div>
    <div class="invalid-feedback">Please enter a valid 10-digit mobile number.</div>
  </div>

  <div class="input-group mb-3">
    <input type="password" name="password" class="form-control" placeholder="Password" required>
    <div class="input-group-append">
      <div class="input-group-text"><i class="fas fa-lock"></i></div>
    </div>
    <div class="invalid-feedback">Please enter your password.</div>
  </div>

  <button type="submit" class="btn btn-primary btn-block">Create Account</button>
</form>

<p class="mt-3 text-center">
  Already have an account? <a href="<?= base_url('login') ?>">Login here</a>
</p>

    </div>
  </div>
</div>
<!-- JS Scripts -->
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/dist/js/adminlte.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= base_url('assets/js/register.js') ?>"></script>
</body>
</html>
