/*!
Version 
© 2018 http://imsky.co
Site:     
Issues:   
License:  
*/

var jcrop_api,
    boundx,
    boundy,
    // Grab some information about the preview pane
    $preview = $('#preview-pane'),
    $pcnt = $('#preview-pane .preview-container'),
    $pimg = $('#preview-pane .preview-container img'),

    xsize = $pcnt.width(),
    ysize = $pcnt.height();

var cropCoords,
    file,
    uploadSize = 500,
    previewSize = 500; 


$("input[type=file]").on("change", function(){      // Это событие, когда изменен элемент type=file
    file = this.files[0];                           //
    sourceFile = this.files[0];                     //*****
    readFile(file, {
        width: previewSize,
        height: previewSize
    }).done(function(imgDataUrl, origImage) {
//      $("input, img, button").toggle();
        $("#InpProfileSelect").toggle();
        $("#PreviewArea").toggle();  
        $("#PhotoSubmit").toggle();  
        $("#PhotoCancel").toggle();  
        $("#InlineLabels").toggle(); 
         
        initJCrop(imgDataUrl);
        $("#PreviewArea").attr({src: imgDataUrl});

    }).fail(function(msg) {
        alert(msg);
    });
});

//  $("button[type=submit]").on("click", function(){
    $("#PhotoSubmit").on("click", function(){       // Событие отправка формы
    $(this).text("Загрузка...").prop("disabled", true);

    readFile(file, {
        width: uploadSize,
        height: uploadSize,
        crop: cropCoords
    }).done(function(imgDataURI) {
        var data = new FormData();
        var blobFile = dataURItoBlob(imgDataURI);
        data.append('file', blobFile);                // Это имя файла уходит в запросе.

        $.ajax({
            url: "ajax/croprequest.php",
            data: data,
            cache: false,
            processData: false, 
            contentType: false,   
            type: 'POST',
            response: 'text',
            success: function(response) {
                // Если все ОК
                // alert("Success! " + " " + response);
                // $("#ProfilePhoto").attr({src: "images/ava/avamin.jpeg"});
                // window.location.href = "profile.php";    // Не всегда обновляет картинку. Нужно нажимать Ctrl+F5.
                location.reload();                          // Обновляет картинку чемно.
            },
            complete: function(){
            //    alert("Complete!");
            },
            error: function(xhr) {
                alert("Well, obviously we can't upload the file here."+
                      "This is what the data looks like: " +
                      imgDataURI.substr(0,128)+"...");
            }
        });
    });
});

//=== Preview ========================================================================================
    function updatePreview(c)
    {
      if (parseInt(c.w) > 0)
      {
        var rx = xsize / c.w;
        var ry = ysize / c.h;

        $pimg.css({
          width: Math.round(rx * boundx) + 'px',
          height: Math.round(ry * boundy) + 'px',
          marginLeft: '-' + Math.round(rx * c.x) + 'px',
          marginTop: '-' + Math.round(ry * c.y) + 'px'
        });
      }
    };
//==================================================================================================== 

//=== Additional - Show coordinates ==================================================================
// Simple event handler, called from onChange and onSelect
// event handlers, as per the Jcrop invocation above
    function showCoords(c)
    {
        $('#x1').val(c.x);
        $('#y1').val(c.y);
        $('#x2').val(c.x2);
        $('#y2').val(c.y2);
        $('#w').val(c.w);
        $('#h').val(c.h);
    };

    function clearCoords()
    {
        $('#coords input').val('');
    };

    $('#coords').on('change','input',function(e){
        var x1 = $('#x1').val(),
        x2 = $('#x2').val(),
        y1 = $('#y1').val(),
        y2 = $('#y2').val();
        jcrop_api.setSelect([x1,y1,x2,y2]);
    });
//====================================================================================================


