<?php $this->load->view('include/entete'); ?>
<div class="content" ng-controller="ctrlModules">
<!--   MENU PRINCIPALE -->
   <?php foreach ($btn_tdb as $key => $value) {?>
                
        <div class="col-xs-3 col-sm-4 col-md-3">
        
        <div class="btn_std <?php echo $value['couleur']; ?> button">
            <div class="bandeau">
                     <span> <?php echo $value['nom']; ?> </span>
                </div>
            <div class="content_std" >
                     <span class="glyphicon glyphicon-3x glyphicon-<?php echo $value['icone']; ?> "></span>
                    <div class="bouttons">
                        <button class="bnt btn-success btn-lg btn_appareil" type="button" typebtn="On" idbtn="<?php echo $value['idbtn']; ?>">On</button><br><br>
                        <button class="bnt btn-danger btn-lg btn_appareil" type="button" typebtn="Off" idbtn="<?php echo $value['idbtn']; ?>">Off</button>
                    </div>
                </div>
            
        </div>
            
     </div>
    <?php } ?>
        
    <div class="bg-danger"><?php echo $erreur; ?></div>
</div>

