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
  
  if(xmlHttp.readyState === 4) {
    var subCatSelect=document.getElementById("subCat");

    subCatSelect.options.length = 0;

    var subCatRaw = xmlHttp.responseText;
    
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
      
      subCatSelect.options[i - 1].innerHTML = option;
    }
  }
}

function validateForm() {
    var valid = true;
    var filter =  new RegExp(/^([a-zA-Z0-9-_])/);
    var alertinfo = "";
    
    if( this.form.cat.value === "") {
        alertinfo += "Invalid Category \n";
        valid = false;
    }
    if( this.form.subCat.value === "") {
        alertinfo += "Invalid SubCategory \n";
        valid = false;
    }
    if( !filter.test(this.form.title.value )
            || this.form.title.value === "") {
        alertinfo += "Invalid Title \n";
        valid = false;
    }
    if( !filter.test(this.form.description.value )
            && this.form.description.value !== "") {
        alertinfo += "Invalid Description \n";
        valid = false;
    }

    if(valid) {
        return true;
    }else {
        alert(alertinfo);
        return false;
    }
    return true;
}
