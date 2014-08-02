 <?php $this->load->view('include/entete'); ?>
<div class="content" ng-controller="ctrlRoom">
    <div class="row">
            <div class="col-xs-3 col-sm-4 col-md-3" ng:repeat="piece in lespieces" >
                
            <div class="btn_std {{piece.couleur}} button">
                <div class="bandeau">
                    <span> {{piece.name}}</span>
                </div>
                <div class="content">
                    <a href="{{piece.url}}">
                       <span class="glyphicon glyphicon-3x glyphicon-{{piece.icone}}"></span>
                    </a>
                </div>
                <div class="footer">
                   
                </div>
            </div>
                
         </div>
        
    </div>

</div>
<?php $this->load->view('include/footer'); ?>
