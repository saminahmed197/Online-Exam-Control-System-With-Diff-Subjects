@extends('layout/admin-layout')

@section('space-work')
    <h2 class="mb-4">Questions & Answers</h2>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addQnamodal">
        Add Q&A
    </button>

    <!-- Add Exam Modal -->
    <div class="modal fade" id="addQnamodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"> Add Q & A</h5>
                    <button id="addAnswer" class="ml-5 btn btn-info">Add Answer</button>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addQna">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <label for="question">Question</label>
                                <input type="text" class="w-100" name="question" placeholder="Enter question" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span class="error" style="color:red;"></span>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="addQuestion">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var answerCount = 0;

            // Form submitting
            $("#addQna").submit(function (e) {
                e.preventDefault();
                if (answerCount < 2) {
                    $(".error").text("Please add minimum two answers.");
                    setTimeout(function () {
                        $(".error").text("");
                    }, 2000);
                }else {
                    var checkIsCorrect = false;
                    for(let i =0; i < $(".is_correct").length; i++){
                        if( $(".is_correct:eq("+i+")").prop('checked') == true){
                            checkIsCorrect =  true;
                            $(".is_correct:eq("+i+")").val( $(".is_correct:eq("+i+")").next().find('input').val());

                        }

                    }

                    if(checkIsCorrect){
                       var formData = $(this).serialize();

                       $.ajax({
                        url:"{{route('addQna')}}",
                        type:"POST",
                        data:formData,
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
                            if (data.success == true) {
                                location.reload();
                            } else {
                                alert(data.msg);
                            }
                          },
                        error: function(xhr, status, error) {
                                // Handle AJAX errors, e.g., display a generic error message
                                console.log(xhr);
                                alert("An error occurred while processing your request.");
                          }
                       });
                    }else{
                        $(".error").text("Please select any.");
                        setTimeout(function () {
                            $(".error").text("");
                        }, 2000);
                    }
                    // Form submission logic
                    // You can add your logic to submit the form here
                    // For example: $(this).submit();
                }
               
            });

            // Add answers
            $("#addAnswer").click(function () {

                if ($(".answers").length >= 6) {
                    $(".error").text("You can add maximum six answers.");
                    setTimeout(function () {
                        $(".error").text("");
                    }, 2000);
                }else{
                    var html = `
                    <div class="row mt-2 answers">
                        <input type="radio" name="is_correct" class="is_correct" required>
                        <div class="col">
                            <input type="text" class="w-100" name="answers[]" placeholder="Enter answer" required>
                        </div>
                        <button class="bt btn-danger remove-answer">Remove</button>
                    </div>
                    `;

                    $(".modal-body").append(html);
                }
                answerCount++;

                // Add click event to remove answers
                $(".remove-answer").click(function () {
                    $(this).closest(".row.answers").remove();
                    answerCount--;
                });
            });

            // Add question
            $("#addQuestion").click(function () {
                $("#addQna").submit();
            });
        });
    </script>
@endsection
