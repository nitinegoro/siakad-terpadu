<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: <?php echo $severity; ?></p>
<p>Message:  <?php echo $message; ?></p>
<p>Filename: <?php echo $filepath; ?></p>
<p>Line Number: <?php echo $line; ?></p>

<?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>

	<strong>Backtrace:</strong><br>
	<?php foreach (debug_backtrace() as $error): ?>

		<?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>

			<small style="margin-left:10px"><br />
			<strong>File:</strong> <?php echo $error['file'] ?><br />
			<strong>Line:</strong> <?php echo $error['line'] ?><br />
			<strong>Function:</strong> <?php echo $error['function'] ?>
			</small>

		<?php endif ?>

	<?php endforeach ?>

<?php endif;?>

</div>