/*****************************
show local image and init JCrop
*****************************/
var initJCrop = function(imgDataUrl){
    var img = $("#ProfilePhoto").attr("src", imgDataUrl);
    
    var storeCoords = function(c) {
        cropCoords = c;
        // Пока не получилось привязать вызов этой функции к иницилизации Jcrop
        // потому вызываю здесь, события те же, что и для ф-ции storeCoords
        updatePreview(c);     
        showCoords(c);          // Для того, чтобы выводить координаты
    };
    
    var w = img.width();
    var h = img.height();
    var s = uploadSize;

    img.Jcrop({                
        onChange: storeCoords,          // Тут важна последовательность  
//        onChange: updatePreview,
        onSelect: storeCoords,          // Сначала фмксируем координаты, потом обновляем превью.       
//        onSelect: updatePreview, 
        aspectRatio: 1,                 // Соотношение сторон
        //aspectRatio: xsize / ysize,
        //setSelect: [(w - s) / 2, (h - s) / 2, (w - s) / 2 + s, (h - s) / 2 + s]
        // setSelect: [10, 10, 50, 50]    // Начальный размер рамки выделения
        setSelect: [0, 0, 0, 0]
        },function(){
            // Use the API to get the real image size
            var bounds = this.getBounds();
            boundx = bounds[0];
            boundy = bounds[1];
            // Store the API in the jcrop_api variable
            jcrop_api = this;
            // Move the preview into the jcrop container for css positioning
            $preview.appendTo(jcrop_api.ui.holder);
        });   
};

/*****************************
Read the File Object
*****************************/
var readFile = function(file, options) {
    var dfd = new $.Deferred();
    var allowedTypes = ["image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/bmp"];
    if ($.inArray(file.type, allowedTypes) !== -1) {
        //define FileReader object
        var reader = new FileReader();
        var that = this;

        //init reader onload event handlers
        reader.onload = function(e) {
//            var image = $('<img/>')
            var image = $('#ProfilePhoto')
            .on('load', (function() {
                // when image is fully loaded
                var newimageurl = getCanvasImage(this, options);
                dfd.resolve(newimageurl, this);
            }))
            .attr('src', e.target.result);

        };
        reader.onerror = function(e) {
            dfd.reject("Couldn't read file " + file.name);
        };
        //begin reader read operation
        reader.readAsDataURL(file);
    } else {
        //some message for wrong file format
        dfd.reject("Selected file format (" + file.type + ") not supported!");
    }
    return dfd.promise();
};

/*****************************
Get New Canvas Image URL
*****************************/
var getCanvasImage = function(image, options) {
    //define canvas
    var canvas = document.createElement("canvas"),
        ratio = {
            x: 1,
            y: 1
        };
    if (options) {
        if (image.height > image.width) {
            ratio.x = image.width / image.height;
        } else {
            ratio.y = image.height / image.width;
        }
    }
    canvas.height = options.crop ? Math.min(image.height, options.height) : Math.min(image.height, Math.floor(options.height * ratio.y));
    canvas.width = options.crop ? Math.min(image.height, options.width) : Math.min(image.width, Math.floor(options.width * ratio.x));
    var ctx = canvas.getContext("2d");


/*
    getCanvasImage doesn't recieve options.crop parameter!
*/


    if (options.crop) 
    {                   //get resized width and height 
        var c = options.crop;

        if(image.width > image.height)
            var f = image.width / options.width;       // where is options.previewWidth????? ******
        else
            var f = image.height/ options.height;

        if(f < 1)
        {
            f = 1;
        }

        var t = function(a) {
            return Math.round(a * f);
        };
/*          DEBUG   */
        var sx =        t(c.x);
        var sy =        t(c.y);
        var sWidth =    t(c.w);
        var sHeight =   t(c.h);

        ctx.drawImage(image, t(c.x), t(c.y), t(c.w), t(c.h), 0, 0, canvas.width, canvas.height);
    } else {
        ctx.drawImage(image, 0, 0, image.width, image.height, 0, 0, canvas.width, canvas.height);
    }
    //convert canvas to jpeg url
    return canvas.toDataURL("image/jpeg");
};

/*****************************
convert dataURI to blob
*****************************/
var dataURItoBlob = function(dataURI) {
    var blob = window.Blob || window.WebKitBlob || window.MozBlob;

    //skip if browser doesn't support Blob object
    if (typeof blob === "undefined") {
        alert("Oops! There are some problems with your browser! <br/>New image produced from canvas can\'t be upload to the server...");
        return dataURI;
    }

    // convert base64 to raw binary data held in a string
    // doesn't handle URLEncoded DataURIs
    var byteString;
    if (dataURI.split(',')[0].indexOf("base64") >= 0) {
        byteString = atob(dataURI.split(',')[1]);
    } else {
        byteString = unescape(dataURI.split(',')[1]);
    }

    // separate out the mime component
    var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];

    // write the bytes of the string to an ArrayBuffer
    var ab = new ArrayBuffer(byteString.length);
    var ia = new Uint8Array(ab);
    for (var i = 0; i < byteString.length; i++) {
        ia[i] = byteString.charCodeAt(i);
    }
    return new blob([ab], {
        type: mimeString
    });
};


