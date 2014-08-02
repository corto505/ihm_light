//::::::::::::::::  ANGULAR  ::::::::::::
var app = angular.module('domo',['ngAnimate','ngTouch']);
var ip_serveur = "http://192.168.0.70/";
var ip_nodejs1 = "http://192.168.0.70:3000/";

app.config(function($locationProvider){
  $locationProvider.html5Mode(true);
});
//-------------  LES BTN  ---------
app.controller ('ctrlBtn',function($scope,$http){
  
  $scope.method = 'GET';
  $scope.url = ip_serveur+'ihm/index.php/welcome/lirebouton/file/json';

  $scope.code = null;
  $scope.response = null;

  $http({method: $scope.method, url: $scope.url}).
      success(function(data, status) {
        console.log(status);
        
        $scope.lesBoutonsTdb = data.tdb;
        $scope.lesBoutonsMenu = data.menu;
        //console.log("Menu bnt => "+$scope.lesBoutonsMenu);
        //console.log("Tdb bnt => "+$scope.lesBoutonsTdb);
      }).
      error(function(data, status) {
        $scope.data = data || "Request failed";
        $scope.status = status;
  });

});
//-------------  LES MODULES  ---------
app.controller ('ctrlModules',function($scope,$http){
  
    $scope.method = 'GET';

    //console.log($scope.filterOptions);
    
      $scope.url = ip_serveur+'ihm/index.php/welcome/lireFileDomo/file/json';
    
      //$scope.url = 'http://192.168.0.63:8888/ihm/index.php/welcome/lireScenes/json';

    $scope.code = null;
    $scope.response = null;

    $http({method: $scope.method, url: $scope.url}).
        success(function(data, status) {
          //console.log(data.result);
          
          $scope.lesmodules = data.result;
          
      }).
      error(function(data, status) {
        $scope.data = data || "Request failed";
        $scope.status = status;
     
    });

});
//-------------  LES SCENES  ---------
app.controller ('ctrlScenes',function($scope,$http){
  
    $scope.method = 'GET';

    //console.log($scope.filterOptions);
    
    $scope.url = ip_serveur+'ihm/index.php/welcome/lireScenes/json';
    $scope.response = null;

    $http({method: $scope.method, url: $scope.url}).
        success(function(data, status) {
         console.log(data);
          
          $scope.lesscenes = data.result;
          
      }).
      error(function(data, status) {
        $scope.data = data || "Request failed";
        $scope.status = status;
     
    });

});
//-------------  LES PIECES  ---------
app.controller ('ctrlRoom',function($scope,$http){
  
  $scope.method = 'GET';
  $scope.url = ip_serveur+'ihm/index.php/welcome/lirepieces/file/json';

  $scope.code = null;
  $scope.response = null;

  $http({method: $scope.method, url: $scope.url}).
      success(function(data, status) {
       //console.log(data);
      $scope.lespieces = data;

      }).
      error(function(data, status) {
        $scope.data = data || "Request failed";
        $scope.status = status;
  });

// gestion du click
 $scope.pipo = function(code){
    console.log(' On a cliqué sur ===> '+code+" - ");
    
}

});

//-------------  LA METEO  ---------
app.controller ('ctrlMeteo',function($scope,$http){
  
  $scope.method = 'GET';
  $scope.url = ip_serveur+'ihm/index.php/welcome/lireFileMeteo/json';

  $scope.code = null;
  $scope.response = null;

  $http({method: $scope.method, url: $scope.url}).
      success(function(data, status) {
       //console.log(data);
      $scope.lameteo = data;

      }).
      error(function(data, status) {
        $scope.data = data || "Request failed";
        $scope.status = status;
  });

});


//-------------  LES STATES  ---------
app.controller ('ctrlStates',function($scope,$http){
  
  $scope.send_cde_stat=function(code){
    
     $scope.method = 'GET';
    $scope.url = ip_nodejs1+'vnstat/'+code;

    $scope.response = null;

    $http({method: $scope.method, url: $scope.url}).
      success(function(data, status) {
       console.log(data);
      $scope.lameteo = data;

      }).
      error(function(data, status) {
        $scope.data = data || "Request failed";
        $scope.status = status;
        
  });

  } 

});

/*******************************************************
*                JQUERY  - AJAX
*
*******************************************************/
//*******   Ajax : Btn ON|OFF  bouton module **********
 /**
 * Pb avec angular et Jquery => le click n' eétait pas intecepté ??
 */  
$(document).on("click", ".btn_appareil", function() { 

        var idbtn = $(this).attr('idbtn');
        var typebtn = $(this).attr('typebtn');
          //alert('id btn = '+idbtn+" type cde"+typebtn);
          
        $.ajax({
          type: "GET",
              url: ip_serveur+"ihm/index.php/modules/send_cde/"+idbtn+"/"+typebtn,
          error:function(msg){
           alert( "Error !: " + msg );
          },
          success:function(data){
              //affiche le contenu du fichier dans le conteneur dédié
              $('#retour').text(data);
            //  socket.emit('messclient',{message : 'app = '+name+' -> '+typebtn}); // on envoi un mess au serveur IO
          }
        });
});


$(document).ready(function() {

   //:::::::           EVENT CHARGEMENT                :::::::
   
      $('#tabMenu').hide();
   
     //------- CALENDRIER  ---------
   var madate = new Date();
   var nomDesJours = new Array('dimanche','lundi','mardi','mercredi','jeudi','vendredi','samedi');
   var indicejour = madate.getDay();
   var lejour = madate.getDate();
   
        
   $('#jour').html(lejour);
   $('#mois').html(nomDesJours[indicejour]);
 
 
   
     //:::::::              EVENT ON CLICK                 :::::::
     
      //-----    affiche la div Meteo  ------
   $('#testclick').click(function (){
          alert('Jquery : Test click');
    });
   

     //----    affiche la div Menu -----
    $('#btnMenu').click(function (){
          $('#tabMeteo').fadeOut('slow', function (){
                $('#tabMenu').fadeIn();
            });
    });
   
   //-----    affiche la div Meteo  ------
   $('#btnMeteo').click(function (){
          $('#tabMenu').fadeOut('slow', function (){
                $('#tabMeteo').fadeIn();
            });
    });
   
   
    //:::::::::::  Ajax  ::::::::::::
   $("#testclick2").click(function(){
      alert('click by jquery');
   });
   

});


//::::::  *********  LES TESTT  ::::::::::
