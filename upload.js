function _(el) {
    return document.getElementById(el);
  }
  let progressbar;
  function uploadFile(fileid, fname) {

    var file = _(fileid).files[0];
    progressbar = fileid
    progressbar = `${progressbar}_status`;
    
    // alert(file.name+" | "+file.size+" | "+file.type);
    _(progressbar).style.display = "block";
    $(`#${progressbar}`).progress('reset');
    //$(`#${progressbar} .bar>.label`).text('');
    var formdata = new FormData();
    formdata.append("fileToUpload", file);
    formdata.append("fname", fname);

    var ajax = new XMLHttpRequest();
    ajax.upload.addEventListener("progress", progressHandler, false);
    ajax.addEventListener("load", completeHandler, false);
    ajax.addEventListener("error", errorHandler, false);
    ajax.addEventListener("abort", abortHandler, false);
    ajax.open("POST", "upload_parser.php"); // http://www.developphp.com/video/JavaScript/File-Upload-Progress-Bar-Meter-Tutorial-Ajax-PHP
    //use file_upload_parser.php from above url
    ajax.send(formdata);
  }
  
  function progressHandler(event) {
    
    var percent = (event.loaded / event.total) * 100;
    //console.log(percent);
    
    
    $(`#${progressbar}`).progress('increment', percent);
    
  }
  
  function completeHandler(event) {
    $(`#${progressbar}`).progress('set success');
    console.log(event.target.responseText);
    $(`#${progressbar} .bar>.label`).text(event.target.responseText);
  }
  
  function errorHandler(event) {
    $(`#${progressbar}`).progress('set error');
    $(`#${progressbar} .bar>.label`).text(event.target.responseText);
  }
  
  function abortHandler(event) {
    $(`#${progressbar}`).progress('set warning');
    $(`#${progressbar} .bar>.label`).text('Upload Cancelled');
  }

  function cancelUpload(){
    ajax.abort();
  }