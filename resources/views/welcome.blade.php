<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>LokaRaga</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Reem+Kufi&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .font-reem {
            font-family: 'Reem Kufi', sans-serif;
        }

        .bg-blue {
            background-color: #0F4BA1;
        }

        .button {
            background-color: #0F4BA1;
        }
    </style>
</head>

<body class="bg-blue flex items-center justify-center min-h-screen">
    <div class="bg-white rounded-2xl p-24 shadow-lg text-center w-full max-w-xl">
        <div class="mb-10">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="mx-auto h-24">
        </div>
        <h1 class="text-6xl font-reem text-black mb-5" style="font-weight: 950;">
            LokaRaga
        </h1>
        <p class="text-sm mb-10">
            Temukan dan pesan lapangan olahraga favoritmu dengan mudah dan cepat
        </p>
        <a href="/login" style="width: 300px; padding: 12px 40px;" class="bg-blue-700 hover:bg-blue-800 text-white font-semibold rounded-full text-lg text-center inline-block">
            Masuk
        </a>
    </div>
</body>

</html>