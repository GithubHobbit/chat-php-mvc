<link rel="stylesheet" href="/app/Views/css/login.css">
<div class="container-sm">
    <div class="row">
        <div class="login_form mx-auto mt-sm-5" >
            <h3>Вход</h3>
            <form method="POST">
                <?php 
                    if (isset($data['message'])) {
                        echo "<p>" . $data['message'] . "</p>";
                    }
                ?>
                <div class="row mb-3">
                    <div class="form-group mb-2">
                        <label for="fullname" class="form-label">Полное имя</label>
                        <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Введите имя" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="email" class="form-label">Почта</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Введите почту" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="login" class="form-label">Логин</label>
                        <input type="text" class="form-control" name="login" id="login" placeholder="Введите логин" required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Пароль</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>
        </div>
    </div>
</div>
