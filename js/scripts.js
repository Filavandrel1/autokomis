var numer = 0;
var timer1 = 0;
var timer2 = 0;
function znikanie(){
  $("#container_bi").fadeOut(1000);
}

function zmiana(){
  numer++;
  if(numer>5) numer=1;
  document.getElementById("container_bi").style.backgroundImage = "url('img/slajd"+numer+".png')";
  $("#container_bi").fadeIn(1000);
  timer2 = setTimeout("znikanie()",4000);
  timer1 = setTimeout("zmiana()", 5000);   
}

