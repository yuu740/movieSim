<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MovieSim</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #0f172a, #1e293b);
            min-height: 100vh;
            color: #e2e8f0;
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }
        .container {
            background: rgba(15, 23, 42, 0.85);
            border: 1px solid #64748b;
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
        }
        h1 {
            font-family: 'Cinzel', serif;
            color: #facc15;
            text-shadow: 0 0 12px rgba(250, 204, 21, 0.5);
            letter-spacing: 1px;
        }
        p.subtitle {
            color: #94a3b8;
            font-style: italic;
            letter-spacing: 0.5px;
        }
        table {
            background: #1e293b;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
        }
        th, td {
            padding: 1.25rem;
            border: 1px solid #334155;
        }
        th {
            background: #7f1d1d;
            color: #facc15;
            font-family: 'Cinzel', serif;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }
        tbody tr {
            transition: all 0.3s ease;
        }
        tbody tr:hover {
            background: #334155;
            transform: translateY(-2px);
        }
        .form-container {
            background: #1e293b;
            border: 1px solid #64748b;
            border-radius: 12px;
            padding: 2rem;
            transition: all 0.3s ease;
        }
        .form-container:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(250, 204, 21, 0.2);
        }
        input[type="text"], input[type="file"] {
            background: #334155;
            border: 1px solid #475569;
            color: #e2e8f0;
            border-radius: 8px;
            padding: 0.75rem;
            transition: all 0.3s ease;
        }
        input[type="text"]:focus, input[type="file"]:focus {
            outline: none;
            border-color: #facc15;
            box-shadow: 0 0 10px rgba(250, 204, 21, 0.5);
        }
        input[type="submit"] {
            background: #7f1d1d;
            color: #facc15;
            border: none;
            border-radius: 8px;
            padding: 0.75rem;
            font-family: 'Cinzel', serif;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        input[type="submit"]:hover {
            background: #991b1b;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(250, 204, 21, 0.3);
        }
        label {
            color: #94a3b8;
            font-weight: 500;
            letter-spacing: 0.5px;
        }
        img {
            max-width: 100px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
        }
        img:hover {
            transform: scale(1.05);
        }
        .episode-item {
            background: #2d3748;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container mx-auto p-8 max-w-6xl">
        <h1 class="text-5xl font-bold text-center mb-4">MovieSim</h1>
        <p class="subtitle text-center mb-12 text-lg">A Cinematic Journey Through Your Movie Collection</p>

        <!-- Table Section -->
        <div class="mb-12">
            <table class="w-full border-collapse">
                <thead>
                    <tr>
                        <th class="p-4 text-left">ID</th>
                        <th class="p-4 text-left">Poster</th>
                        <th class="p-4 text-left">Title</th>
                        <th class="p-4 text-left">Description</th>
                        <th class="p-4 text-left">Episodes</th>
                        <th class="p-4 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movies as $movie)
                        <tr>
                            <td class="p-4">{{ $movie->id }}</td>
                            <td class="p-4">
                                <img src="{{ asset($movie->image) }}" alt="{{ $movie->title }}" class="w-24 h-auto">
                            </td>
                            <td class="p-4">{{ $movie->title }}</td>
                            <td class="p-4">{{ $movie->description }}</td>
                            <td class="p-4">
                                @foreach ($movie->episodes as $episode)
                                    <div class="episode-item">{{ $episode->episodes }}: {{ $episode->title }}</div>
                                @endforeach
                            </td>
                            <td class="p-4">
                                <form action="/delete-movie/{{ $movie->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete" class="w-full">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Form Sections -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Insert Movie Form -->
            <div class="form-container">
                <h3 class="text-2xl font-semibold text-center mb-6">Add New Movie</h3>
                <form enctype="multipart/form-data" action="/create-movie" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="imageInsert" class="block text-sm font-medium">Poster Image</label>
                        <input type="file" id="imageInsert" name="image" class="mt-2 block w-full">
                    </div>
                    <div>
                        <label for="titleInsert" class="block text-sm font-medium">Title</label>
                        <input type="text" id="titleInsert" name="title" placeholder="Enter movie title" class="mt-2 block w-full">
                    </div>
                    <div>
                        <label for="descInsert" class="block text-sm font-medium">Description</label>
                        <input type="text" id="descInsert" name="description" placeholder="Enter movie description" class="mt-2 block w-full">
                    </div>
                    <input type="submit" value="Add Movie" class="w-full">
                </form>
            </div>

            <!-- Insert Episode Form -->
            <div class="form-container">
                <h3 class="text-2xl font-semibold text-center mb-6">Add Episode</h3>
                <form enctype="multipart/form-data" action="/create-episode" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="movieIDInsert" class="block text-sm font-medium">Movie ID</label>
                        <input type="text" id="movieIDInsert" name="movieID" placeholder="Enter movie ID" class="mt-2 block w-full">
                    </div>
                    <div>
                        <label for="episodeInsert" class="block text-sm font-medium">Episode Number</label>
                        <input type="text" id="episodeInsert" name="episodes" placeholder="Enter episode number" class="mt-2 block w-full">
                    </div>
                    <div>
                        <label for="titleInsert" class="block text-sm font-medium">Episode Title</label>
                        <input type="text" id="titleInsert" name="title" placeholder="Enter episode title" class="mt-2 block w-full">
                    </div>
                    <input type="submit" value="Add Episode" class="w-full">
                </form>
            </div>

            <!-- Update Movie Form -->
            <div class="form-container">
                <h3 class="text-2xl font-semibold text-center mb-6">Update Movie</h3>
                <form enctype="multipart/form-data" action="/update-movie" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="idUpdate" class="block text-sm font-medium">Movie ID</label>
                        <input type="text" id="idUpdate" name="id" placeholder="Enter movie ID" class="mt-2 block w-full">
                    </div>
                    <div>
                        <label for="imageUpdate" class="block text-sm font-medium">Poster Image</label>
                        <input type="file" id="imageUpdate" name="image" class="mt-2 block w-full">
                    </div>
                    <div>
                        <label for="titleUpdate" class="block text-sm font-medium">Title</label>
                        <input type="text" id="titleUpdate" name="title" placeholder="Enter movie title" class="mt-2 block w-full">
                    </div>
                    <div>
                        <label for="descUpdate" class="block text-sm font-medium">Description</label>
                        <input type="text" id="descUpdate" name="description" placeholder="Enter movie description" class="mt-2 block w-full">
                    </div>
                    <input type="submit" value="Update Movie" class="w-full">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
