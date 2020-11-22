<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">


    <style>
        body {
            font-family: 'Nunito';
        }
    </style>
</head>
<body class="antialiased">
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="flex justify-center p-4 {{isset($hiscore) ? 'mt-16' : ''}}">
                <form action="/" method="post" class="border rounded p-5 border-gray-400 bg-gray-300">
                    @csrf
                    <label class="mr-1" for="username">Username :</label>
                    <input class="p-2" type="text" name="username" placeholder="Username">
                    <button class="bg-indigo-400 text-white rounded p-2" type="submit">Submit</button>
                    @if ($errors->any())
                        <div class="text-sm text-red-800 mt-4 flex justify-center pb-0">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>
            </div>
        </div>
        @isset($username, $hiscore)
            <div class="row flex justify-center text-center p-4 mt-2">
                <div class="border rounded p-5 border-gray-400 bg-gray-300">
                    <div class="row">
                        {{$username}}
                    </div>
                    <div class="row flex">
                        <table>
                            <th>
                            <td>Skill</td>
                            <td>Level</td>
                            <td>XP</td>
                            @foreach($hiscore as $score)
                                <tr>
                                    <td><img height="16" width="16" src="{{$score['Icon']}}" alt="{{$score['Name']}}">
                                    </td>
                                    <td>{{$score['Name']}}</td>
                                    <td>{{$score['Level']}}</td>
                                    <td>{{$score['XP']}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        @endisset
    </div>
</body>
</html>
