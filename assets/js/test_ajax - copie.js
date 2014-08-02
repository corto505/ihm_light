
// Recuperation tableau php Json en ajax 
$('[id^=tab_]').click(function () {
        var immo=$(this).attr('title');
        var annee = 2012;
        var sortie = 'html';
    $.ajax({
      type: "POST",
      url:  '../index.php/appt_ajax/get_compte_par_mois/',//+immo+'/'+annee+'/'+sortie,
      async: false,
      
      data: {immo: immo, annee: annee , sortie: sortie},
      dataType: "html",
      success: function(data) {
        $('#result_table').html(data);
      }
    })
});


// *** TEST   **** - Recuperation tableau php Json en ajax 
$('#test').click(function () {
        var immo=0;
        var annee = 2012;
        var sortie = 'html';
    $.ajax({
      type: "POST",
      url:  '../index.php/appt_ajax/get_compte_par_mois/',//+immo+'/'+annee+'/'+sortie,
      async: false,
      
      data: {immo: immo, annee: annee , sortie: sortie},
      dataType: "html",
      success: function(data) {
        $('#result_table').html(data);
      }
    })
});


// Affiche d'un graphe google avec Ajax
google.load('visualization', '1', {'packages':['corechart']});
google.load('visualization', '1', {packages:['gauge']});
// Set a callback to run when the Google Visualization API is loaded.
    //#test_json

$("[id^=graph_]").click(function(){
        
  
      var jsonData = $.ajax({
          url: "../index.php/appt_ajax/getdata_json",
          dataType:"json",
          async: false
          }).responseText;
          
          
         var obj = jQuery.parseJSON(jsonData);
         console.log(obj.colonne[0][0]);
        
        // Create our data table out of JSON data loaded from server.
        var data = new google.visualization.DataTable();
        data.addColumn(obj.colonne[0][0],obj.colonne[0][1]);
        data.addColumn(obj.colonne[1][0],obj.colonne[1][1]);
        data.addRows(obj.ligne);
        
        var options = {
          width: 400, height: 120,
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };
        
         // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.Gauge(document.getElementById('chart_div_2'));
        chart.draw(data, options);

       //************************************

         var jsonDataBar = $.ajax({
          url: "../index.php/appt_ajax/getdata_json",
          dataType:"json",
          async: false
          }).responseText;
          
         var objbar = jQuery.parseJSON(jsonDataBar);
         console.log(objbar.colonne[0][0]);
        
        // Create our data table out of JSON data loaded from server.
        var databar = new google.visualization.DataTable();
        databar.addColumn(objbar.colonne[0][0],objbar.colonne[0][1]);
        databar.addColumn(objbar.colonne[1][0],objbar.colonne[1][1]);
        databar.addRows(objbar.ligne);
        
        var optionsbar = {
          width: 400, height: 120,
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };
        
        // Instantiate and draw our chart, passing in some options.
        var chartbar = new google.visualization.Gauge(document.getElementById('chart_div_3'));
        chartbar.draw(databar, optionsbar);
        
      
});
    

$("[id^=d]").click(function(){
   alert("khjhj"); 
});