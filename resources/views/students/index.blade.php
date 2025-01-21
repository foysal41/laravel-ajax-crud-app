@extends('students.layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col">
                <h2>Student Create</h2>
            </div>
            <div class="col ">
                <button id="BootModalShow" class="btn btn-primary float-end">Add Student</button>
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
    $(document).ready(function () {
        $(document).on('click', '#BootModalShow', function (e) {
            e.preventDefault();
            let dialog = bootbox.dialog({
    title: 'A custom dialog with buttons and callbacks',
    message: "<p>This dialog has buttons. Each button has it's own callback function.</p>",
    size: 'large',
    buttons: {
        cancel: {
            label: "I'm a cancel button!",
            className: 'btn-danger',
            callback: function(){
                console.log('Custom cancel clicked');
            }
        },
        ok: {
            label: "I'm an OK button!",
            className: 'btn-info',
            callback: function(){
                console.log('Custom OK clicked');
            }
        }
    }
});
        });
    });
</script>
@endsection
