// Example 26-14: javascript.js

function O(i) { return typeof i == 'object' ? i : document.getElementById(i) }
function S(i) { return O(i).style                                            }
function C(i) { return document.getElementsByClassName(i)                    }


//==== Common =====================================================================================
/*
$( document ).ready(function() {
//    alert( "ready!" );

//  $(window).scrollTop(100);


    $(document).ready(function(){
        $(".alert-primary").css({"backgroundColor" : "#BFB", "font-size" : "20px" }) ; });
});*/

//==== passrecovery.php ===========================================================================

function validateRecoveryForm(form)
{
    result = checkUserFlag;

    if(result == '')
    {
        return true;    
    }
    return false;
}

// Восстановление пароля 
function checkUserRecovery(email)
{
    if(validateEmail(email.value) == "")    /*(email.value.length > 5)*/
    {
        params  = "email=" + email.value
        request = new ajaxRequest()
        request.open("POST", "ajax/checkuser.php", true)
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")

        request.onreadystatechange = function()
        {
            if (this.readyState == 4)
                if (this.status == 200)
                    if (this.responseText != null)
                    {
                        if(this.responseText == 'exists')
                        {
                            document.getElementById('emailOk').innerHTML = "<i class='fas fa-check' style='color: rgb(50, 200, 50); font-size: 0.8rem;'> ";
                            checkUserFlag = ''; 
                            return '';  
                        }
                        else
                        {        
                            document.getElementById('emailOk').innerHTML = "<i class='fas fa-times' style='color: rgb(200, 50, 50); font-size: 0.8rem;'> ";
                            checkUserFlag = 'error'; 
                            return false;
                        }
                    }
        }
        request.send(params)
    }
    else
    {
        document.getElementById('emailOk').innerHTML = "<i class='fas fa-asterisk'></i> ";
        return false;
    }
    return false;
}

//==== registration.php ===========================================================================
function validateRegFormAll(form)
{
    result = checkUserFlag;
    result += validatePassword(form.password, form.password_confirm);
    result += validateName(form.screen_name);

    if(result == '')
    {
        return true;    
    }
    return false;
}


function checkUser(email)
{
    if(validateEmail(email.value) == "")    /*(email.value.length > 5)*/
    {
        params  = "email=" + email.value
        request = new ajaxRequest()
        request.open("POST", "ajax/checkuser.php", true)
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")

        request.onreadystatechange = function()
        {
            if (this.readyState == 4)
                if (this.status == 200)
                    if (this.responseText != null)
                    {
                        if(this.responseText == 'exists')
                        {
                            document.getElementById('emailOk').innerHTML = "<i class='fas fa-times' style='color: rgb(200, 50, 50); font-size: 0.8rem;'> ";
                            checkUserFlag = 'error';
                        }
                        else
                        {
                            document.getElementById('emailOk').innerHTML = "<i class='fas fa-check' style='color: rgb(50, 200, 50); font-size: 0.8rem;'> "; 
                            checkUserFlag = '';  
                        }
                    }
        }
        request.send(params);
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
    /* Не проверяем адрес. Он проверяется браузером, 
    а нам нужна инициализация checkUserFlag = 'error'; до того, 
    как пользователь нажмет "Зарегистрироваться"    */

/*    if (field == "") 
        return "Не введен адрес электронной почты.\n"
    else if (!((field.toString().indexOf(".") > 0) &&
                (field.toString().indexOf("@") > 0)) ||
    /[^a-zA-Z0-9.@_-]/.test(field) )
        return "Электронный адрес имеет неверный формат.\n"
*/

    if (field == "") 
        return "Не введен адрес электронной почты.\n"
    else if (!((field.toString().indexOf(".") > 0) &&(field.toString().indexOf("@") > 0)) || /[^a-zA-Z0-9.@_-]/.test(field) )
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
        return '';  // means Ok
    }
    else
    {
        document.getElementById('pass1Ok').innerHTML = "<i class='fas fa-times' style='color: rgb(200, 50, 50); font-size: 0.9rem;'> ";
        document.getElementById('pass2Ok').innerHTML = "<i class='fas fa-times' style='color: rgb(200, 50, 50); font-size: 0.9rem;'> ";
        return 'error';
    }  
}

