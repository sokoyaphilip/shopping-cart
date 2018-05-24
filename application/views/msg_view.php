<?php if($this->session->flashdata('success_msg')): ?>
<div class="alert alert-success">
	<strong><?php echo $this->session->flashdata('success_msg'); unset($_SESSION['success_msg']);?></strong>
</div>
<?php endif; ?>
    
<?php if($this->session->flashdata('error_msg')): ?>
<div class="alert alert-danger">
	<strong><?php echo $this->session->flashdata('error_msg'); unset($_SESSION['error_msg']); ?></strong>
</div>
<?php endif; ?>

