 <?php $this->load->view('include/entete'); ?>
<div class="content" >
    <div class="row">

          <div class="col-lg-6">
                <form action="<?php echo base_url() ;?>index.php/modules/form_chercher" role="form" method="POST">
                      <div class="input-group">
                            <input type="text" class="form-control" placeholder="Entrez votre recherche..." name="la_recherche">
                            <span class="input-group-btn">
                               <button class="btn btn-default" type="submit" name="find_data">Go!</button>
                            </span>
                      </div><!-- /input-group -->
               </form>
            </div><!-- /.col-lg-6 -->

    </div>
<div class="alert <?php echo $visu; ?>" role="alert"><?php echo $laCde; ?></div>
</div>

<?php $this->load->view('include/footer'); ?>
