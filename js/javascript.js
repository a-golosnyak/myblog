// Example 26-14: javascript.js

function O(i) { return typeof i == 'object' ? i : document.getElementById(i) }
function S(i) { return O(i).style                                            }
function C(i) { return document.getElementsByClassName(i)                    }


//==== Common =====================================================================================

$( document ).ready(function() {
//    alert( "ready!" );

//  $(window).scrollTop(100);


    $(document).ready(function(){
        $(".alert-primary").css({"backgroundColor" : "#BFB", "font-size" : "20px" }) ; });
});

//==== registration.php ===========================================================================
function checkUser(email)
{
    if(validateEmail(email.value) == "")    /*(email.value.length > 5)*/
    {
        params  = "email=" + email.value
        request = new ajaxRequest()
        request.open("POST", "checkuser.php", true)
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")

        request.onreadystatechange = function()
        {
            if (this.readyState == 4)
                if (this.status == 200)
                    if (this.responseText != null)
                    {
                        document.getElementById('emailOk').innerHTML = this.responseText;
                    }
        }
        request.send(params)
    }
    else
    {
        document.getElementById('emailOk').innerHTML = "<i class='fas fa-asterisk'></i> ";
    }
}

function ajaxRequest()
{
    try { var request = new XMLHttpRequest() }

    catch(e1) {
        try { request = new ActiveXObject("Msxml2.XMLHTTP") }
        catch(e2) {
            try { request = new ActiveXObject("Microsoft.XMLHTTP") }
            catch(e3) {
                request = false
            } 
        } 
    }
    return request
}

function validateEmail(field)
{
    if (field == "") 
        return "Не введен адрес электронной почты.\n"
    else if (!((field.toString().indexOf(".") > 0) &&
                (field.toString().indexOf("@") > 0)) ||
    /[^a-zA-Z0-9.@_-]/.test(field) )
        return "Электронный адрес имеет неверный формат.\n"

    return "";
}

function validatePassword(pass1, pass2) 
{
    if( ((pass1 != "") && (pass1.value.length > 2)) &&
        ((pass2 != "") && (pass2.value.length > 2)) &&
         (pass1.value == pass2.value))
    {
        document.getElementById('pass1Ok').innerHTML = "<i class='fas fa-check' style='color: rgb(50, 200, 50); font-size: 0.7rem;'> ";
        document.getElementById('pass2Ok').innerHTML = "<i class='fas fa-check' style='color: rgb(50, 200, 50); font-size: 0.7rem;'> ";
    }
    else
    {
        document.getElementById('pass1Ok').innerHTML = "<i class='fas fa-times' style='color: rgb(200, 50, 50); font-size: 0.9rem;'> ";
        document.getElementById('pass2Ok').innerHTML = "<i class='fas fa-times' style='color: rgb(200, 50, 50); font-size: 0.9rem;'> ";
    }  
}

function validateName(field)
{
    if(field.value.length < 3)
    {
        document.getElementById('nameOk').innerHTML = "<i class='fas fa-times' style='color: rgb(200, 50, 50); font-size: 0.9rem;'> ";
    }
    else
    {
        document.getElementById('nameOk').innerHTML = "<i class='fas fa-check' style='color: rgb(50, 200, 50); font-size: 0.7rem;'> ";
    }
}
//====== addpost.php ==============================================================================
function TimeToSubmitPost(category, art_title)
{  
    if(category.value=='')
    {
        document.getElementsByClassName('alert')[0].style.display = 'block';
        document.getElementById('ErrorMessage').innerHTML = "Выберите пожалуйста категорию";

        return false;
    }
    if(art_title.value == '')
    {
        document.getElementsByClassName('alert')[0].style.display = 'block';
        document.getElementById('ErrorMessage').innerHTML = "Введите пожалуйста заголовок";
        
        return false; 
    }
    document.getElementsByClassName('alert')[0].style.display = 'block';
    document.getElementsByClassName('alert')[0].className = 'alert alert-success';
    document.getElementById('ErrorMessage').innerHTML = "Пост получен";

    var data = CKEDITOR.instances.postBody.getData();               // Достаем данные из Цкедитора
        
    sendPost(category, art_title, data);                            // Отправляем все значения по Ajax.

    CKEDITOR.instances.postBody.setData("Начните вводить пост.");   // Сбрасываем все к исходному виду
    document.getElementById('art_title').value = "";
    return false;                                                   // Форму сабмитить и отправялть не нужно.    
}

//--- Ajax ------------------------------------------------------------
function sendPost(category, art_title, post)
{
    params  = "category=" + category.value;
    params  += "&art_title=" + art_title.value;
    params  += "&post-body=" + post;

    request = new ajaxRequest()
    request.open("POST", "getpost.php", true)
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")

    request.onreadystatechange = function()
    {
        if (this.readyState == 4)
            if (this.status == 200)
                if (this.responseText != null)
                {
                	document.getElementsByClassName('alert')[0].style.display = 'block';
                	document.getElementsByClassName('alert')[0].className = 'alert alert-success';
    				document.getElementById('ErrorMessage').innerHTML = this.responseText;
                }
    }
    request.send(params)
}
//=================================================================================================