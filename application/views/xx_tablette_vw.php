 <?php $this->load->view('include/entete'); ?>
<div class="content" ng-controller="ctrlBtn">
<!--   MENU PRINCIPALE -->
    <div class="row" ng-show="!showActions" ng-swipe-left="showActions = true">

         <?php foreach ($menu as $key => $value) {  if ($value['actif']==1 ) {?>
                
            <div class="col-xs-3 col-sm-4 col-md-3">
            
            <div class="btn_std <?php echo $value['couleur']; ?> button">
                <div class="bandeau">
                    <span> <?php echo $value['nom']; ?> </span>
                </div>
                <div class="content">
                    <a href="<?php echo $value['url']; ?>" class="btn" type="button">
                        <span class="glyphicon glyphicon-2x glyphicon-<?php echo $value['icone']; ?>"></span>
                    </a>
                </div>
                <div class="footer">
                     <span><?php echo $value['pied']; ?> - <?php echo $value['actif']; ?> - <?php echo $value['type']; ?></span>
                </div>
            </div>
                
         </div>
        <?php }} ?>
        
    </div>


    <div class="bg-danger"><?php echo $erreur; ?></div>
<!-- TABLEAU DE BORD -->
       <div class="row" ng-show="showActions" ng-swipe-right="showActions = false" >

          <?php foreach ($tdb as $key => $value) { ?>
            <div class="col-xs-3 col-sm-4 col-md-3">
                
            <div class="btn_std <?php echo $value['couleur']; ?> button">
                <div class="bandeau">
                    <span> <?php echo $value['nom']; ?> </span>
                </div>
                <div class="content">
                    <a href="<?php echo $value['url']; ?>" class="btn" type="button">
                        <span class="glyphicon glyphicon-2x glyphicon-<?php echo $value['icone']; ?>"></span>
                    </a>
                </div>
                <div class="footer">
                     <span><?php echo $value['pied']; ?> - <?php echo $value['actif']; ?> - <?php echo $value['type']; ?></span>
                </div>
            </div>
                
         </div>
        <?php } ?>

    </div>

</div>
<?php $this->load->view('include/footer'); ?>
