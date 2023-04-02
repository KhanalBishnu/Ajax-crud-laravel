@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3"></div>
            <div id="success_message"></div>

            <div class="col-lg-6">Test record</div>
            <div class="col-lg-3"> <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#test_add">Add Test</a>
            </div>
        </div>
        <hr>
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    {{-- <th>Image</th> --}}
                    <th>Price</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($tests as $test)
                    <tr>
                        <td>{{ $test->id }}</td>
                        <td>{{ $test->name }}</td>
                        <td>{{ $test->description }}</td>
                        <td>{{ $test->price }}</td>
                        <td>
                            <a href="" class="btn btn-primary">Edit</a>
                            <a href="" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>

    <!-- Modal add test -->
    <div class="modal fade" id="test_add" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Task</h4>
                </div>
                <div class="modal-body">
                    <ul class="add_error" id="add_error"></ul>
                    <div class="clo-md-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control name">
                        <small id="name_error" class="text-danger"></small>
                    </div>
                    <div class="clo-md-3">
                        <label for="description">Description</label>
                        <input type="text" name="description" class="form-control description">
                        <small id="description_error" class="text-danger"></small>
                    </div>
                    <div class="clo-md-3">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control ">
                        <small id="image" class="text-danger"></small>
                    </div>
                    <div class="clo-md-3">
                        <label for="price">Price</label>
                        <input type="number" name="price" class="form-control price">
                        <small id="price_error" class="text-danger"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="add_task">Save Test</button>
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
{{-- end test add --}}
{{-- edit_test  --}}
<div class="modal fade" id="editTestModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Task</h4>
            </div>
            <div class="modal-body">
                <ul class="update_error"></ul>
                <input type="hidden" id="edit_test_id" >
                <div class="clo-md-3">
                    <label for="name">Name</label>
                    <input type="text" id="edit_name" name="name" class="form-control name">
                </div>
                <div class="clo-md-3">
                    <label for="description">Description</label>
                    <input type="text" id="edit_description" name="description" class="form-control description">
                </div>
                <div class="clo-md-3">
                    <label for="price">Price</label>
                    <input type="number" id="edit_price" name="price" class="form-control price">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="update_test btn btn-primary" id="edit_task">Update</button>
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{--end edit_test  --}}

{{-- delete test  --}}
<div class="modal fade" id="deleteTestModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Task</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="delete_test_id" >
                <h4>Are You sure Delete this Data?</h4>
            <div class="modal-footer">
                <button type="button" class="delete_test btn btn-primary" id="edit_task">Confirm</button>
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancle</button>
            </div>
        </div>
    </div>
</div>
{{--end delete test  --}}

<script>
    $(document).ready(function() {
                // for show data
                show_test();
                function show_test(){
                    $.ajax({
                        type: "GET",
                        url: "{{route('test.view')}}",
                        dataType: "Json",
                        success: function (response) {
                            //  console.log(response.tests);
                            $('tbody').html('');
                            $.each(response.tests, function (key, item) {
                                $('tbody').append('<tr>\
                                    <td>'+item.id+'</td>\
                                    <td>'+item.name+'</td>\
                                    <td>'+item.description+'</td>\
                                    <td>'+item.price+'</td>\
                                    <td><button type="button" value="' + item.id + '" class="btn btn-primary editbtn btn-sm">Edit</button></td>\
                                    <td><button  type="button" value="'+item.id+'"  class="delet_test btn btn-danger">Delete</button> </td>\
                                </tr>');
                            });

                        }
                    });
                }
                // add data
             $('#add_task').click(function(e) {
                e.preventDefault();

                // var data = {
                //     'name': $('.name').val(),
                //     'description': $('.description').val(),
                //     'price': $('.price').val(),
                //     'image':$('#image').val(),
                // };
                // for image also
                var data = new FormData();
                    data.append('name', $('.name').val());
                    data.append('description', $('.description').val());
                    data.append('price', $('.price').val());
                    data.append('image', $('#image')[0].files[0]);
                // console.log(data);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('tesk.store') }}",
                    data: data,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // console.log(response);
                        if(response.status==400){
                            $('#add_error').html("");
                            $('#description_error').html("");
                            $('#name_error').html("");
                            $('#price_error').html("");
                            // $('#add_error').addClass('alert alert-danger');
                            $.each(response.errors, function (key, add_error) {
                                // console.log(response.errors);
                                //  $('#add_error').append('<li>'+add_error+'</li>');
                                 if(key=="name"){
                                     $('#name_error').append(add_error);
                                 }
                                 if(key=="description"){
                                    $('#description_error').append(add_error);
                                 }
                                 if(key=="price"){
                                    $('#price_error').append(add_error);
                                 }
                            });

                        }else{
                            $('success_message').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('#test_add').modal('hide');
                            $('#test_add').find('input').val("");
                            show_test();


                        }

                    },

                });
            });
            // edit task
            $(document).on('click', '.editbtn', function(e){
                e.preventDefault();
                var test_id = $(this).val();
                // alert(test_id);
                $('#editTestModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "test/edit/"+test_id,
                    dataType: "Json",
                    success: function (response) {
                        console.log(response);
                        if(response.status==400){
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-danger');
                            $('#success_message').text(response.message);
                        }
                        else{
                            $('#edit_name').val(response.test.name);
                            $('#edit_description').val(response.test.description);
                            $('#edit_price').val(response.test.price);
                            $('#edit_test_id').val(test_id);
                        }
                    }
                });
            });
            //update text
            $('.update_test').click(function (e){
                e.preventDefault();
                // alert('test');
                var test_id=$('#edit_test_id').val();
                // alert(test_id);
                var data={
                    'name':$('#edit_name').val(),
                    'description' : $('#edit_description').val(),
                    'price' : $('#edit_price').val(),
                }
                // alert(data.name);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "PUT",
                    url: "test/update/"+test_id,
                    data: data,
                    dataType: "Json",
                    success: function (response) {
                        if(response.status==400){
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-danger');
                            $('#success_message').text(response.message);
                            // show_test();
                        }else{
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('#editTestModal').modal('hide');
                            show_test();
                        }
                    }
                });
            });

            //delete text
            $(document).on('click','.delet_test',function(e){
                e.preventDefault();
                // var test_id=$('#delete_test_id').val();
                var test_id=$(this).val();
                // alert(test_id);
                $('#delete_test_id').val(test_id);
                $('#deleteTestModal').modal('show');
            });
            $('.delete_test').click(function(e){
                e.preventDefault();
                // alert("ee");
                var test_id=$('#delete_test_id').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                $.ajax({
                    type: "DELETE",
                    url: "test/delete/"+test_id,
                    dataType: "Json",
                    success: function (response) {
                        if(response.status==400){
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-danger');
                            $('#success_message').text(response.message);
                        }else{
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('#deleteTestModal').modal('hide');
                            show_test();
                        }
                    }
                });
            });
            //end delete
    });
</script>

@endsection
