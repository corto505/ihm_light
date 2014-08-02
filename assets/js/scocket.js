// *********  Test de socket  ************
var socket = io.connect('http://192.168.0.70:3000');// voir egalement Layout.jade

$(document).ready( logAuChargement());
  
function logAuChargement(){
    socket.emit('login',{name : 'sarah'});
};

//Btn login de la barre de menu
$('#btnlogin').click(function (event){ // envoi client
    alert('send login');
        //socket.emit('login',{name : 'sarah'});
});
// reponse du serveur 
socket.on('replogin',function(mess){ //reponse serveur
      //alert('retour du serveur: '+mess);
});

 // reponse serveur message_client  ex : cmd X10
socket.on('repserv',function(mess){ //reponse serveur
                      
var pipo = JSON.stringify(mess);
//alert('retour du serveur');
var tmplt = $('#tmplt').html();
$('tmplt').remove();
  
$('.zlog').append(tmplt.replace('xxxxx',mess.h+':'+mess.m+'   '+mess.message+' ('+mess.user.name+')'));
 //$('#retourio').text(mess.repMessage);
});