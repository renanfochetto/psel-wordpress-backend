<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Este é um projeto para participação em processo seletivo da empresa Monks.">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/reset.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css">
    <link href="https://fonts.cdnfonts.com/css/helvetica-neue-5" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <script src="<?php echo get_template_directory_uri(); ?>/script/script.js" defer></script>
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body>
    <header class="container-header">
        <nav class="header-nav">
            <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.webp" alt="Logo da Monks"></a>
            <div class="header-menu">
                <svg class="icon menu-icon" width="19" height="12" viewBox="0 0 19 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.33325 12H17.3333C17.8833 12 18.3333 11.55 18.3333 11C18.3333 10.45 17.8833 10 17.3333 10H1.33325C0.783252 10 0.333252 10.45 0.333252 11C0.333252 11.55 0.783252 12 1.33325 12ZM1.33325 7H17.3333C17.8833 7 18.3333 6.55 18.3333 6C18.3333 5.45 17.8833 5 17.3333 5H1.33325C0.783252 5 0.333252 5.45 0.333252 6C0.333252 6.55 0.783252 7 1.33325 7ZM0.333252 1C0.333252 1.55 0.783252 2 1.33325 2H17.3333C17.8833 2 18.3333 1.55 18.3333 1C18.3333 0.45 17.8833 0 17.3333 0H1.33325C0.783252 0 0.333252 0.45 0.333252 1Z" fill="#EAE8E4"/>
                </svg>
                <svg class="icon close-icon" width="800px" height="800px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#ffffff" d="M195.2 195.2a64 64 0 0 1 90.496 0L512 421.504 738.304 195.2a64 64 0 0 1 90.496 90.496L602.496 512 828.8 738.304a64 64 0 0 1-90.496 90.496L512 602.496 285.696 828.8a64 64 0 0 1-90.496-90.496L421.504 512 195.2 285.696a64 64 0 0 1 0-90.496z"/>
                </svg>
            </div>
            <ul class="header-nav_list">
                <li><a href="#">Categoria 1</a></li>
                <li><a href="#">Categoria 2</a></li>
                <li><a href="#">Categoria 3</a></li>
                <li><a href="#">Categoria 4</a></li>
                <li><img src="<?php echo get_template_directory_uri(); ?>/assets/icons/back.svg" alt=""></li>
            </ul>
        </nav>
        <section class="header-banner">
            <div class="header-banner_content">
                <div class="banner-content">
                    <h2 class="banner-content_title">Lorem ipsum dolor sit amet consectetur</h2>
                    <p class="banner-content_text">Lorem ipsum dolor sit amet consectetur. Semper orci adipiscing faucibus sit scelerisque quis commodo aenean viverra</p>
                </div>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/scroll.webp" alt="Ícone decorativo para scroll">
            </div>
        </section>
    </header>
