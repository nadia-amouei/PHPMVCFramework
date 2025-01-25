<h1>register</h1>

<?php
$this->title = 'Register';
?>
<br>

<div class="cards m-5" >
    <form action="" method="post">
        <div class="form-group">
            <label >name</label>
            <input type="text"
                   value="<?php echo $user->name ?? ''?>"
                   class="form-control"
                   name="name"
            >
        </div>

        <div class="form-group">
            <label >Email</label>
            <input type="email"
                   class="form-control "
                   value="<?php echo $user->email ?? ''?>"
                   name="email"
            >
        </div>
        <div class="form-group">
            <label >password</label>
            <input type="password" class="form-control" name="password">
        </div>

        <div class="form-group">
            <label >confirm password</label>
            <input type="password" class="form-control" name="confirmPassword">
        </div>

        <div class="form-group my-2">
            <button type="submit" class="btn btn-primary">register</button>
        </div>
    </form>
</div>