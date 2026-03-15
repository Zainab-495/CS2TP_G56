<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login &ndash; Skyrose Atelier</title>
    @include('partials.head')
    <style>.hidden { display: none; }</style>
</head>
<body>
    <div class="page-wrapper">
        <div class="PageContent">
            @include('partials.nav')

            <div class="AuthPage">
                <div class="AuthCard">
                    <h1 class="AuthTitle">Login</h1>
                    <form id="login-form" class="AuthForm">
                        <label for="username">Username or Email</label>
                        <input id="username" name="username" type="text" required>
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" required>
                        <button type="submit" class="AuthButton">Login</button>
                        <p class="AuthHelp">Don't have an account? <a href="/register">Register</a></p>
                    </form>
                    <div id="error-msg" class="AuthError hidden" aria-live="polite"></div>
                </div>
            </div>
        </div>

        @include('partials.footer')
    </div>
    <script src="{{ asset('js/login.js') }}" defer></script>
</body>
</html>


