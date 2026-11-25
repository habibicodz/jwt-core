<?php

session_start();

$pageTitle = "Tasks | JWT Testing";
$activeMenu = "dashboard";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <style>
        .hero {
            margin-top: 64px;
            padding: 32px;
            border: 1px solid #303030;
            border-radius: 8px;
            background: #191919;
        }

        .hero h1 {
            margin: 0 0 10px;
            font-size: clamp(1.6rem, 4vw, 2.4rem);
            font-weight: 700;
            line-height: 1.2;
        }

        .hero p {
            margin: 0;
            max-width: 60ch;
            color: #aaa;
            font-size: 1rem;
            line-height: 1.6;
        }

        .add-task {
            display: flex;
            gap: 8px;
            margin-bottom: 16px;
        }

        .add-task input,
        .task-edit {
            flex: 1;
            min-width: 0;
            min-height: 36px;
            padding: 6px 10px;
            border: 1px solid #3a3a3a;
            border-radius: 6px;
            background: #111;
            color: #eee;
            font: inherit;
        }

        .task-actions {
            display: flex;
            gap: 8px;
            flex: none;
        }

        .task-title.is-complete {
            color: #888;
            text-decoration: line-through;
        }

        @media (max-width: 560px) {

            .add-task,
            .task-item {
                flex-wrap: wrap;
            }

            .task-actions {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .hero {
                margin-top: 40px;
                padding: 24px 20px;
            }
        }
    </style>

    <link rel="stylesheet" href="../assets/App.css">
</head>

<body>
    <?php require("../components/header.php"); ?>

    <main>
        <section class="hero">
            <h1>Tasks</h1>
            <p>A minimal tasks page for the JWT demo. Add, edit, complete, and remove tasks below — changes last only
                until you reload the page.</p>
        </section>

        <section class="task-section">
            <form class="add-task" id="add-task-form">
                <input id="new-task" type="text" placeholder="Add a task" aria-label="New task" autocomplete="off"
                    required>
                <button class="button button-primary" type="submit">Add task</button>
            </form>

            <ul class="task-list" id="task-list">
                <li class="task-item">
                    <span class="task-title">Review project notes</span>
                    <div class="task-actions">
                        <button class="button button-quiet" type="button" data-action="toggle">Complete</button>
                        <button class="button button-quiet" type="button" data-action="edit">Edit</button>
                        <button class="button button-quiet" type="button" data-action="delete">Delete</button>
                    </div>
                </li>
                <li class="task-item">
                    <span class="task-title">Prepare weekly update</span>
                    <div class="task-actions">
                        <button class="button button-quiet" type="button" data-action="toggle">Complete</button>
                        <button class="button button-quiet" type="button" data-action="edit">Edit</button>
                        <button class="button button-quiet" type="button" data-action="delete">Delete</button>
                    </div>
                </li>
                <li class="task-item">
                    <span class="task-title is-complete">Organize workspace</span>
                    <div class="task-actions">
                        <button class="button button-quiet" type="button" data-action="toggle">Reopen</button>
                        <button class="button button-quiet" type="button" data-action="edit">Edit</button>
                        <button class="button button-quiet" type="button" data-action="delete">Delete</button>
                    </div>
                </li>
            </ul>
        </section>
    </main>

    <script>
        const list = document.getElementById("task-list");
        const newTask = document.getElementById("new-task");

        function taskRow(title) {
            const item = document.createElement("li");
            item.className = "task-item";
            item.innerHTML = `
                <span class="task-title"></span>
                <div class="task-actions">
                    <button class="button button-quiet" type="button" data-action="toggle">Complete</button>
                    <button class="button button-quiet" type="button" data-action="edit">Edit</button>
                    <button class="button button-quiet" type="button" data-action="delete">Delete</button>
                </div>`;
            item.querySelector(".task-title").textContent = title;
            return item;
        }

        document.getElementById("add-task-form").addEventListener("submit", (event) => {
            event.preventDefault();
            const title = newTask.value.trim();
            if (title === "") return;
            list.append(taskRow(title));
            newTask.value = "";
            newTask.focus();
        });

        list.addEventListener("click", (event) => {
            const button = event.target.closest("button[data-action]");
            if (!button) return;

            const item = button.closest(".task-item");
            const title = item.querySelector(".task-title");
            if (!title) return;

            if (button.dataset.action === "toggle") {
                const complete = title.classList.toggle("is-complete");
                button.textContent = complete ? "Reopen" : "Complete";
            } else if (button.dataset.action === "delete") {
                item.remove();
            } else if (button.dataset.action === "edit") {
                const field = document.createElement("input");
                field.type = "text";
                field.className = "task-edit";
                field.value = title.textContent;

                let finished = false;
                const finish = (save) => {
                    if (finished) return;
                    finished = true;
                    if (save) title.textContent = field.value.trim() || title.textContent;
                    field.replaceWith(title);
                };

                title.replaceWith(field);
                field.focus();
                field.select();
                field.addEventListener("keydown", (event) => {
                    if (event.key === "Enter") finish(true);
                    if (event.key === "Escape") finish(false);
                });
                field.addEventListener("blur", () => finish(true));
            }
        });
    </script>

    <?php require("../components/footer.php") ?>
</body>

</html>