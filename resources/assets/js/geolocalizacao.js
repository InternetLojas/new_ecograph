  //pegamos todos os dados atraves dos coords
  var htmlText
  var precisao ;
  var altitude ;
  var precisaoAltitude ;
  var posicaoGrau ;
  var velocidade ;
  var data;
  var hoje;
  var cookie_data;
  var lat_cookie;
  var long_cookie;

function success(position) 
{
	lat_cookie = position.coords.latitude;
	long_cookie = position.coords.longitude;
	precisao = position.coords.accuracy;
	altitude = position.coords.altitude;
	precisaoAltitude = position.coords.altitudeAccuracy;
	posicaoGrau = position.coords.heading;
	velocidade = position.coords.speed;
	data = new Date(position.timestamp);
  htmlText = 'Latidude: ' + lat_cookie + ' <br> Logintude: ' + lat_cookie  ;
  $("#localidade").append(htmlText);
	gravaCookie('latitude', lat_cookie , data);
	gravaCookie('longitude', long_cookie , data);
}

function gravaCookie(strCookie, strValor, lngDias){
  var dtmData = new Date();
  if(lngDias){
	dtmData.setTime(dtmData.getTime() + (lngDias * 24 * 60 * 60 * 1000));
	  var strExpires = "; expires=" + dtmData.toGMTString();
  }
  else{
	var strExpires = "";
  }
  document.cookie = strCookie + "=" + strValor + strExpires + "; path=/";
  //alert('passei');
}


function error(msg) 
{
  var s = document.querySelector('#status');
  s.innerHTML = typeof msg == 'string' ? msg : "failed";
  s.className = 'fail';
  console.log(arguments);
}