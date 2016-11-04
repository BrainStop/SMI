var xmlHttp;

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

// The Role Select has change
function addRemCatgory(checkbox) {
    // Data that's being sent
    var add = null;
    var user  = document.getElementById('idUser').value;
    var add = checkbox.checked

    // With HTTP GET method
    xmlHttp = GetXmlHttpObject();
    xmlHttp.onreadystatechange = SelectUserHandleReply;
    xmlHttp.open("GET", "changeSubscription.php?idUser=" + user + "&add=" + add + "&idCat=" + checkbox.name, true);
    xmlHttp.send(null);
}

// Change the role

function SelectUserHandleReply() {
    if (xmlHttp.readyState === 4) {
        var response = xmlHttp.responseText;
        console.log(response);
    }
}
