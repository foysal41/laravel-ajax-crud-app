<form>

    <div class="form-group mb-3">
      <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
    </div>


    <div class="form-group mb-3">
      <input type="email" class="form-control" id="email" name="email" placeholder="Password">
    </div>


    <div class="form-group mb-3">
        <label for="photo">Photo</label>
        <input type="file" class="form-control" id="photo" name="photo" placeholder="Password">
      </div>


      <div class="buttons text-end">
        {{--adding bootbox-cancle class --}}
        <button class="btn btn-danger bootbox-cancle">Cancle</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>


  </form>