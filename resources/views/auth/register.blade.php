<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register &ndash; Skyrose Atelier</title>
    @include('partials.head')
</head>
<body>
    <div class="page-wrapper">
        <div class="PageContent">
            @include('partials.nav')

            <div class="AuthPage">
                <div class="AuthCard">
                    <h1 class="AuthTitle">Register</h1>
                    <form id="register-form" class="AuthForm">
                        <label for="r-username">Username</label>
                        <input id="r-username" name="username" type="text" required>

                        <label for="r-email">Email</label>
                        <input id="r-email" name="email" type="email" required>

                        <label for="r-fullName">Full Name (Optional)</label>
                        <input id="r-fullName" name="fullName" type="text">

                        <label for="r-password">Password</label>
                        <input id="r-password" name="password" type="password" required>

                        <button type="submit" class="AuthButton">Register</button>
                        <p class="AuthHelp">Already have an account? <a href="/login">Login</a></p>
                    </form>
                    <div id="error-msg" class="AuthError" aria-live="polite"></div>
                </div>
            </div>
        </div>

        @include('partials.footer')
    </div>
    <script src="{{ asset('js/register.js') }}" defer></script>
</body>
</html>


