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
                    <!-- <th></th>  -->
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
                      <tr data-task-id="<?= $task->id ?>">
                      <!-- <td class="reorder-handle"><i class="fas fa-bars"></i></td> -->
                      <!-- <td><?= ($task->title) ?></td> -->
                       <td class="reorder-handle"><?= htmlspecialchars($task->title) ?></td>
                      <td  class="reorder-handle"><?= htmlspecialchars($task->description) ?></td>
                      <td  class="reorder-handle"><?= htmlspecialchars($task->start_date) ?></td>
                      <td  class="reorder-handle"><?= htmlspecialchars($task->end_date) ?></td>
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
<script>
  const updateOrderUrl = '<?= base_url("dashboard/updateOrder") ?>';
  $(document).ready(function () {
  $('#createTaskModal form').on('submit', function (e) {
    let isValid = true;

    const title = $('#create_title').val().trim();
    const desc = $('#create_description').val().trim();
    const start = $('#create_start').val();
    const end = $('#create_end').val();

    $(this).find('.form-control').removeClass('is-invalid');

    if (!title) {
      $('#create_title').addClass('is-invalid');
      isValid = false;
    }
    if (!desc) {
      $('#create_description').addClass('is-invalid');
      isValid = false;
    }
    if (!start) {
      $('#create_start').addClass('is-invalid');
      isValid = false;
    }
    if (!end) {
      $('#create_end').addClass('is-invalid');
      isValid = false;
    }

    if (!isValid) {
      e.preventDefault();
    }
  });

  $('#editTaskModal form').on('submit', function (e) {
    let isValid = true;

    const title = $('#edit_title').val().trim();
    const desc = $('#edit_description').val().trim();
    const start = $('#edit_start').val();
    const end = $('#edit_end').val();

    $(this).find('.form-control').removeClass('is-invalid');

    if (!title) {
      $('#edit_title').addClass('is-invalid');
      isValid = false;
    }
    if (!desc) {
      $('#edit_description').addClass('is-invalid');
      isValid = false;
    }
    if (!start) {
      $('#edit_start').addClass('is-invalid');
      isValid = false;
    }
    if (!end) {
      $('#edit_end').addClass('is-invalid');
      isValid = false;
    }

    if (!isValid) {
      e.preventDefault();
    }
  });

  $(document).on('click', '.update-status', function () {
    const taskId = $(this).data('id');
    const status = $(this).data('status');

    $.ajax({
      url: window.statusUpdateUrl,
      type: "POST",
      data: {
        task_id: taskId,
        status: status
      },
      success: function (response) {
        if (response.trim() === 'success') {
          toastr.success("Task status updated successfully!");
          setTimeout(() => location.reload(), 1000);
        } else {
          toastr.error("Something went wrong!");
        }
      },
      error: function () {
        toastr.error("Failed to update status.");
      }
    });
  });

let table = $('#taskstbl').DataTable({
  destroy: true,
  responsive: true,
  lengthChange: false,
  autoWidth: false,
  colReorder: true,
  rowReorder: {
    selector: 'td.reorder-handle',
    update: false  
  },
  order: [],
  columnDefs: [
    { orderable: false, targets: 0 }
  ],
  language: {
    emptyTable: "No tasks available yet.",
    zeroRecords: "Oops! No tasks match your search."
  },
  dom: '<"d-flex justify-content-between align-items-center mb-2"Bf>rt<"d-flex justify-content-between mt-2"ip>',
  buttons: [
    { extend: 'copy',  className: 'btn btn-sm btn-secondary' },
    { extend: 'csv',   className: 'btn btn-sm btn-secondary' },
    { extend: 'excel', className: 'btn btn-sm btn-secondary' },
    { extend: 'pdf',   className: 'btn btn-sm btn-secondary' },
    { extend: 'print', className: 'btn btn-sm btn-primary' }
  ]
});



table.on('row-reorder', function (e, diff, edit) {
  if (diff.length === 0) return;

  const orderData = [];

  diff.forEach(function (item) {
    const rowData = table.row(item.node).data();
    orderData.push({
      id: $(item.node).data('task-id'),  
      newPosition: item.newPosition
    });
  });
const csrfName = '<?= $this->security->get_csrf_token_name(); ?>';
const csrfHash = '<?= $this->security->get_csrf_hash(); ?>';
  $.ajax({
 url: "<?php echo base_url('dashboard/updateOrder'); ?>",
    type: 'POST',
  data: {
    order: orderData,
    [csrfName]: csrfHash 
  },
    dataType: 'json',
    success: function (res) {
      if (res.status === 'success') {
        toastr.success('Order updated successfully!');
        // location.reload(); 
      } else {
        toastr.error('Update failed.');
      }
    },
    error: function () {
      toastr.error('Server response invalid');
    }
  });
});


  $('.editTaskBtn').click(function () {
    $('#edit_task_id').val($(this).data('id'));
    $('#edit_title').val($(this).data('title'));
    $('#edit_description').val($(this).data('description'));
    $('#edit_start').val($(this).data('start'));
    $('#edit_end').val($(this).data('end'));
  });

 $(document).on('click', '.deleteTaskBtn', function () {
  const taskId = $(this).data('id');

  Swal.fire({
    title: 'Delete task?',
    text: 'This action cannot be undone!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = window.deleteTaskUrl + taskId;
    }
  });
});


  if (window.toastrSuccessMsg) {
    toastr.success(window.toastrSuccessMsg);
  }
  if (window.toastrErrorMsg) {
    toastr.error(window.toastrErrorMsg);
  }
});

</script>