function validateName(field)
{
    if(field.value.length < 3)
    {
        document.getElementById('nameOk').innerHTML = "<i class='fas fa-times' style='color: rgb(200, 50, 50); font-size: 0.9rem;'> ";
        return 'error';
    }
    else
    {
        document.getElementById('nameOk').innerHTML = "<i class='fas fa-check' style='color: rgb(50, 200, 50); font-size: 0.7rem;'> ";
        return '';  // means Ok
    }
}
//====== addpost.php ==============================================================================
function TimeToSubmitPost(category, art_title, art_intro)
{  
    if(category.value=='')
    {
        document.getElementsByClassName('alert')[0].style.display = 'block';
        document.getElementsByClassName('alert')[0].className = 'alert alert-warning';
        document.getElementById('ErrorMessage').innerHTML = "Выберите пожалуйста категорию";

        return false;
    }
    if(art_title.value == '')
    {
        document.getElementsByClassName('alert')[0].style.display = 'block';
        document.getElementsByClassName('alert')[0].className = 'alert alert-warning';
        document.getElementById('ErrorMessage').innerHTML = "Введите пожалуйста заголовок";
        
        return false; 
    }
    if(art_intro.value == '')
    {
        document.getElementsByClassName('alert')[0].style.display = 'block';
        document.getElementsByClassName('alert')[0].className = 'alert alert-warning';
        document.getElementById('ErrorMessage').innerHTML = "Введите пожалуйста превью статьи";
        
        return false; 
    }   
/*    document.getElementsByClassName('alert')[0].style.display = 'block';
    document.getElementsByClassName('alert')[0].className = 'alert alert-success';
    document.getElementById('ErrorMessage').innerHTML = "Пост получен";
*/
    var data = CKEDITOR.instances.postBody.getData();               // Достаем данные из Цкедитора
        
    sendPost(category, art_title, art_intro, data);                 // Отправляем все значения по Ajax.

    CKEDITOR.instances.postBody.setData("Начните вводить пост.");   // Сбрасываем все к исходному виду
    document.getElementById('art_title').value = "";
    document.getElementById('art_intro').value = "";
    return false;                                                   // Форму сабмитить и отправялть не нужно.    
}

//--- Ajax ------------------------------------------------------------
//=== articles.php === delpost.php ==============================================================
function sendPost(category, art_title, art_intro, post)
{
    var data = new FormData();
    data.append('category', category.value); 
    data.append('art_title', art_title.value); 
    data.append('art_intro', art_intro.value); 
    data.append('post-body', post); 
    data.append('image', $('input[type=file]')[0].files[0]); 

/*  params  = "category=" + category.value;
    params  += "&art_title=" + art_title.value;
    params  += "&art_intro=" + art_intro.value;
    params  += "&post-body=" + post;
*/
    request = new ajaxRequest()
    request.open("POST", "ajax/getpost.php", true)
//  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")   // При использовании обьекта FormData это почему-то не нужно

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
    request.send(data)
}

function deletePost(art_id)
{
//    alert(art_id);

    var data = new FormData();
    data.append('art_id', art_id); 

    request = new ajaxRequest()
    request.open("POST", "ajax/delpost.php", true)

    request.onreadystatechange = function()
    {
        if (this.readyState == 4)
            if (this.status == 200)
                if (this.responseText != null)
                {
//                    alert(this.responseText);
                    location.reload();
                }
    }
    request.send(data); 

    return false;
}

//=== article.php === getcomment.php ==============================================================
function TimeToSendComment(art_id, parent_comment_id, comment_body)
{
    if((art_id.value=='') || (parent_comment_id.value=='') || (comment_body.value==''))
    {
    //  alert("alert!" + art_id.value +' '+ parent_comment_id.value +' '+           comment_body.value);
        document.getElementsByClassName('alert')[0].style.display = 'block';
        document.getElementsByClassName('alert')[0].className = 'alert alert-warning';
        document.getElementById('ErrorMessage').innerHTML = "Введите пожалуйста комментарий";
        return false;
    }
    if(comment_body.value < 3)
    {
        document.getElementsByClassName('alert')[0].style.display = 'block';
        document.getElementsByClassName('alert')[0].className = 'alert alert-warning';
        document.getElementById('ErrorMessage').innerHTML = "Комментарий должен быть больше трех символов";
        return false;
    }
    sendComment(art_id, parent_comment_id, comment_body);

    return false;
}

function sendComment(art_id, parent_comment_id, comment_body)
{
    var data = new FormData();
    data.append('post_id', art_id.value); 
    data.append('parent_comment_id', parent_comment_id.value); 
    data.append('comment_body', comment_body.value); 

    request = new ajaxRequest()
    request.open("POST", "ajax/getcomment.php", true)

    request.onreadystatechange = function()
    {
        if (this.readyState == 4)
            if (this.status == 200)
                if (this.responseText != null)
                {
                //    alert(this.responseText);
                    location.reload();
                }
    }
    request.send(data);
}

function deleteComment(comment_id)
{
//  alert(comment_id);
    var data = new FormData();
    data.append('comment_id', comment_id); 

    request = new ajaxRequest()
    request.open("POST", "ajax/delcomment.php", true)

    request.onreadystatechange = function()
    {
        if (this.readyState == 4)
            if (this.status == 200)
                if (this.responseText != null)
                {
                    //alert(this.responseText);
                    location.reload();
                }
    }
    request.send(data); 

    return false;
}

function editComment(comment_id)
{
  alert(comment_id + ' написать функцию редактирования комментария');
/*    var data = new FormData();
    data.append('comment_id', comment_id); 

    request = new ajaxRequest()
    request.open("POST", "ajax/delcomment.php", true)

    request.onreadystatechange = function()
    {
        if (this.readyState == 4)
            if (this.status == 200)
                if (this.responseText != null)
                {
                    //alert(this.responseText);
                    location.reload();
                }
    }
    request.send(data); 
*/
    return false;
}

//=================================================================================================