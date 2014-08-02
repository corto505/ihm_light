<?php $this->load->view('include/entete'); ?>

<div class="container">
      <div class="row entete_meteo">
            <div class="col-xs-* pull-left">
                <span id="ville"><?php echo $ville ?> </span>
            </div>
            <div class="col-xs- col-md- col-xs-offset- col-md-offset-">
                <span class="pull-right" id="mladate"><?php echo $dateDuJour ?></span>
            </div>
      </div>  

    <div class="row">
       

        <?php foreach ($meteo as $key => $tabTemps) {      //$key = date       
            $date_temp =  $key; 

            foreach ($tabTemps as $index => $value) {
 
                if ($index==0) {
        ?>
                <div class="entete_meteo">
                    <div class="">
                      <div>
                          <span class="quelJour"><strong><?php echo date('D d', strtotime($value['laDate'])); ?><strong/></span>
                          <span class="pull-right"> Bar : <?php echo $value['pressure']; ?></span>                         
                      </div><Br/>
                          <span class="pull-left glyphicon-4x" data-icon="<?php echo $value['icone']; ?>"></span> 
                          <p class="temp"><?php echo $value['temp'] ?>° </p>
                         
                          <p id="descipt" class="text-left"><?php echo $value['description'] ?></p>
                    </div></br>
                    <ul class="cadre_meteo">
            <?php } else { ?>

                    <li>
                          
                          <div class="temp_2">
                            <span class="glyphicon-3x" data-icon="<?php echo $value['icone']; ?>"></span>
                              
                              <span class="temp_detail heure"><?php echo $value['heure'] ?> <span class="temp_detail"  data-icon="'"><?php echo $value['temp'] ?>°</span></span>
                            
                             <br/>
                             mini:<span class="temp_detail"><?php echo $value['temp_min'] ?>°</span>
                            - maxi:<span class="temp_detail"><?php echo $value['temp_max'] ?>°</span>
                               - bar:<span class="temp_detail"><?php echo $value['pressure'] ?>°</span>

                          </div>
                    <div>

           <?php  } ?>

       <?php } ?>
            </ul>
            </div> <!--cadre_meteo  -->

      <?php }  ?>

    </div> <!-- row -->
         
	
</div>


 <?php $this->load->view('include/footer'); ?>