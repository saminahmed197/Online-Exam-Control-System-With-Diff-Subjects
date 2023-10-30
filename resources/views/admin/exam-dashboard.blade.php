@extends('layout/admin-layout')

@section('space-work')
    <h2 class="mb-4">Exams</h2>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addExammodal">
    Add Exam 
    </button>

    {{-- Showing data --}}
    <br> <br>
    <table class="table table-hover table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Exam Name</th>
          <th scope="col">Subject Name</th>
          <th scope="col">Date</th>
          <th scope="col">Time</th>
          <th scope="col">Attempt</th>
          <th scope="col">Edit</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>
        @if(count($exams)>0)
          @foreach($exams as $exam)
            <tr>
              <td>{{ $exam->id }}</td>
              <td>{{ $exam->exam_name }}</td>
              {{-- $exam->function_name_inModel[0]['column_name'] --}}
              <td>{{ $exam->subjects[0]['subject'] }}</td>  
              <td>{{ $exam->date }}</td>
              <td>{{ $exam->time }} Hour</td>
              <td>{{ $exam->attempt }} </td>
              <td>
                  <button class="btn btn-info editButton" data-id="{{ $exam->id }}" data-toggle="modal" data-target="#editExammodal">Edit </button>
              </td>
              <td>
                <button class="btn btn-danger deleteButton" data-id="{{ $exam->id }}" data-toggle="modal" data-target="#deleteExammodal">Delete </button>
            </td>
            </tr>
          @endforeach
        @else
          <tr>
            <td colspan="5">
                Exams not found!
            </td>
            
          </tr>
        @endif
        
      </tbody>
    </table>

    <!-- Add Exam Modal -->
  <div class="modal fade" id="addExammodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">  
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Exam</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form id="addExam">
                  @csrf
                <div class="modal-body">
                    <label >Exam</label>
                    <input type="text" name="exam_name" placeholder="Enter Exam Name" class="w-100" required>
                    <span id="examNameError" style="color: red;"></span>
                    <br> <br>
                    <select name="subject_id" class="w-100" required>
                        <option value="">Select Subject</option>
                        @if(count($subjects)>0)
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                            @endforeach
                        @endif
                    </select>
                    <span id="subjectError" style="color: red;"></span>
                    <br> <br>
                    <input type="date" name="date" class="w-100" required min="@php echo date('Y-m-d'); @endphp">
                    <br> <br>
                    <input type="time" name="time" class="w-100" required >
                    <br> <br>
                    <input type="number" min="1" name="attempt" placeholder="Enter exam attempt time" class="w-100" required >
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </form>
        </div>

  </div>


  <!-- Edit Exam Modal -->
  <div class="modal fade" id="editExammodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">  
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Exam</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form id="editExam">
                  @csrf
                <div class="modal-body">
                  <input type="hidden" name="exam_id" id="exam_id">
                    <label >Exam</label>
                    <input type="text" name="exam_name" id="exam_name" placeholder="Enter Exam Name" class="w-100" required>
                    <span id="examNameError" style="color: red;"></span>
                    <br> <br>
                    <select name="subject_id" id="subject_id" class="w-100" required>
                        <option value="">Select Subject</option>
                        @if(count($subjects)>0)
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                            @endforeach
                        @endif
                    </select>
                    <span id="subjectError" style="color: red;"></span>
                    <br> <br>
                    <input type="date" name="date" id="date" class="w-100" required min="@php echo date('Y-m-d'); @endphp">
                    <br> <br>
                    <input type="time" name="time" id="time" class="w-100" required >
                    <br> <br>
                    <input type="number" min="1" name="attempt" id="attempt" placeholder="Enter exam attempt time" class="w-100" required >
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
        </div>
  </div>

    <!-- Delete Exam Modal -->
    <div class="modal fade" id="deleteExammodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">  
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Exam</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form id="deleteExam">
                      @csrf
                    <div class="modal-body">
                      <input type="hidden" name="exam_id" id="deleteExamId">
                        <p>Are you sure you want to delete exam?</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </form>
            </div>
      </div>

  <script>
    $(document).ready(function() {

        // add
        $("#addExam").submit(function(e) {
            var formData = $(this).serialize();
            var examNameInput = $("input[name='exam_name']");
            var subjectDropdown = $("select[name='subject_id']");
            var examName = examNameInput.val();
            var selectedSubject = subjectDropdown.val();
            var formIsValid = true; // Assume the form is valid initially
    
            if (examName.length < 3) {
                // Display an error message under the exam name input field
                $("#examNameError").text("Exam Name must be at least 3 characters.");
                examNameInput.css("border-color", "red"); // Set a red border
                examNameInput.focus(); // Set focus on the input field
                formIsValid = false; // Mark the form as invalid
            } else {
                // Clear any previous error message and reset the input styles
                $("#examNameError").text("");
                examNameInput.css("border-color", ""); // Reset border color
            }
    
            if (selectedSubject === "") {
                // Display an error message under the subject dropdown
                $("#subjectError").text("Please select a subject.");
                formIsValid = false; // Mark the form as invalid
            } else {
                // Clear the error message
                $("#subjectError").text("");
            }
    
            if (!formIsValid) {
                e.preventDefault(); // Prevent form submission if it's not valid
            }else{
              $.ajax({
                    url: "{{ route('addExam') }}",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    success: function(data) {
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
            }
        });

          //edit

          $(".editButton").click(function() {
            var id = $(this).attr('data-id');
            $("#exam_id").val(id);

            var url = '{{ route("getExamDetail", "id") }}';
            url = url.replace('id', id);
    
            $.ajax({
                    url: url,
                    type: "GET",
                  //  data: formData,
                   // dataType: "json",
                    success: function(data) {
                        if(data.success == true){
                          var exam = data.data;
                          $("#exam_name").val(exam[0].exam_name);
                          $("#subject_id").val(exam[0].subject_id);
                          $("#date").val(exam[0].date);
                          $("#time").val(exam[0].time);
                          $("#attempt").val(exam[0].attempt);
                        }else{
                            alert(data.msg);
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle AJAX errors, e.g., display a generic error message
                        console.log(xhr);
                        alert("An error occurred while processing your request.");
                    }
                });
        });

        $("#editExam").submit(function(e) {
            var formData = $(this).serialize();
            e.preventDefault();
              $.ajax({
                    url: "{{ route('updateExam') }}",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    success: function(data) {
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
        });

        // delete exam

        $(".deleteButton").click(function(){
            var id = $(this).attr('data-id');
            $("#deleteExamId").val(id);

        });

        $("#deleteExam").submit(function(e) {
            var formData = $(this).serialize();
            e.preventDefault();
              $.ajax({
                    url: "{{ route('deleteExam') }}",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    success: function(data) {
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
        });


    });
    </script>
    
@endsection