<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CRUD Operations</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        #form-container {
            margin-bottom: 20px;
        }

        #crud-form {
            display: flex;
            flex-direction: column;
            width: 300px;
        }

        #crud-form label,
        #crud-form input {
            margin-bottom: 10px;
        }

        #items-container {
            margin-top: 20px;
        }

        #items-table {
            width: 100%;
            border-collapse: collapse;
        }

        #items-table th,
        #items-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #items-table th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>

<body>
    <h1>CRUD Operations with PHP and Local Storage</h1>

    <div id="form-container">
        <form id="crud-form">
            <input type="hidden" id="item-id" name="item-id">
            <label for="item-name">Name:</label>
            <input type="text" id="item-name" name="item-name" required>
            <label for="item-description">Description:</label>
            <input type="text" id="item-description" name="item-description" required>
            <button type="submit">Save</button>
        </form>
    </div>

    <div id="items-container">
        <table id="items-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Items will be dynamically inserted here -->
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('crud-form');
            const itemsTable = document.getElementById('items-table').getElementsByTagName('tbody')[0];

            function saveItem(event) {
                event.preventDefault();

                const id = document.getElementById('item-id').value;
                const name = document.getElementById('item-name').value;
                const description = document.getElementById('item-description').value;

                let items = JSON.parse(localStorage.getItem('items')) || [];

                if (id) {
                    items = items.map(item => item.id === id ? { id, name, description } : item);
                } else {
                    const newItem = {
                        id: (new Date()).getTime().toString(),
                        name,
                        description
                    };
                    items.push(newItem);
                }

                localStorage.setItem('items', JSON.stringify(items));
                renderItems();
                form.reset();
            }

            function renderItems() {
                itemsTable.innerHTML = '';
                const items = JSON.parse(localStorage.getItem('items')) || [];

                items.forEach(item => {
                    const row = itemsTable.insertRow();
                    row.innerHTML = `
                        <td>${item.id}</td>
                        <td>${item.name}</td>
                        <td>${item.description}</td>
                        <td>
                            <button onclick="editItem('${item.id}')">Edit</button>
                            <button onclick="deleteItem('${item.id}')">Delete</button>
                        </td>
                    `;
                });
            }

            form.addEventListener('submit', saveItem);

            window.editItem = function (id) {
                const items = JSON.parse(localStorage.getItem('items')) || [];
                const item = items.find(item => item.id === id);

                document.getElementById('item-id').value = item.id;
                document.getElementById('item-name').value = item.name;
                document.getElementById('item-description').value = item.description;
            };

            window.deleteItem = function (id) {
                let items = JSON.parse(localStorage.getItem('items')) || [];
                items = items.filter(item => item.id !== id);

                localStorage.setItem('items', JSON.stringify(items));
                renderItems();
            };

            renderItems();
        });
    </script>
</body>

</html>
