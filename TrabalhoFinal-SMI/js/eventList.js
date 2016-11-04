var xmlHttp;

function GetXmlHttpObject() {
  try {
    return new ActiveXObject("Msxml2.XMLHTTP");
  } catch(e) {} // Internet Explorer
  try {
    return new ActiveXObject("Microsoft.XMLHTTP");
  } catch(e) {} // Internet Explorer
  try {
    return new XMLHttpRequest();
  } catch(e) {} // Firefox, Opera 8.0+, Safari
  alert("XMLHttpRequest not supported");
  return null;
}

function changeSubCatSelect(theCatSelect) {
  // The new option
  var selectedDistrict = theCatSelect.value;

  // Preparing the arguments to request the counties
  var args = "cat="+selectedDistrict;
  
  // With HTTP GET method
  xmlHttp = GetXmlHttpObject();
  xmlHttp.open("GET", "getSubCat.php?"+args, true);
  xmlHttp.onreadystatechange=SubCatSelectHandleReply;
  xmlHttp.send(null);
}

//Fill in the counties for the new district
function SubCatSelectHandleReply() {
  
  if(xmlHttp.readyState == 4) {
    var subCatSelect=document.getElementById("subCat");

    subCatSelect.options.length = 0;

    var subCatRaw = xmlHttp.responseText;
    
    try{
        subCatSelect.add( new Option("", ""), null);
    }
    catch(e) {
        subCatSelect.add( new Option("", "") );
    }

    subCatSelect.options[0].innerHTML = "Show All";
    
    var subCatResult = subCatRaw.split("|");

    for (i=1; i<subCatResult.length; i++) {

      var value  = subCatResult[i];
      var option = subCatResult[i];
	  
      try{
        subCatSelect.add( new Option("", value), null);
      }
      catch(e) {
        subCatSelect.add( new Option("", value) );
      }
      
      subCatSelect.options[i].innerHTML = option;
    }
  }
}


function changeSectionContent(idEvent) {

  // Preparing the arguments to request the counties
  var args = "idEvent="+idEvent;
  
  // With HTTP GET method
  xmlHttp = GetXmlHttpObject();
  xmlHttp.open("GET", "eventCommentMain.php?"+args, true);
  xmlHttp.onreadystatechange=changeSectionContenttHandleReply;
  xmlHttp.send(null);
  return false;
}

//Fill in the counties for the new district
function changeSectionContenttHandleReply() {
  
  if(xmlHttp.readyState == 4) {
    var section = document.getElementById("content");

    section.innerHTML = xmlHttp.responseText;
    
  }
}