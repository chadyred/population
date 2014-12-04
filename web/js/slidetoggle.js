function toggleElemOnce(div, effect){
	var options = {}
	if (document.getElementById(div).style.display == "none"){
		jQuery(document.getElementById(div)).toggle(effect, options, 600 );
	}
}

function toggleElem(div, effect){
	var options = {}
	jQuery(document.getElementById(div)).toggle(effect, options, 600 );
}

function slideToggleElem(div, speed){
	jQuery(document.getElementById(div)).slideToggle(speed);
}
