<form id="createStudentFrom" action="{{ route('students.store')}}" method="POST"  enctype="multipart/form-data">
  @csrf


    <div class="form-group mb-3">
      <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
      <div class="nameError text-danger  errors d-none"> </div>
    </div>


    <div class="form-group mb-3">
      <input type="email" class="form-control" id="email" name="email" placeholder="email">
       <div class="emailError text-danger errors d-none"> </div>
    </div>


    <div class="form-group mb-3">
        <label for="photo">Photo</label>
        <input type="file" class="form-control" id="photo" name="photo">
         <img src="" alt="" class="img_preview" style="height:50px; width: 50px; object-fit: cover;">

         <div class="photoError text-danger errors d-none"> </div>
      </div>


      <div class="buttons text-end">
        {{--adding bootbox-cancle class --}}
        <button type="button" class="btn btn-danger bootbox-close-button">Cancle</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>


  </form>
