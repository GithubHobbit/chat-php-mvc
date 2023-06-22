<nav class="navbar navbar-expand-sm bg-primary-subtle rounded-bottom">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Соц. сеть</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Переключатель навигации">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto sm-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link active" href="/chat/getAllProfiles">Диалоги</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Ссылка</a>
                </li>
            </ul>

            <ul class="navbar-nav">
            <?php if (empty($_SESSION['user'])) : ?>
                <li class="nav-item me-2"><a class="nav-link" href="/auth/login">Вход</a></li>
                <li class="nav-item me-2"><a class="nav-link" href="/auth/registration">Регистрация</a></li>
            <?php else : ?>
                <li class="nav-item dropdown">
                    <img class="header_avatar me-2" src="/app/assets/images/default_avatar.png" role="button" data-bs-toggle="dropdown" aria-expanded="false" alt="">    
                <!-- <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Список</a> -->
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/auth/my_profile">Профиль</a></li>
                        <li><a class="dropdown-item" href="/auth/logout">Выйти</a></li>
                    </ul>   
                </li>
            <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<style>
    .header_avatar {
        max-height: 40px;
    }
</style>