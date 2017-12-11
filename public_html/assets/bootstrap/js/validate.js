function validateSignupForm() {
    
    
    $(document).ready(function() {
        
        
        
    }
    var x = document.forms["login"]["username"].value;
    var y = document.forms["login"]["password"].value;
    var b = document.getElementsByName("errorField")[0];
    if (x == "" && y == "") {
        alert("You must enter a student name and a student ID");
        b.style.display = "visible";
        b.innerHTML = "You must enter a student name and a student ID";
        return false;
    }
    else if ( x == "" )
    {
        alert("You must enter the student name");
        b.style.display = "visible";
        b.innerHTML = "You must enter a student name";
        return false;
    }
    else if ( y == "" )
    {
        alert("You must enter the student ID");
        b.style.display = "visible";
        b.innerHTML = "You must enter a student ID";
        return false;
    }
}