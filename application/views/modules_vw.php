 <?php $this->load->view('include/entete'); ?>
<div class="content" >
    <div class="row">

    	 <div class="col-xs-11" >
            <div><?php echo $ladate ; ?></div>
         <ul class="list_modules"> 
            <?php foreach ($lesModules as $key => $module) { ?>
                <li class="cadre_meteo ligneMD "> 
                    <?php if ($module['Data']=='On')
                        echo '<img class="smile" src=" '. img_url("smile.png") .'" /> ';
                    ?>
                    <div class="module_text">
                        <span> <?php echo $module['Name']; ?>  </span><br>
                         <span> Maj: <?php echo $module['LastUpdate']; ?> </span><br>
                         <span> <?php echo $module['Type']; ?> - <?php echo $module['Data']; ?></span>

                    </div>
                 </li>
           
           <?php } ?>
                
        </ul>
        </div>
    </div>

</div>

<?php $this->load->view('include/footer'); ?>
