<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Employees Records</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>
<div class="container">   
    <h2 class="mb-4  mt-5 text-center">
            Upload Employee Records
        </h2>
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <strong>{{ $message }}</strong>
            </div>
        @endif
    <form id="empForm" name="empForm" class="form-horizontal">
         @foreach ($employee as $emp)
        <input type="hidden" name="empid" id="empid" value="{{ $emp->id }}">
        <div class="row">
        <div class="form-group col-sm-6">
            <label for="name" class="control-label">Name</label>
            <div class="">
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ $emp->name }}" maxlength="50" required="">
            </div>
        </div>       
        <div class="form-group col-sm-6">
            <label for="name" class="control-label">Job Title</label>
            <div class="">
                <input type="text" class="form-control" id="job_title" name="job_title" placeholder="Enter Job Title" value="{{ $emp->job_title}}" maxlength="50" required="">
            </div>
        </div> 
        </div>
        <div class="row">
        <div class="form-group col-sm-6">
            <label for="name" class="control-label">Department</label>
            <div class="">
                <input type="text" class="form-control" id="department" name="department" placeholder="Enter Department" value="{{ $emp->department }}" maxlength="50" required="">
            </div>
        </div> 
        <div class="form-group col-sm-6">
            <label for="name" class="control-label">Business Unit</label>
            <div class="">
                <input type="text" class="form-control" id="business_unit" name="business_unit" placeholder="Business Unit" value="{{ $emp->business_unit }}" maxlength="50" required="">
            </div>
        </div> 
        </div>
        <div class="row">
        <div class="form-group col-sm-6">
            <label for="name" class="control-label">Gender</label>
            <div class="">
                <input type="text" class="form-control" id="gender" name="gender" placeholder="Enter Gender" value="{{ $emp->gender }}" maxlength="50" required="">
            </div>
        </div> 
        <div class="form-group col-sm-6">
            <label for="name" class="control-label">Age</label>
            <div class="">
                <input type="text" class="form-control" id="age" name="age" placeholder="Enter Age" value="{{ $emp->age }}" maxlength="50" required="">
            </div>
        </div> 
        </div>
        <div class="row">
        <div class="form-group col-sm-6">
            <label for="name" class="control-label">Joining Date</label>
            <div class="">
                <input type="text" class="form-control" id="joining_date" name="joining_date" placeholder="Joining Date" value="{{ $emp->joining_date }}" maxlength="50" required="">
            </div>
        </div> 
        <div class="form-group col-sm-6">
            <label for="name" class="control-label">Annual Salary</label>
            <div class="">
                <input type="text" class="form-control" id="annual_salary" name="annual_salary" placeholder="Annual Salary" value="{{ $emp->annual_salary }}" maxlength="50" required="">
            </div>
        </div>
        </div> 
        <div class="row">
        <div class="form-group col-sm-6">
            <label for="name" class="control-label">Country</label>
            <div class="">
                <input type="text" class="form-control" id="country" name="country" placeholder="Country" value="{{ $emp->country }}" maxlength="50" required="">
            </div>
        </div> 
         <div class="form-group col-sm-6">
            <label for="name" class="control-label">City</label>
            <div class="">
                <input type="text" class="form-control" id="city" name="city" placeholder="City" value="{{ $emp->city }}" maxlength="50" required="">
            </div>
        </div> 
        </div>
           @endforeach      
        <div class="col-sm-offset-2">
            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes</button>
        </div>
    </form>
           
</div>
<script type="text/javascript">
$(document).ready(function() {
    // Update Data

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        

        $('#empForm').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{ route('emp.edit') }}",
                data: $('#empForm').serialize(),
                success: function (response) {
                    if($.isEmptyObject(response.error)){
                    alert(response.success);
                    location.replace('/employees');
                }else{
                     alert(response.error);
                     location.reload();
                }
                    
                },
                error:function(error){
                    console.log(error);
                }
            });
        });
       
    
});
</script>
</body>
</html>