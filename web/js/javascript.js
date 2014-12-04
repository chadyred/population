
/*function testIE() {
    var exp = new RegExp("Microsoft");
    if (exp.test(navigator.appName)){
        alert("IE");
        document.body.innerHTML="Non compatible avec Internet Explorer";
        document.getElementsByTagName("body").innerHTML="Non compatible avec Internet Explorer";
        
    } 
}*/

        
function displayAndHide(div){
	document.getElementById(div).style.display = document.getElementById(div).style.display == "none" ? "block" : "none";
}

function display(div){
	document.getElementById(div).style.display = document.getElementById(div).style.display == "none" ? "block" : "block";
}


