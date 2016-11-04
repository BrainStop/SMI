function validateForm() {
    var valid = true;
    var filter =  new RegExp(/^([a-zA-Z0-9-_]{6,})/);
    var filterEmail = new RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
    var alertinfo = "";
    
    if( !filter.test(this.form.username.value)
            || this.form.username.value === "" ) {
        alertinfo += "Invalid Username \n";
        valid = false;
    }
    if( !filter.test(this.form.password.value)
            || this.form.username.value === "" ) {
        alertinfo += "Invalid Password \n";
        valid = false;
    }
    if( !filterEmail.test(this.form.email.value)
            || this.form.email.value === "" ) {
        alertinfo += "Invalid Email \n";
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