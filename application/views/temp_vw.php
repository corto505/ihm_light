 <?php $this->load->view('include/entete'); ?>
<div class="content">
    <div class="row">

         <?php foreach ($lesModules as $key => $module) { 
                if ($module['Type']=='Temp'){
            ?>
        	 <div class="col-xs-12 col-md-4" >
                    
                <div class="thermo <?php echo $module['Temp']<'18' ? 'btn-blue' : 'btn-orange'; ?>">
                    <div class="bandeau">
                        <span> <?php echo $module['Name']; ?></span>
                        
                               <div class="progress">
                                <?php if ($module['BatteryLevel']!='255' ) { ?> 
                                        
                                           <div class="progress-bar <?php echo $module['BatteryLevel']<'40' ? 'progress-bar-danger' :  'progress-bar-success'; ?>" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $module['BatteryLevel']; ?>%;">
                                            <span class="sr-only"><?php echo $module['BatteryLevel']; ?> Complete</span>
                                          </div>
                                          
                                 <?php }else { ?>
                                         <div class="progress-barprogress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                                            <span class="sr-only"></span>
                                          </div>
                                          
                                  <?php } ?>
                        </div>
                    </div>
                    
                    <div class="content">
                        <div class="bouttons">
                            <span class="degre pull-right"><?php echo $module['Data']; ?></span>
                        </div>
                        <div class="image">
                            <div> <img src="<?php echo $module['Temp']<'18' ? img_url('weather/31.png') :  img_url('weather/30.png'); ?>" /></div>
                        </div>
                        
                    </div>
                    <div class="footer text-right">
                        <span ><?php echo $module['LastUpdate']; ?> </span>
                    </div>
                </div>
                    
             </div>
                
       <?php }} ?>
    </div>

</div>

<?php $this->load->view('include/footer'); ?>

   

