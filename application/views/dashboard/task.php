<?php 
$this->load->view('layouts/header', ['title' => 'Dashboard']); 
?>

<style>
  .title-div {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
</style>

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
              <div class="title-div">
                <h3 class="card-title">Task Manager Table</h3>
                <a href="javascript:void(0)" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createTaskModal">
                  <i class="fa fa-plus mr-1"></i> Create Task
                </a>
              </div>
            </div>

            <div class="card-body">
              <table id="taskstbl" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($tasks as $task): ?>
                    <tr>
                      <td><?= htmlspecialchars($task->title) ?></td>
                      <td><?= htmlspecialchars($task->description) ?></td>
                      <td><?= $task->start_date ?></td>
                      <td><?= $task->end_date ?></td>
                      <td>
                        <div class="dropdown">
                          <button class="btn btn-sm 
                            <?php
                              switch ($task->status) {
                                case 'Not Started': echo 'btn-secondary'; break;
                                case 'In Progress': echo 'btn-primary'; break;
                                case 'Complete': echo 'btn-success'; break;
                                default: echo 'btn-secondary'; break; 
                              }
                            ?>
                            dropdown-toggle" 
                            type="button" 
                            id="statusDropdown<?= $task->id ?>" 
                            data-toggle="dropdown" 
                            aria-haspopup="true" 
                            aria-expanded="false">
                            <?= $task->status ?>
                          </button>
                          <div class="dropdown-menu" aria-labelledby="statusDropdown<?= $task->id ?>">
                            <a class="dropdown-item update-status" data-id="<?= $task->id ?>" data-status="Not Started">Mark as Not Started</a>
                            <a class="dropdown-item update-status" data-id="<?= $task->id ?>" data-status="In Progress">Mark as In Progress</a>
                            <a class="dropdown-item update-status" data-id="<?= $task->id ?>" data-status="Complete">Mark as Complete</a>
                          </div>
                        </div>
                      </td>
                      <td>
                        <i class="fas fa-edit text-primary editTaskBtn"
                          data-toggle="modal" data-target="#editTaskModal"
                          data-id="<?= $task->id ?>"
                          data-title="<?= htmlspecialchars($task->title) ?>"
                          data-description="<?= htmlspecialchars($task->description) ?>"
                          data-start="<?= $task->start_date ?>"
                          data-end="<?= $task->end_date ?>" 
                          style="cursor: pointer; margin-right: 0.5rem;">
                        </i>
                        <i class="fas fa-trash-alt text-danger deleteTaskBtn" data-id="<?= $task->id ?>" style="cursor: pointer;"></i>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editTaskModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?= site_url('dashboard/updateTask') ?>" method="post">
        <div class="modal-header">
          <h5 class="modal-title">Edit Task</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <input type="hidden" name="task_id" id="edit_task_id">

          <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" id="edit_title" class="form-control">
            <div class="invalid-feedback">Title is required.</div>
          </div>

          <div class="form-group">
            <label>Description</label>
            <textarea name="description" id="edit_description" class="form-control"></textarea>
            <div class="invalid-feedback">Description is required.</div>
          </div>

          <div class="form-group">
            <label>Start Date</label>
            <input type="date" name="start_date" id="edit_start" class="form-control">
            <div class="invalid-feedback">Start date is required.</div>
          </div>

          <div class="form-group">
            <label>End Date</label>
            <input type="date" name="end_date" id="edit_end" class="form-control">
            <div class="invalid-feedback">End date is required.</div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update Task</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="createTaskModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?= site_url('dashboard/storeTask') ?>" method="post">
        <div class="modal-header">
          <h5 class="modal-title">Create Task</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" id="create_title" class="form-control">
            <div class="invalid-feedback">Title is required.</div>
          </div>

          <div class="form-group">
            <label>Description</label>
            <textarea name="description" id="create_description" class="form-control"></textarea>
            <div class="invalid-feedback">Description is required.</div>
          </div>

          <div class="form-group">
            <label>Start Date</label>
            <input type="date" name="start_date" id="create_start" class="form-control">
            <div class="invalid-feedback">Start date is required.</div>
          </div>

          <div class="form-group">
            <label>End Date</label>
            <input type="date" name="end_date" id="create_end" class="form-control">
            <div class="invalid-feedback">End date is required.</div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success btn-sm">Save Task</button>
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php 
$this->load->view('layouts/footer'); 
?>
