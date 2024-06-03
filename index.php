<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Сократить ссылку</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/index.css">
</head>
<body>
<header class="header">
    <div class="container">
        <nav class="nav">
            <a href="#" class="nav-link">igaming solution</a>
            <a href="#" class="nav-link active">games</a>
            <a href="#" class="nav-link">turn-key solution</a>
            <a href="#" class="nav-link">retail solution</a>
            <a href="#" class="nav-link">ontact us</a>
        </nav>
        <div class="header-buttons">
            <a href="#" class="header-button">sign in</a>
            <a href="#" class="header-button header-button--filled">sign in</a>
        </div>
    </div>
</header>
<main class="main">
    <div class="container">
        <form id="url-form" class="url-form">
            <div class="iconed-input">
                <div class="icon">
                    <img src="/img/person.png" alt="person">
                </div>
                <input type="url" pattern="http[s]?://.*" required="required" placeholder="ссылка">
            </div>
            <button type="submit" class="submit-btn">сократить</button>
        </form>
        <div class="link-block hidden" id="link-block">
            <div class="link-block__topborder"></div>
            <div class="link-block__content-wrapper">
                <div class="link-block__content">
                    <div class="link-block__content-logo">
                        <img src="/img/logo.png" alt="logo">
                    </div>
                    <div class="link-block__content-url">
                        https://click/hgv1
                    </div>
                    <input type="text" hidden value="" id="forCopy">
                </div>
            </div>
            <div class="link-block__buttons">
                <button class="link-block__copy" id="copyBtn">копировать</button>
            </div>
        </div>
    </div>
</main>
<script src="/js/index.js"></script>
</body>
</html>