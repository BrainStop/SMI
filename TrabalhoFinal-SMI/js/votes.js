/* global response */

var xmlHttp;
var wsdl = "http://localhost:8084/WebVoteManager/VoteManagerWS?wsdl";

function GetXmlHttpObject() {
    try {
        return new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
    } // Internet Explorer
    try {
        return new ActiveXObject("Microsoft.XMLHTTP");
    } catch (e) {
    } // Internet Explorer
    try {
        return new XMLHttpRequest();
    } catch (e) {
    } // Firefox, Opera 8.0+, Safari
    alert("XMLHttpRequest not supported");
    return null;
}

function upVoteComment(button) {
    var args = button.value + "&method=upVoteComment&wsdl=" + wsdl;

    // With HTTP GET method
    xmlHttp = GetXmlHttpObject();
    xmlHttp.open("GET", "webServerRequestHandler.php?" + args, true);
    xmlHttp.onreadystatechange = HandleReply;
    xmlHttp.send(null);
}

function downVoteComment(button) {
    var args = button.value + "&method=downVoteComment&wsdl=" + wsdl;
    
    // With HTTP GET method
    xmlHttp = GetXmlHttpObject();
    xmlHttp.open("GET", "webServerRequestHandler.php?" + args, true);
    xmlHttp.onreadystatechange = HandleReply;
    xmlHttp.send(null);
}

function upVoteEvent(button) {

    var args = button.value + "&method=upVoteEvent&wsdl=" + wsdl;
    
    console.log("webServerRequestHandler.php?" + args);

    // With HTTP GET method
    xmlHttp = GetXmlHttpObject();
    xmlHttp.open("GET", "webServerRequestHandler.php?" + args, true);
    xmlHttp.onreadystatechange = HandleReply;
    xmlHttp.send(null);
}

function downVoteEvent(button) {

    var args = button.value + "&method=downVoteEvent&wsdl=" + wsdl;
    
    console.log("webServerRequestHandler.php?" + args);

    // With HTTP GET method
    xmlHttp = GetXmlHttpObject();
    xmlHttp.open("GET", "webServerRequestHandler.php?" + args, true);
    xmlHttp.onreadystatechange = HandleReply;
    xmlHttp.send(null);
}

function HandleReply() {

    if (xmlHttp.readyState === 4) {

        var rawRspns = xmlHttp.responseText;
        
        spltRspn = rawRspns.split("|");
        
        var id = spltRspn[1]+"|"+spltRspn[2];
        
        console.log(rawRspns);
        console.log(id);
        
        document.getElementById(id).innerHTML = spltRspn[0];

    }
}

