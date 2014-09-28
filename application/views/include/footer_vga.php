

<div id="footer">
  
	 <script type="text/javascript">
	 	$(document).ready(function(){
	 		
	 		setInterval(function(){
	 			/*location.reload(true);
	 			$(".test_date").addClass('text-info');
	 			*/

	 			$.ajax({
	 				url: "trace",
	 				cache : false,
	 				success: function(html){
	 					$(".refreshme").html(html);
	 				}
	 			})

	 			}

	 			,3000);

	 		//code avec plugin Timer
	 		/*
	 		$('.refreshme').everyTime(10000,function(i){
	 			$.ajax({
	 				url: "refreshme.php",
	 				cache : false,
	 				success: function(html){
	 					$(".refreshme").html(html);
	 				}
	 			})
	 		});*/

	 	})
	 </script>
</div>
</body>

</html>
