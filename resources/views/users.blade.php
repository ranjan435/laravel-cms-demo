<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MY CMS</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</head>
<body>
    <!-- NAVBAR -->
    {{View::make('navbar')}}
    
    <div class="container-fluid">
        <div class="row">
            <!-- SIDEBAR -->
            {{View::make('sidebar')}}

            <div class="col-md">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">All Users</h1>
                    <div class="ms-auto">
                        <h2 class="text-right"><a href="/user/add">Create User</a></h2>
                    </div>  
                    <br>
                </div>
                <div class="container mt-5">
                    <h2 class="mb-4">Users</h2>
                    <div class="mb-3 row">
                        <label for="searchTitle" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="searchTitle" placeholder="Laravel" name="name">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="searchDescription" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="searchDescription" placeholder="Laravel" name="email">
                        </div>
                    </div>
                    
                    <!-- <div class="mb-3 row">
                            <div class="col-md-4">
                                <input type="date" name="from_date" id="from_date" class="form-control" placeholder="From Date" />
                            </div>
                            <div class="col-md-4">
                                <input type="date" name="to_date" id="to_date" class="form-control" placeholder="To Date" />
                            </div>
                            <div class="col-md-4">
                                <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                                <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
                            </div>
                        </div> -->
                    <table class="table table-bordered yajra-datatable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Avatar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    

    <!-- FOOTER -->
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $(function () {
    var orderBy = "id";
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        // searching: false,
        ajax: {
            url: "{{ route('users.list') }}",
            data: function(d){
                // d.title = $('input[name=name]').val();
                // d.description = $('input[name=email]').val();
                // d.order_by = orderBy;
            }
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'type', name: 'type'},
            {data: 'avatar', name: 'avatar'},
            {
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false
            },
        ]
    });
    // $('#searchTitle').on("keyup",function(e){
    //     table.draw();
    //     e.preventDefault();
    // });
    // $('#searchDescription').on("keyup",function(e){
    //     table.draw();
    // });
    
    // $('thead').click(function(f){
    //     orderBy = f["target"]["innerHTML"].toLowerCase();
    //     if(orderBy=='start time' || orderBy=='end time'){
    //         orderBy = orderBy.replaceAll(' time','_time');
    //     }
    //     table.draw();
    // })
  });
</script>
</html>