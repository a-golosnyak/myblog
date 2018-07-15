/*!
Version 
© 2018 http://imsky.co
Site:     
Issues:   
License:  
*/

$( document ).ready(function() {
//    alert( "ready!" );

	$(window).scrollTop(100);


	$(document).ready(function(){
	    $(".alert-primary").css({"backgroundColor" : "#BFB", "font-size" : "20px" }) ; });

});


var cropCoords,
    file,
    uploadSize = 360,
    previewSize = 350;

$("input[type=file]").on("change", function(){
    file = this.files[0];
    readFile(file, {
        width: previewSize,
        height: previewSize
    }).done(function(imgDataUrl, origImage) {
        $("input, img, button").toggle();
        initJCrop(imgDataUrl);
    }).fail(function(msg) {
        alert(msg);
    });
});

$("button[type=submit]").on("click", function(){
    $(this).text("Uploading...").prop("disabled", true);

    readFile(file, {
        width: uploadSize,
        height: uploadSize,
        crop: cropCoords
    }).done(function(imgDataURI) {
        var data = new FormData();
        var blobFile = dataURItoBlob(imgDataURI);
        data.append('file', blobFile);
        
        $.ajax({
            url: "profile.php",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function() {
                alert("Yay!");
            },
            error: function(xhr) {
                alert("Well, obviously we can't upload the file here."+
                      "This is what the data looks like: " +
                      imgDataURI.substr(0,128)+"...");
            }
        });
    });
});

/*****************************
show local image and init JCrop
*****************************/
var initJCrop = function(imgDataUrl){
    var img = $("img.crop").attr("src", imgDataUrl);
    
    var storeCoords = function(c) {
        cropCoords = c;
    };
    
    var w = img.width();
    var h = img.height();
    var s = uploadSize;
    img.Jcrop({
        onChange: storeCoords,
        onSelect: storeCoords,
        aspectRatio: 1,
        setSelect: [(w - s) / 2, (h - s) / 2, (w - s) / 2 + s, (h - s) / 2 + s]
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
            var image = $('<img/>')
                .on('load', (function() {
                    //when image is fully loaded
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

    if (options.crop) {
        //get resized width and height
        var c = options.crop;
        var f = image.width / options.previewWidth;
        var t = function(a) {
            return Math.round(a * f);
        };
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