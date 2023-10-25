document.addEventListener("DOMContentLoaded", function () 
{
    const courseSelect = document.getElementById("course_filter");
    const classroomSelect = document.getElementById("classroom_filter");
    const testSelect = document.getElementById("test_id");
    const momentSelect = document.getElementById("moment_id");
    const submitGrades = document.getElementById("submit-grades");
    const gradesForm = document.getElementById("gradesForm");
    const testDate = document.getElementById("testDate");

    var selectedTestId;
    var selectedMomentId;
    var seledctedDate;

    clearClassrooms();    

    function clearClassrooms() 
    {
        for (const option of classroomSelect.options) 
            option.style.display = "none";        
    }
    
    function updateClassrooms() 
    {
        const selectedCourseId = courseSelect.value;
        if (selectedCourseId === "")         
            clearClassrooms();
         else 
            for (const option of classroomSelect.options) 
            {
                if (option.getAttribute('data-course') === selectedCourseId) 
            
                    option.style.display = "block";
                 else 
                    option.style.display = "none";                
            }        
    }

    courseSelect.addEventListener("change", function () 
    {
        updateClassrooms();
        classroomSelect.value = "";
    });

    testSelect.addEventListener("change", function () 
    {
        selectedTestId = testSelect.value;
    });

    momentSelect.addEventListener("change", function () 
    {
        selectedMomentId = momentSelect.value;
    });

    testDate.addEventListener("change", function () 
    {
        seledctedDate = testDate.value;
    });


    submitGrades.addEventListener("click", function() 
    {
        var data = [];

        const inputFields = document.querySelectorAll('input[name="grades"]');
        inputFields.forEach(function(input) 
            {            
                var studentIdValue = input.getAttribute("student_Id");
                var studentId = parseInt(studentIdValue, 10);
                var test_id = 1;
                var grade = input.value;
                if(!grade) grade=1;
                if(!selectedTestId)selectedTestId='1';
                if(!seledctedDate)seledctedDate=new Date();
                if(studentId)
                {
                    const studentData = 
                    {                     
                        test_id: selectedTestId,
                        student_id: studentId, 
                        moment: selectedMomentId,
                        score: grade, 
                        testDate: seledctedDate
                    };                
                    data.push(studentData);
                }


            });
        document.getElementById("grades").value = JSON.stringify(data);
        console.log(data)
        gradesForm.submit();
    });

    

    
    updateClassrooms();
});
