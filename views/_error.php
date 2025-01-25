<?php
/** @var $exception \Exception
 */

$this->title = 'error';
?>
<h3>
<?php  echo $exception->getCode() .' - ' . $exception->getMessage() ?>
</h3>