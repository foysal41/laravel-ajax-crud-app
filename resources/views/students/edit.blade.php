<form id="createStudentFrom" action="{{ route('students.update', $student->id) }}" method="POST"  enctype="multipart/form-data">
    @csrf
    @method('PUT')


      <div class="form-group mb-3">
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ $student->name }}">
        <div class="nameError text-danger  errors d-none"> </div>
      </div>


      <div class="form-group mb-3">
        <input type="email" class="form-control" id="email" name="email" placeholder="email" value="{{ $student->email }}">
         <div class="emailError text-danger errors d-none"> </div>
      </div>


      <div class="form-group mb-3">
          <label for="photo">Photo</label>
          <input type="file" class="form-control" id="photo" name="photo">
          <img class="photo img_preview" style="height:200px; width: 200px; object-fit: cover;" src="{{asset('upload/students/'. $student->photo)}}" alt="P"
           class="img-fluid rounded-circle" style="width: 50px;">
           <div class="photoError text-danger errors d-none"> </div>
        </div>


        <div class="buttons text-end">
          {{--adding bootbox-cancle class --}}
          <button type="button" class="btn btn-danger bootbox-close-button">Cancle</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>


    </form>
