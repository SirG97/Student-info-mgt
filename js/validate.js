let currentTab = 0;
document.getElementById("submit").style.display = "none";
    showTab(currentTab);

    function showTab(n){
        let x = document.getElementsByClassName("tab");
        x[n].style.display = "block";

        if(n == 0){
            document.getElementById("prevBtn").style.display = "none";
        }else{
            document.getElementById("prevBtn").style.display = "inline";
        }

        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").style.display = "none";
            document.getElementById("submit").style.display = "inline";
          } else {
            document.getElementById("nextBtn").innerHTML = "Next";
            document.getElementById("submit").style.display = "none";
          }
        fixStepIndicator(n);
    }

    function nextPrev(n){
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form... :
        if (currentTab >= x.length) {
            //...the form gets submitted:
            document.getElementById("regForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm(){
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
          // If a field is empty...
            if (y[i].value == "") {
            // add an "invalid" class to the field:
            //y[i].className += " invalid";
            // and set the current valid status to false:
            valid = true;
          }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
          document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
          x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class to the current step:
        x[n].className += " active";
    }

    

    // function uploadFile(el){
    //     let fileId = document.getElementById(el);
    //     let file = fileId.files[0];
    //     let formData = new formData();
    //     formData.append(el, file);
    //     let ajax = new XMLHttpRequest();

    //     ajax.upload.addEventListener("progressbar", progresshandler, false);
    //     ajax.addEventListener("load", completeHandler, false);
    //     ajax.addEventListener("error", errorHandler, false);
    //     ajax.addEventListener("abort", abortHandler, false);
    //     ajax.open("POST",  "file_upload_parser.php");
    // }

    // function progressHandler(event) {
    //     // _("loaded_n_total").innerHTML = "Uploaded " + event.loaded + " bytes of " + event.total;
    //     let percent = (event.loaded / event.total) * 100;
    //     _("progressBar").value = Math.round(percent);
    //     _(" event.target.responseText;
    //     _("progressBar").value = 0; //wil clear progress bar after successful upload
    //   }
      
    //   function errorHandler(event) {
    //     _("status").innerHTML = "Upload Failed";
    //   }
      
    //   function abortHandler(event) {
    //     _("status").innerHTML = "Upload Aborted";
    //   }status").innerHTML = Math.round(percent) + "% uploaded... please wait";
    //   }
      
    //   function completeHandler(event) {
    //     _("status").innerHTML =
      
      //check if sponsor radio button is checked to to whether to display sponsor detail input


  
