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
function SelectRoleChange(user) {
    // Data that's being sent
    var e_tr = document.getElementById(user);

    var role = (e_tr.childNodes[8]).childNodes[1].value;

    // With HTTP GET method
    xmlHttp = GetXmlHttpObject();
    xmlHttp.onreadystatechange = SelectUserHandleReply;
    xmlHttp.open("GET", "updatePermissions.php?user=" + user + "&role=" + role, true);
    xmlHttp.send(null);
}

// Change the role

function SelectUserHandleReply() {
    if (xmlHttp.readyState === 4) {

        var responseRaw = xmlHttp.responseText;
        
        var responseSplit = responseRaw.split("@");
        
        var user   = responseSplit[1];

        var tr_user = document.getElementById(user);
        
        var select = tr_user.childNodes[8].childNodes[1];
        var friendlyName = select.options[select.selectedIndex].innerHTML;

        tr_user.childNodes[7].innerHTML = friendlyName;

    }
}
