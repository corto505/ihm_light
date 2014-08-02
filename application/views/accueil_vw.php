 <?php $this->load->view('include/entete'); ?>
<div class="content" ng-controller="ctrlBtn">
<!--   MENU PRINCIPALE -->
    <div class="row" ng-show="!showActions" ng-swipe-left="showActions = true">
            <div class="col-xs-3 col-sm-4 col-md-3" ng:repeat="bouton in lesBoutonsMenu  | filter :{ actif : true }" >
                
            <div class="btn_std {{bouton.couleur}} button">
                <div class="bandeau">
                    <span> {{bouton.nom}} </span>
                </div>
                <div class="content">
                    <a href="<?php echo base_url() ;?>{{bouton.url}}" class="btn" type="button">
                        <span class="glyphicon glyphicon-2x glyphicon-{{bouton.icone}}"></span>
                    </a>
                </div>
                <div class="footer">
                     <span>{{bouton.pied}} - {{bouton.actif}} - {{bouton.type}}</span>
                </div>
            </div>
                
         </div>
        
    </div>
             <div class="bg-danger"><?php echo $erreur; ?></div>
<!-- TABLEAU DE BORD -->
     <div class="row" ng-show="showActions" ng-swipe-right="showActions = false" >

         <div class="col-xs-3 col-sm-4 col-md-3" ng:repeat="menu in lesBoutonsTdb">
                
            <div class="btn_std {{menu.couleur}} button">
                <div class="bandeau">
                    <span> {{menu.nom}}</span>
                </div>
                <div class="content">
                    <a href="<?php echo base_url() ;?>{{menu.url}}">
                        <span class="glyphicon glyphicon-2x glyphicon-{{menu.icone}}"></span>
                    </a>
                </div>
                <div class="footer">
                        <span>{{menu.pied}} - {{menu.actif}} - {{menu.type}} </span>
                </div>
            </div>
                
         </div>

    </div>

</div>
<?php $this->load->view('include/footer'); ?>
