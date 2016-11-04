function actionLogin() {
    this.form.action = "processFormLogin.php";
}

function actionRegister() {
    this.form.action = "index.php?r=1";
    this.form.onsubmit = "";
}

function validateFromLogin() {
    var valid = true;
    var filter = new RegExp(/^([a-zA-Z0-9-_]{6,})/);
    var alertinfo = "";
    
    if( !filter.test(this.form.username.value) 
            || this.form.username.value === "" ) {
        alertinfo += "Invalid Username \n";
        valid = false;
    }
    if( !filter.test(this.form.password.value 
            || this.form.username.value === "" ) ) {
        alertinfo += "Invalid Password \n";
        valid = false;
    }
    if(valid) {
        return true;
    }else {
        alert(alertinfo);
        return false;
    }
}
