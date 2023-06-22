<?php
    if (!$_SESSION['user']) {
        header('Location: /auth/login');
        die();
    }
?>
<form action="/user/profile/" action="GET">
    <div class="row">
        <div class="dropdown">
            <div class="dropdown-menu">
                <?php
                foreach ($data as $user) : ?>
                    <button 
                        class="dropdown-item" 
                        type="submit" 
                        name="user_id" 
                        value="<?php echo $user['id'] ?>">
                            <?php echo $user['fullname'] ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>
        <input type="text" class="form-control my-3 dropdown-toggle" placeholder="Профили"  data-bs-toggle="dropdown" aria-expanded="false">
    </div>

</form>


<script>
    
</script>