$(document).ready(function(){
    $('.ui.form').form({
        fields: {
            email: {
                identifier: 'email',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Enter your email'
                    },
                    {
                        type: 'email',
                        prompt: 'Enter a valid email'
                    }
                ]
            },
            password: {
                identifier: 'password',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Please enter a password'
                    },
                    {
                        type: 'length[6]',
                        prompt: 'Your password must have atleast 6 characters'
                    }
                ]
            }

        }
    });
    $(".ui.accordion").accordion("");
    $('.ui.dropdown').dropdown();
    $('[data-toggle="datepicker"]').datepicker();
    $('.message .close')
    .on('click', function() {
      $(this)
        .closest('.message')
        .transition('fade')
      ;
    })
  ;
  console.log("get out ye bugs");

    $('.add-course-btn').click( function(e){
        e.preventDefault();
        
        let addNewCourse =`
        <div class="ui message"> 
        <button class="circular right floated ui icon button red close-btn" id="close-c-btn">
            <i class="icon close"></i>
        </button>
            <div class="header"> Course </div>
            <div class="four fields">
                <div class="field five wide">
                    <label>Course or Subject Choice</label>
                    <input placeholder="Course" type="text" name="course_name[]" form="regForm">
                </div>
                <div class="field four wide">
                    <label>Proposed month/year of Entry</label>
                    <input placeholder="Year / Month" type="text" name="course_proposed_entry[]" form="regForm">
                </div>
                <div class="field four wide">
                    <label>Proposed point of Entry(eg. 1,2,3)</label>
                    <input placeholder="Point of Entry" type="text" name="course_proposed_point_entry[]" form="regForm">
                </div>
                <div class="field three wide">
                    <label>Level(eg. HND, BSc, PG)</label>
                    <input placeholder="Last Name" type="text" name="course_level[]" form="regForm">
                </div>
                
            </div>
        </div>`
    $('.course').append(addNewCourse);
    console.log("course has been added");
    });

    
    $(document).on('click', '#close-c-btn', function(){
        let btn_id = $(this).parent().remove();
    });




    $('.add-qualification-btn').click(function(e){
        e.preventDefault();
        let addQualification = `<div class="ui message">
        <button class="circular right floated ui icon button red close-btn" id="close-q-btn">
            <i class="icon close"></i>
        </button>
        <div class="five fields">
                <div class="field five wide">
                    <label>Name of qualification(including awarding body)</label>
                    <input placeholder="Qualifications" type="text" name="q_name[]" form="regForm">
                </div>
                <div class="field four wide">
                    <label>Name of school/college/university</label>
                    <input placeholder="School" type="text" name="q_institution[]" form="regForm">
                </div>
                <div class="field three wide">
                    <label>Duration of study</label>
                    <input placeholder="Duration" type="text" name="q_duration[]" form="regForm">
                </div>
                <div class="field two wide">
                    <label>Date obtained</label>
                    <input placeholder="Date Obtained" type="text" name="q_date[]" form="regForm">
                </div>
                <div class="field two wide">
                    <label>Result</label>
                    <input placeholder="Result" type="text" name="q_result[]" form="regForm">
                </div>
        </div>
        </div>`;
        $('.qualification').append(addQualification);
    });

    $(document).on('click', '#close-q-btn', function(){
        let btn_id = $(this).parent().remove();
    });

    $('.add-workexperience-btn').click(function(e){
        e.preventDefault();
        let addWorkExperience = `<div class="ui message">
        <button class="circular right floated ui icon button red close-btn" id="close-e-btn">
        <i class="icon close"></i>
    </button>
        <div class="five fields">
                <div class="field four wide">
                        <label>Name of employer/training body</label>
                        <input placeholder="Employer" type="text" name="e_name[]" form="regForm">
                    </div>
                    <div class="field four wide">
                    <label>Job title & nature of work</label>
                    <input placeholder="Date Obtained" type="text" name="e_job_title[]" form="regForm">
                </div>
                <div class="field two wide">
                    <label>From</label>
                    <input placeholder="From" type="text" name="e_from[]" form="regForm">
                </div>
                <div class="field two wide">
                    <label>To</label>
                    <input placeholder="To" type="text" name="e_to[]" form="regForm">
                </div>
                <div class="field three wide">
                        <label>Full / Part Time</label>
                        <div class="ui selection dropdown">
                            <input type="hidden" name="e_job-type[]" form="regForm">
                            <i class="dropdown icon"></i>
                            <div class="default text">Full Time</div>
                            <div class="menu">
                                <div class="item" data-value="3">Full Time</div>
                                <div class="item" data-value="2">Part Time</div>
                            </div>
                        </div>
                        </div>
        </div>
        </div>`;
        $('.work-experience').append(addWorkExperience);
    });

    $(document).on('click', '#close-e-btn', function(){
        let btn_id = $(this).parent().remove();
    });
    

    // $('#sponsordetail1').on('click', function(){
    //     $('#sponsordetailcontainer').css('display', 'none');
    // });

    // $('#sponsordetail2').on('click', function(){
    //     $('#sponsordetailcontainer').css('display', 'inline');
    // });


    // function checksponsor(){
    //     if(document.getElementById('sponsordetail1').checked) {
    //       //Male radio button is checked
    //       let elem = document.getElementById('sponsordetailcontainer');
    //       elem.parentNode.removeChild(elem);
    //     }else if(document.getElementById('sponsordetail2').checked) {
    //       //Female radio button is checked
    //       let parent = document.getElementById('append-sponsor');
    //       let newChild = '<div class="field" id="sponsordetailcontainer"><label>Please give details</label><input type="text" placeholder="Sponsor detail" name="sponsordetail" form="regForm"></div>'
    //       parent.insertAdjacentHTML('beforeend', newChild);

    //     }
    //   }


    $(".g").on("click", function(e){
        e.preventDefault();
    });

});