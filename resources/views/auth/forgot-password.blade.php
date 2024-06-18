<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="font-sans antialiased bg-cover bg-no-repeat" style="background-image: url('{{ asset('assets/img/bghome.png') }}'); ">
<div class="min-h-screen flex" >
    <div class="w-1/2 bg-gradient-to-r from-light-violet to-transparent  flex ">
        <div class="flex my-auto ml-7 max-w-md p-16 space-y-6 bg-box-violet rounded-lg">
            <div class="my-auto">
                <h2 class="text-center text-3xl font-extrabold text-white">
                    Forgot password
                </h2>

                @if (session('status'))
                    <div class="bg-green-500 text-white p-4 rounded mb-4">
                        {{ session('status') }}
                    </div>
                @endif
                @error('email')
                <div class="bg-red-500 text-white p-4 rounded mb-4">
                <strong>{{ $message }}</strong>
                </div>
                @enderror
                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <div class="rounded-md shadow-sm -space-y-px">
                        <div>
                            <label for="email" class="sr-only">Email</label>
                            <input id="email" name="email" type="email" autocomplete="current-password" required
                                   class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                   placeholder="Email">

                        </div>
                    </div>


                    <div>
                        <button type="submit"
                                class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                           Reset password
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>
</body>
</html>
