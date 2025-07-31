<?php $this->load->view('layouts/header', ['title' => $title]); ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid"></div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">My Profile</h3>
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead class="thead-light">
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
  <div style="display: flex; align-items: center; gap: 10px;">
    <img 
      src="<?= base_url(!empty($profile->profile_image) ? $profile->profile_image : 'assets/dist/img/user2-160x160.jpg') ?>" 
      alt="Photo" 
      width="30" 
      height="30" 
      style="object-fit: cover; border-radius: 50%;">
    <span><?= $profile->name ?></span>
  </div>
</td>

                    <td><?= $profile->email ?></td>
                    <td><?= $profile->contact_number ?></td>
                    <td>
                      <i class="fas fa-edit text-primary" data-toggle="modal" data-target="#editProfileModal" style="cursor: pointer;"></i>
                    </td>
                  </tr>
                </tbody>
              </table>

              <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
<form id="editProfileForm"
      action="<?= base_url('dashboard/update_profile') ?>"
      method="post"
      enctype="multipart/form-data"
      data-success="<?= $this->session->flashdata('success') ?>"
      data-error="<?= $this->session->flashdata('error') ?>">

  <div class="modal-header">
    <h5 class="modal-title">Edit Profile</h5>
    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
  </div>

  <div class="modal-body">
    <input type="hidden" name="id" value="<?= $profile->id ?>">

    <div class="form-group">
      <label>Name</label>
      <input type="text" name="name" class="form-control" value="<?= $profile->name ?>">
      <div class="invalid-feedback">Name is required.</div>
    </div>

    <div class="form-group">
      <label>Email</label>
      <input type="email" name="email" class="form-control" value="<?= $profile->email ?>">
      <div class="invalid-feedback">Email is required.</div>
    </div>

    <div class="form-group">
      <label>Phone</label>
      <input type="text" name="contact_number" class="form-control" pattern="[0-9]{10}" maxlength="10"
             oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="<?= $profile->contact_number ?>">
      <div class="invalid-feedback">Phone number is required.</div>
    </div>

    <div class="form-group">
      <label>New Password</label>
      <input type="password" name="password" class="form-control">
    </div>

    <div class="form-group">
      <label>Profile Image (optional)</label><br>
      <?php if (!empty($profile->profile_image)): ?>
        <img src="<?= base_url($profile->profile_image) ?>" alt="Profile" width="70" class="mb-2 rounded">
      <?php else: ?>
        <img src="<?= base_url('assets/dist/img/user2-160x160.jpg') ?>" alt="Default" width="70" class="mb-2 rounded">
      <?php endif; ?>
      <input type="file" name="profile_image" class="form-control-file mt-2">
      <small class="form-text text-muted">Max 2MB. Allowed: JPG, JPEG, PNG.</small>
    </div>
  </div>

  <div class="modal-footer">
    <button type="submit" class="btn btn-sm btn-success">Update</button>
    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
  </div>

</form>

                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('layouts/footer'); ?>
