$(document).ready(function() {

	var $btn = $('#btnParler');
	var $result = $('#result');
	var $lesCdes = ["ninja","niak","allume le bureau","éteins le bureau",
	"active chauffage bureau","arrêt chauffage bureau",
	"allume la cheminée","éteins la cheminée"];

	if('webkitSpeechRecognition' in window){


		var recognition = new webkitSpeechRecognition();
		recognition.lang='fr-FR';
		recognition.continuous = false;
		recognition.interimResults = false;

		$btn.click(function(e){
			//alert('dfdfdf');
			e.preventDefault();
			recognition.start();

		});

		var idx=11;
		var cde = "On";

		recognition.onresult = function(event){
			//console.log(event);	
			for(var i = event.resultIndex; i < event.results.length ; i++){
			 	var transcript = event.results[i][0].transcript;
			 	$('#monOrdre').text(transcript);	

			 	// cde
			 	var $rang = $lesCdes.indexOf(transcript);
			 	
			 	switch (transcript) {

			 		case "ninja" : //allume le bureau":
			 			idx=11;
			 			cde="On";
			 			break;

			 		case "niak":  //éteins le bureau":
			 			idx=11;
			 			cde="Off";
			 			break;
			 			
			 		case "allume la cheminée":
			 			idx=44;
			 			cde="On";
			 			break;

			 		case "éteins la cheminée":
			 			idx=44;
			 			cde="Off";
			 			break;
			 	}

			 	if($rang !=-1){
			 			
			 			send_cde(idx,cde);
			 	}else{
			 		$('#result').text("commande inconnue").removeClass("alert-success").addClass("alert alert-danger");
			 	}
				

			 }
			 recognition.stop();
		}

	}else{

		$btn.hide();
	}

});

function send_cde(idx,cde){
	var ip_serveur = "http://192.168.0.70/";
	 	  $.ajax({
		          type: "GET",
		              url: ip_serveur+"ihm/index.php/modules/send_cde/"+idx+"/"+cde,
		          error:function(msg){
		           alert( "Error !: " + msg );
		          },
		          success:function(data){
		              //affiche le contenu du fichier dans le conteneur dédié
		              $('#result').text("Commande exécutée").removeClass("alert-danger").addClass("alert alert-success");
		            //  socket.emit('messclient',{message : 'app = '+name+' -> '+typebtn}); // on envoi un mess au serveur IO
		          }
		        });

};