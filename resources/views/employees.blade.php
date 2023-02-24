<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Employees Records</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
<div class="container">
      <h1 class="mb-4 mt-5 text-center" >List of Employees</h1>
      <div class="col-md-12 text-right mb-5">
                    <a class="btn btn-success" href="{{ route('excel-upload') }}">Upload Employee Records</a>
     </div>
    <div class="row">      
        <div class="col-12 table-responsive">
            <table class="table table-bordered emp_datatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Job title</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
  $(function () {
    var table = $('.emp_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('emp.index') }}",
        columns: [
            {data: 'emp_id', name: 'emp_id'},
            {data: 'name', name: 'name'},
            {data: 'job_title', name: 'job_title'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });
  function deleteItem(id){
     $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });            
            $.ajax({
                type: "DELETE",
                url: "{{ route('emp.destroy') }}",
                data: {id: id},
                success: function (response) {                    
                    alert(response.success);
                    location.replace('/employees');                
                },
                error:function(error){
                    console.log(error);
                }
            });
       
  }
  
</script>
</html>