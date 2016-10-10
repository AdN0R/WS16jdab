function ikusBalioak(){
	var sAux="";
	var frm=document.getElementById("erregistro");
	for(i=0;i<frm.elements.length;i++){
		if(frm.elements[i].value!="Ezabatu" && frm.elements[i].value!="Bidali" && frm.elements[i].value!="Atzerantz"){
			sAux +="IZENA: .  " + frm.elements[i].name+". ";
			sAux +="BALIOA: " + frm.elements[i].value+"\n";
			}
	}
	alert(sAux);
}

function balioztatu(){
var elem = "";
var msg = "";
	var frm=document.getElementById("erregistro");
	for(i=0;i<frm.elements.length;i++){
		elem = frm.elements[i];
		if(elem.name=="izena" || elem.name=="abizen1" || elem.name=="abizen2"){
			var er = new RegExp("[A-Z].*");
			var posbal = elem.value;
			if(elem.value.trim()==""){
				msg += "Izen-abizenak bete.\r\n";
			}else if(!er.test(posbal)){
				msg += "Izena Abizen1 eta Abizen2 bete formatu egokian.\r\n";
			}
		}/*else if(elem.name=="Eposta"){
			var er = new RegExp("/[a-z]{3,}[0-9]{3}@ikasle\.ehu\.e(s|us)/");
			var posbal = elem.value;
			if(posbal.trim()==""){
				msg += "Eposta hutsik dago.\r\n";
			}else if(!er.test(posbal)){
				msg += "Eposta zuzena izan behar da (LDAP@ikasle.ehu.es|eus).\r\n";
			}
		}*/else if(elem.name=="Pasahitza"){
			if(elem.value.length < 6){
				msg += "Pasahitzak gutxienez 6ko luzera izan behar du.\r\n";
			}
		}else if(elem.name=="Telefonoa"){
			var er = new RegExp("[0-9]{9}");
			var posbal = elem.value;
			if(posbal.trim()==""){
				msg += "Telefonoa hutsik dago.\r\n";
			}else if(!er.test(posbal)){
				msg += "Telefono zenbakia 9 digitu izan behar ditu.\r\n";
			}
		}
	}
	if (msg==""){
		ikusBalioak();
		return true;
	}else{
		alert(msg);
		return false;
	}
}

function readURL(){
   var file = document.getElementById("getArg").files[0];
   var reader = new FileReader();
   reader.onloadend = function(){
		var img = document.getElementById('dinArgazkia');
		img.src = reader.result; 
		img.style.display = "inline";
   }
   if(file){
	  reader.readAsDataURL(file);
	}else{
	}
}

function sortuKutxa(){
	var elem = document.getElementById("espezialitatea");
	if(elem.value=="Besterik"){
		var s = document.createElement("br");
		document.getElementById("beste").appendChild(s);
		var node = document.createElement("INPUT");
		node.setAttribute("type","text");
		node.setAttribute("name","Beste Espezialitatea");
		node.setAttribute("value","Sartu espezialitate izena");
		document.getElementById("beste").appendChild(node);
		
	}else{
		var b = document.getElementById("beste");
		if(b.hasChildNodes()){
			b.removeChild(b.childNodes[1]);
			b.removeChild(b.childNodes[0]);
		}
	}					
}

function sortuArgazki(){
	var img = document.getElementById("img");
	var arg = document.getElementById("argazki");
	var node = document.createElement("img");
	node.setAttribute("src",".\\"+img.value);
	node.setAttribute("width", "250px");
	node.setAttribute("height","250px");
	arg.appendChild(node);
}