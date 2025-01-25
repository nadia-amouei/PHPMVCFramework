<?php
$this->title = 'Contact';
?>
<h1>contact</h1>

<br>

<div class="cards m-5" >
    <form action="" method="post">
        <div class="form-group">
            <label >Subject</label>
            <input type="text" class="form-control" name="subject">
        </div>
        <div class="form-group">
            <label >Email</label>
            <input type="email" class="form-control" name="email">
        </div>
        <div class="form-group">
            <label >body</label>
            <textarea class="form-control" name="body"></textarea>
        </div>
        <div class="form-group my-2">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>