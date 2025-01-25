<?php
$this->title = 'Login';
?>
<h1>login</h1>

<br>

<div class="cards m-5" >
    <form action="" method="post">
        <div class="form-group">
            <label >Email</label>
            <input type="email" class="form-control" value="<?php echo $user->email?>" name="email">
        </div>
        <br>
        <div class="form-group">
            <label >password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <br>
        <div class="form-group my-2">
            <button type="submit" class="btn btn-primary">login</button>
        </div>
    </form>
</div>