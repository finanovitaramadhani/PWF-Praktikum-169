<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pertemuan 1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #000;
            font-family: Arial, Helvetica, sans-serif;
        }

        .card {
            background: #111;
            padding: 50px 80px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(255,255,255,0.1);
            color: white;
            text-align: left;
            width: 500px;
        }

        .card h1 {
            margin: 0;
            font-size: 22px;
            font-weight: normal;
        }

        .card p {
            margin: 10px 0 20px;
            color: #ccc;
        }

        .card button {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            background: #ddd;
            cursor: pointer;
        }

        .card button:hover {
            background: #bbb;
        }
    </style>
</head>
<body>

<div class="card">
    <h1>Fina Novita Ramadhani</h1>
    <p>20230140169</p>
    <div style="margin-top:15px;">
        @auth
            <a href="{{ route('dashboard') }}">
                <button>Modul Pertemuan 1</button>
            </a>
        @else
            <a href="{{ route('login') }}">
                <button>Login</button>
            </a>

            <a href="{{ route('register') }}">
                <button>Register</button>
            </a>
        @endauth
</div>

</body>
</html>