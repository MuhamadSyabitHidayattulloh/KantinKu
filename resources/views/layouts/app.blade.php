<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Kantinku</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9f7',
                            100: '#d4f0ec',
                            200: '#a8e0da',
                            300: '#7dd1c7',
                            400: '#51c1b5',
                            500: '#26b2a2',
                            600: '#1f8b82',
                            700: '#176450',
                            800: '#0f3d2e',
                            900: '#082420',
                        },
                        accent: {
                            50: '#fffbf0',
                            100: '#fff0d6',
                            200: '#ffe1ac',
                            300: '#ffd283',
                            400: '#ffc359',
                            500: '#ffb430',
                            600: '#ea8d12',
                            700: '#d47d0e',
                            800: '#a85f0a',
                            900: '#7c4607',
                        }
                    },
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                        inter: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    @yield('extra-css')
</head>
<body class="bg-gray-50">
    @yield('content')
    @yield('extra-js')
</body>
</html>
