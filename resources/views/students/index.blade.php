@extends('students.layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col">
                <h2>Student Create</h2>
            </div>
            <div class="col ">

                <a href="{{ route('students.create') }}" class="btn btn-primary float-end" id="BootModalShow">Add Student</a>
            </div>
        </div>
        {{-- Table --}}
        <div class="row mt-5 justify-content-center">
            <div class="col-md-10"> <!-- Added container for better alignment -->
                <table class="table table-striped table-hover">
                    <thead class="thead-dark"> <!-- Added 'thead-dark' for better header visibility -->
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>mark.otto@example.com</td>
                            <td>
                                <img src="https://via.placeholder.com/50" alt="Profile of Mark"
                                    class="img-fluid rounded-circle" style="width: 50px; height: 50px;">
                            </td>
                            <td>
                                <a href="#" class="btn btn-info" title="View Details">
                                    <i class="fa-regular fa-eye"></i>
                                </a>
                                <a href="#" class="btn btn-success" title="Edit">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                                <a href="#" class="btn btn-danger" title="Delete"
                                    onclick="return confirm('Are you sure you want to delete this record?');">
                                    <i class="fa-regular fa-trash-can"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection



@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#BootModalShow', function(e) {
                e.preventDefault();

                let ModalUrl = $(this).attr('href');
                //যদি #BootModalShow এই id টা যে খানে আছে তার this বাহহার হয়েছে। তার href
                // check করলাম alert(ModalUrl);

                // calling ajax for showing modal for create
                $.ajax({
                    type: 'GET',
                    url: ModalUrl,
                    success: function(res) {
                        let dialog = bootbox.dialog({
                            title: 'Student Create',

                            //adding modal content
                            message: "<div class='ModalContent'> </div>",

                            size: 'large',
                            
                           //**delete bootbox button use form button**
                        });
                        $('.ModalContent').html(res);
                    }
                });



            });
        });
    </script>
@endsection
