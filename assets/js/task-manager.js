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

  $('#taskstbl').DataTable({
  destroy: true,
  responsive: true,
  lengthChange: false,
  autoWidth: false,
  colReorder: true, 
  
      language: {
        emptyTable: "No tasks available yet.",
        zeroRecords: "Oops! No tasks match your search. "
    },
  dom: '<"d-flex justify-content-between align-items-center mb-2"Bf>rt<"d-flex justify-content-between mt-2"ip>',
  buttons: [
    { extend: 'copy',  className: 'btn btn-sm btn-secondary' },
    { extend: 'csv',   className: 'btn btn-sm btn-secondary' },
    { extend: 'excel', className: 'btn btn-sm btn-secondary' },
    { extend: 'pdf',   className: 'btn btn-sm btn-secondary' },
    { extend: 'print', className: 'btn btn-sm btn-primary' }
  ]
}).buttons().container().appendTo('#taskstbl_wrapper .col-md-6:eq(0)');

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
