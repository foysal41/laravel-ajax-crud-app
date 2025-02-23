@extends('students.layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col">
                <h2>Student Create</h2>
            </div>
            <div class="col ">

                <a formActionUrl="{{ route('students.store') }}" title="Create" href="{{ route('students.create') }}"
                    class="btn btn-primary float-end" id="BootModalShow">Add Student</a>
            </div>
        </div>
        {{-- Table --}}
        <div class="row mt-5 justify-content-center">
            <div class="col-md-10"> <!-- Added container for better alignment -->
                <div class="table_content">
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

                            @forelse($students as $key => $student)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>
                                        <img class="photo" style="height:50px; width: 50px; object-fit: cover;"
                                            src="{{ asset('upload/students/' . $student->photo) }}" alt="P"
                                            class="img-fluid rounded-circle" style="width: 50px;">
                                    </td>
                                    <td>
                                        <a title="View" href="#" class="btn btn-info" title="View Details">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>
                                        <a formActionUrl="{{ route('students.update', $student->id) }}" title="Edit"
                                            href="{{ route('students.edit', $student->id) }}" id="BootModalShow"
                                            class="btn btn-success" title="Edit">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>

                                        <form class="deleteBtn d-inline" action="{{ route('students.destroy', $student->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <a title="Delete" href="#" class=" btn btn-danger" title="Delete">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </a>

                                        </form>





                                    </td>
                                </tr>


                            @empty

                                <tr>
                                    <td>
                                        <b class="text-danger" colspan="5"> No Data</b>
                                    </td>
                                </tr>
                            @endforelse


                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection



@section('script')
    <script>
        $(document).ready(function() {
            let dialog = '';
            $(document).on('click', '#BootModalShow', function(e) {
                e.preventDefault();

                let ModalUrl = $(this).attr('href');
                let ModalTitle = $(this).attr('title');
                let formUrl = $(this).attr('formActionUrl');

                //alert(ModalUrl);
                //যদি #BootModalShow এই id টা যে খানে আছে তার this বাহহার হয়েছে। তার href
                // check করলাম alert(ModalUrl);

                // calling ajax for showing modal for create
                $.ajax({
                    type: 'GET',
                    url: ModalUrl,
                    success: function(res) {
                        dialog = bootbox.dialog({
                            title: 'Student' + ' ' + ModalTitle,

                            //adding modal content
                            message: "<div class='ModalContent'> </div>",

                            size: 'large',

                            //**delete bootbox button use form button**
                        });
                        $('.ModalContent').html(res);
                    }
                });
            });



            $(document).on('submit', '#createStudentForm', function(e) {
                e.preventDefault(); // ফর্ম সাবমিট বন্ধ করলাম

                let formData = new FormData($('#createStudentForm')[0]); // ফর্ম ডেটা তৈরি করলাম

                $.ajax({
                    type: "POST", // POST রিকোয়েস্ট
                    url: formUrl, // রুট URL
                    data: formData, // ফর্ম ডেটা পাঠানো
                    processData: false, // প্রক্রিয়াকরণ বন্ধ করলাম
                    contentType: false, // Content-Type বন্ধ করলাম
                    success: function(res) {
                        if (res.status === 400) { // যদি স্ট্যাটাস 400 হয় (ভ্যালিডেশন ত্রুটি)
                            $('.errors').html(''); // পুরনো ত্রুটি ক্লিয়ার করলাম
                            $('.errors').removeClass(
                                'd-none'); // ত্রুটি দেখানোর জন্য ক্লাস সরালাম

                            if (res.errors.name) {
                                $('.nameError').text(res.errors.name); // name ত্রুটি দেখানো
                            }
                            if (res.errors.email) {
                                $('.emailError').text(res.errors.email); // email ত্রুটি দেখানো
                            }
                            if (res.errors.photo) {
                                $('.photoError').text(res.errors.photo); // photo ত্রুটি দেখানো
                            }
                        } else {
                            $('.errors').html(''); // ত্রুটি ক্লিয়ার
                            $('.errors').addClass('d-none'); // ত্রুটি লুকানোর জন্য ক্লাস যোগ
                            $('.table_content').load(location.href + ' .table_content');
                            dialog.modal('hide'); // মডাল ছাড়ানো
                        }
                    }
                });
            });





            $(document).on('change', '#photo', function(e) {
                e.preventDefault();
                const file = this.files[0];

                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        $('.img_preview').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });


            // Delete
            $(document).on('click', '.deleteBtn', function(e) {
                e.preventDefault();

                let deleteUrl = $(this).attr('action');
                let csrf = $(this).find('input[name="_token"]').val();
                bootbox.confirm({
                    message: "Are you sure you want to delete?",
                    buttons: {
                        confirm: {
                            label: 'Yes',
                            className: 'btn-success'
                        },
                        cancel: {
                            label: 'No',
                            className: 'btn-danger'
                        }
                    },
                    callback: function(result) {
                        if(result){
                            $.ajax({
                                type: "POST",
                                url: deleteUrl,
                                data: {'_token':csrf, '_method': 'DELETE'},
                                dataType: "dataType",
                                success: function (res) {
                                   console.log(res);

                                   if(res.status === 200){
                                    $('.table_content').load(location.href + ' .table_content');
                        
                                   }

                                }
                            });
                        }
                    }
                });
            });



        });
    </script>
@endsection
