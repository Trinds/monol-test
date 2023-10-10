$(document).ready(function () {
    var selectedCourseId = $("#course_id").val();

    $("#classroom_id option").hide();

    $("#classroom_id option[data-course=" + selectedCourseId + "]").show();

    $("#classroom_id option[data-course=" + selectedCourseId + "]:first").prop("selected", true);

    $("#course_id").change(function () {
        var selectedCourseId = $(this).val();

        $("#classroom_id option").hide();

        $("#classroom_id option[data-course=" + selectedCourseId + "]").show();

        $("#classroom_id option[data-course=" + selectedCourseId + "]:first").prop("selected", true);
    });
});
