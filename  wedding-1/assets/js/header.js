$(function(){
$(".nav_link a").click(function(){	
    $(this).next().slideToggle("slow"); 
    return false;
});

 $('.list  tr:even').addClass('highlight');
  $("#deleteall").click(function (){
      if ( $(this).is(':checked') ){
      $(".delete").each(function() {
      this.checked = true;
 });
 
     }
      else{
  $(".delete").each(function() {
      this.checked = false;
 });
       }
     
    });
   $(".affiche_erreur").delay(3000).fadeOut(500);
   $(".confirm_delete").click(function (){
   var value=$(this).attr('href');
   $('#oui').attr('href',value);

   $("#confirmer").css({'top' : 100, 'left' : $('body').width()/2-150});
   $("#background_confirmer").css({'width' : $('body').width(), 'height' : $('body').height()});
    $("#background_confirmer").show();
    $("#confirmer").show();
    return false;
    });

   $("#non").click(function (){
     $("#background_confirmer").hide();
     $("#confirmer").hide();
    return false;
    });
});
function go(){
	var ok=false;
	 $(".delete").each(function() {
	 	if(this.checked == true) ok=true;
	 	 });
	if(ok==false)
	{alert("Bạn phải chọn bản ghi cần xóa !");
	return false;
}
}
