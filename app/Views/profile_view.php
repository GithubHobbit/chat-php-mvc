<form action="/chat/getAllChatData">
    <div class="row">
        <h2 class="col-auto mx-auto mt-2 mb-3">Профиль</h2>
    </div>
    <div class="row mb-3">
        <img src="/app/assets/images/default_avatar.png" class="col-auto mx-auto avatar" alt="">
    </div>
    <div class="row">
        <div class="col-sm-9 mx-auto mb-3">
            <div class="row mb-2">
                <div class="col border-bottom">
                    <div class="name">Полное имя:</div>
                </div>
                <div class="col border-bottom">
                    <div class=""><?php echo $data['fullname'] ?></div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col border-bottom">
                    <div class="name">Логин:</div>
                </div>
                <div class="col border-bottom">
                    <div class=""><?php echo $data['login'] ?></div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col border-bottom">
                    <div class="name">Почта:</div>
                </div>
                <div class="col border-bottom">
                    <div class=""><?php echo $data['email'] ?></div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" name="user_id" value="<?php echo $data['id'] ?>">
    <div class="row mx-2">
        <button class="btn btn-primary mx-auto col-sm-6" type="submit">Написать сообщение</button>
    </div>
</form>

<style>
    .avatar {
        max-width: 150px;
        max-height: 150px;
    }
</style>