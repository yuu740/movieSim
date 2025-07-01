<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MovieSim</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(to bottom, #1a1a1a, #2c1e1e);
            min-height: 100vh;
            color: #f5f5f5;
            font-family: 'Cinzel', serif;
        }
        .container {
            background: rgba(0, 0, 0, 0.7);
            border: 2px solid #b8860b;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
        }
        table {
            background: #2c2c2c;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            border: 1px solid #444;
            padding: 1rem;
        }
        th {
            background: #8b0000;
            color: #ffd700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        tbody tr {
            transition: background 0.3s ease;
        }
        tbody tr:hover {
            background: #3a3a3a;
        }
        h1, h3 {
            color: #ffd700;
            text-shadow: 0 0 8px rgba(255, 215, 0, 0.5);
        }
        p {
            color: #d3d3d3;
            font-style: italic;
        }
        .form-container {
            background: #1c1c1c;
            border: 1px solid #b8860b;
            border-radius: 8px;
            padding: 1.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .form-container:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(184, 134, 11, 0.3);
        }
        input[type="text"], input[type="file"] {
            background: #333;
            border: 1px solid #555;
            color: #f5f5f5;
            border-radius: 6px;
            padding: 0.75rem;
            transition: border-color 0.3s ease;
        }
        input[type="text"]:focus, input[type="file"]:focus {
            outline: none;
            border-color: #ffd700;
            box-shadow: 0 0 8px rgba(255, 215, 0, 0.4);
        }
        input[type="submit"] {
            background: #8b0000;
            color: #ffd700;
            border: none;
            border-radius: 6px;
            padding: 0.75rem;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        }
        input[type="submit"]:hover {
            background: #a10000;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 215, 0, 0.3);
        }
        label {
            color: #d3d3d3;
            font-weight: 500;
        }
        @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap');
    </style>
</head>
<body class="font-sans text-gray-200">
    <div class="container mx-auto p-6 max-w-5xl">
        <h1 class="text-4xl font-bold text-center mb-2">Welcome to MovieSim</h1>
        <p class="text-center mb-8">The simulation for CRUD Movie with PHP Laravel</p>
        <!-- Table Section -->
        <div class="bg-white rounded-lg overflow-hidden mb-8">
            <table class="w-full border-collapse">
                <thead class="bg-indigo-600 text-white">
                    <tr>
                        <th class="p-4 text-left">ID</th>
                        <th class="p-4 text-left">Photo</th>
                        <th class="p-4 text-left">Title</th>
                        <th class="p-4 text-left">Description</th>
                        <th class="p-4 text-left">Episodes</th>
                        <th class="p-4 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-50">
                    <!-- Table rows will be populated dynamically -->
                </tbody>
            </table>
        </div>

        <!-- Form Sections -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Insert Movie Form -->
            <div class="form-container">
                <h3 class="text-xl font-semibold text-indigo-600 mb-4">Insert Movie</h3>
                <form enctype="multipart/form-data" class="space-y-4">
                    <div>
                        <label for="imageInsert" class="block text-sm font-medium">Image</label>
                        <input type="file" id="imageInsert" name="image" class="mt-1 block w-full">
                    </div>
                    <div>
                        <label for="titleInsert" class="block text-sm font-medium">Title</label>
                        <input type="text" id="titleInsert" name="title" placeholder="Insert the Title" class="mt-1 block w-full">
                    </div>
                    <div>
                        <label for="descInsert" class="block text-sm font-medium">Description</label>
                        <input type="text" id="descInsert" name="description" placeholder="Insert the Description" class="mt-1 block w-full">
                    </div>
                    <input type="submit" value="Insert" class="w-full">
                </form>
            </div>

            <!-- Insert Episode Form -->
            <div class="form-container">
                <h3 class="text-xl font-semibold text-indigo-600 mb-4">Insert Episode</h3>
                <form enctype="multipart/form-data" action="/movie" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="movieIDInsert" class="block text-sm font-medium">Movie ID</label>
                        <input type="text" id="movieIDInsert" name="movieID" placeholder="Movie ID" class="mt-1 block w-full">
                    </div>
                    <div>
                        <label for="episodeInsert" class="block text-sm font-medium">Episode</label>
                        <input type="text" id="episodeInsert" name="episode" placeholder="Episode" class="mt-1 block w-full">
                    </div>
                    <div>
                        <label for="titleInsert" class="block text-sm font-medium">Title</label>
                        <input type="text" id="titleInsert" name="title" placeholder="Title" class="mt-1 block w-full">
                    </div>
                    <input type="submit" value="Insert" class="w-full">
                </form>
            </div>

            <!-- Update Movie Form -->
            <div class="form-container">
                <h3 class="text-xl font-semibold text-indigo-600 mb-4">Update Movie</h3>
                <form enctype="multipart/form-data" class="space-y-4">
                    <div>
                        <label for="idUpdate" class="block text-sm font-medium">ID</label>
                        <input type="text" id="idUpdate" name="id" placeholder="ID" class="mt-1 block w-full">
                    </div>
                    <div>
                        <label for="imageUpdate" class="block text-sm font-medium">Image</label>
                        <input type="file" id="imageUpdate" name="image" class="mt-1 block w-full">
                    </div>
                    <div>
                        <label for="titleUpdate" class="block text-sm font-medium">Title</label>
                        <input type="text" id="titleUpdate" name="title" placeholder="Title" class="mt-1 block w-full">
                    </div>
                    <div>
                        <label for="descUpdate" class="block text-sm font-medium">Description</label>
                        <input type="text" id="descUpdate" name="description" placeholder="Description" class="mt-1 block w-full">
                    </div>
                    <input type="submit" value="Update" class="w-full">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
