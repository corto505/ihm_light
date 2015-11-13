 <?php $this->load->view('include/entete'); ?>

<div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12">
            <H4 class="btn btn-success"><?php echo $heure['jour']; ?>  <?php echo $heure['journ']; ?></h4></br>
   
            <?php foreach ($heure['horaire'] as $key => $value): ?>
             
                      <span class="btn btn-info"><?php echo $value; ?></span></br>
             
            <?php endforeach; ?>

    </div>
    
<?php $this->load->view('include/footer'); ?>

