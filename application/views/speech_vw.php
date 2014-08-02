 <?php $this->load->view('include/entete_speech'); ?>

<div class="content">
     <div class="row">
        <div class="col-xs-12 text-center">
           
            <input type="hidden" name="monOrdre" x-webkit-speech/>

            <button class="btn btn-success btn-lg" id="btnParler"> Cliquez ICI pour parler </button>
 <h4 class="alert alert-info" id="monOrdre"></h4> 
          <h2 id="result"></h2> 
        </div>
        

      </div>

  </div>

<?php $this->load->view('include/footer'); ?>

