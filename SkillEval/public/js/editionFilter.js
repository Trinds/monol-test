document.addEventListener("DOMContentLoaded", function () 
{
    const courseSelect = document.getElementById("course_filter");
    const classroomSelect = document.getElementById("classroom_filter");
    const testSelect = document.getElementById("test_id");
    const momentSelect = document.getElementById("moment_id");
    const submitGrades = document.getElementById("submit-grades");
    const gradesForm = document.getElementById("gradesForm");
    
    var selectedTestId;
    var selectedMomentId;

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



    submitGrades.addEventListener("click", function() 
    {
        const grades = [];

        const inputFields = document.querySelectorAll('input[name="grades"]');
        inputFields.forEach(function(input) 
            {            
                const studentId = input.getAttribute("student_Id");
                const grade = input.value;
                const studentData = 
                {                     
                    studentId: studentId, 
                    testId: selectedTestId,
                    momentId: selectedMomentId,
                    grade: grade 
                };
                grades.push(studentData);
            });
        document.getElementById("grades").value = JSON.stringify(grades);
    
        gradesForm.submit();
    });
    
    updateClassrooms();
});
