<?php

session_start();

$authorizationHeader = $_


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    <link rel="stylesheet" href="../assets/App.css">
</head>

<body>
    <main class="task-page">
        <header class="task-toolbar">
            <p class="username">alex.morgan</p>
            <button class="button button-quiet" type="button">Log out</button>
        </header>

        <section class="task-section" aria-labelledby="tasks-heading">
            <div class="task-heading">
                <h1 id="tasks-heading">Tasks</h1>
                <button class="button button-primary" type="button" data-dialog-open="add-task-dialog">Add task</button>
            </div>

            <ul class="task-list">
                <li class="task-item">
                    <span>Review project notes</span>
                    <button class="button button-quiet" type="button" data-dialog-open="edit-task-dialog">Edit</button>
                </li>
                <li class="task-item">
                    <span>Prepare weekly update</span>
                    <button class="button button-quiet" type="button" data-dialog-open="edit-task-dialog">Edit</button>
                </li>
                <li class="task-item">
                    <span>Organize workspace</span>
                    <button class="button button-quiet" type="button" data-dialog-open="edit-task-dialog">Edit</button>
                </li>
            </ul>
        </section>
    </main>

    <dialog class="task-dialog" id="add-task-dialog" aria-labelledby="add-task-heading">
        <form method="dialog">
            <h2 id="add-task-heading">Add task</h2>
            <label for="new-task-title">Task name</label>
            <input id="new-task-title" name="task-title" type="text" placeholder="Enter a task name">
            <div class="dialog-actions">
                <button class="button button-quiet" value="cancel">Cancel</button>
                <button class="button button-primary" value="add">Add task</button>
            </div>
        </form>
    </dialog>

    <dialog class="task-dialog" id="edit-task-dialog" aria-labelledby="edit-task-heading">
        <form method="dialog">
            <h2 id="edit-task-heading">Edit task</h2>
            <label for="edit-task-title">Task name</label>
            <input id="edit-task-title" name="task-title" type="text">
            <div class="dialog-actions">
                <button class="button button-quiet" value="cancel">Cancel</button>
                <button class="button button-primary" value="save">Save changes</button>
            </div>
        </form>
    </dialog>

    <script>
        document.querySelectorAll("[data-dialog-open]").forEach((button) => {
            button.addEventListener("click", () => {
                const dialog = document.getElementById(button.dataset.dialogOpen);

                if (dialog.id === "edit-task-dialog") {
                    dialog.querySelector("input").value = button.closest(".task-item").querySelector("span").textContent.trim();
                }

                dialog.showModal();
            });
        });
    </script>
</body>

</html>