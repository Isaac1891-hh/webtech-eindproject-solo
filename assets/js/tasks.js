$(document).ready(function () {
    $('#taskForm').on('submit', function (event) {
        event.preventDefault();

        $.ajax({
            url: 'api/add_task.php',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    const task = response.task;
                    const html = `
                        <div class="task" id="task-${task.id}">
                            <h3>${task.title}</h3>
                            <p>${task.description}</p>
                            <span class="badge">Status: ${task.status}</span>
                            <button class="deleteTask" data-id="${task.id}">Verwijderen</button>
                        </div>
                    `;
                    $('#taskList').prepend(html);
                    $('#taskForm')[0].reset();
                    $('#message').text('Taak succesvol toegevoegd.');
                } else {
                    $('#message').text(response.message);
                }
            }
        });
    });

    $(document).on('click', '.deleteTask', function () {
        const id = $(this).data('id');

        $.ajax({
            url: 'api/delete_task.php',
            method: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    $('#task-' + id).remove();
                }
            }
        });
    });
});
