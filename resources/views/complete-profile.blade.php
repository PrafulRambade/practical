@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Complete Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Complete Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Complete Your Profile</h3>
            </div>
            <div class="card-body">
               
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#complete-profile">
                  Click Here To Complete Your Profile
               
              </div> 
            <!-- /.card-body -->
          </div>
          <div class="modal fade" id="complete-profile">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Profile Information</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form id="profile_data" accept-charset="utf-8" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="id" id="id" value="{{auth::user()->id}}">
                                        {{-- <label for="exampleInputEmail1">Email address</label> --}}
                                        {{-- <input type="text" class="form-control" name="gender" id="gender" placeholder="Enter Gender"> --}}
                                      <select class="custom-select" name="gender" id="gender" placeholder="Enter Gender">
                                        <option value="">Select Gender</option>
                                        @foreach($gender as $gd)
                                          <option value="{{$gd->id}}">{{$gd->name}}</option>
                                        @endforeach
                                      </select>
                                      </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{-- <label for="exampleInputPassword1">Password</label> --}}
                                        <input type="text" class="form-control" name="organization_name" id="organization_name" placeholder="Organization Name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{-- <label for="exampleInputPassword1">Password</label> --}}
                                        <input type="text" class="form-control" name="location" id="location" placeholder="Enter Location">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                        <div class="form-group">
                                            {{-- <label for="exampleInputPassword1">Password</label> --}}
                                            <input type="text" class="form-control" name="designation" id="designation" placeholder="Enter Designation">
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{-- <label for="exampleInputPassword1">Password</label> --}}
                                        <input type="text" class="form-control" name="city" id="city" placeholder="Enter City">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{-- <label for="exampleInputFile">File input</label> --}}
                                        <div class="input-group">
                                          <p class="mt-5 text-center" style="margin-top:0px !important">
                                            <label for="files">
                                                <a class="btn btn-info text-light" role="button" aria-disabled="false">+ Add Files</a>
                                            </label>
                                            
                                            <input type="file" name="files[]"  id="files" style="visibility: hidden; position: absolute;" placeholder="Choose files" multiple >
                                          {{-- <input type="file" name="files[]"  id="attachment" style="visibility: hidden; position: absolute;" multiple/>	 --}}
                                            </p>
                                            <p id="files-area">
                                                <span id="filesList">
                                                    <span id="files-names"></span>
                                                </span>
                                            </p>
                                        {{-- <div class="custom-file"> --}} 
                                            {{-- <input type="file" style="z-index:1000" name="files[]"  id="files" placeholder="Choose files" multiple > --}}
                                            {{-- <label class="custom-file-label" for="exampleInputFile">Choose file</label> --}}
                                        {{-- </div> --}}
                                        {{-- <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary" id="complete_profile_data">Upload</button>
                                        </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
        
                        <div class="card-footer">
                          <button type="submit" class="btn btn-primary" id="complete_profile_data1">Submit</button>
                        </div>
                      </form>
                </div>
                {{-- <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div> --}}
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $(function () {
            $.ajaxSetup({
            headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });
            const dt = new DataTransfer(); // Permet de manipuler les fichiers de l'input file

                $("#files").on('change', function(e){
                    for(var i = 0; i < this.files.length; i++){
                        let fileBloc = $('<span/>', {class: 'file-block'}),
                            fileName = $('<span/>', {class: 'name', text: this.files.item(i).name});
                        fileBloc.append('<span class="file-delete"><span>+</span></span>')
                            .append(fileName);
                        $("#filesList > #files-names").append(fileBloc);
                    };
                    // Ajout des fichiers dans l'objet DataTransfer
                    for (let file of this.files) {
                        dt.items.add(file);
                    }
                    // Mise à jour des fichiers de l'input file après ajout
                    this.files = dt.files;

                    // EventListener pour le bouton de suppression créé
                    $('span.file-delete').click(function(){
                        let name = $(this).next('span.name').text();
                        // Supprimer l'affichage du nom de fichier
                        $(this).parent().remove();
                        for(let i = 0; i < dt.items.length; i++){
                            // Correspondance du fichier et du nom
                            if(name === dt.items[i].getAsFile().name){
                                // Suppression du fichier dans l'objet DataTransfer
                                dt.items.remove(i);
                                continue;
                            }
                        }
                        // Mise à jour des fichiers de l'input file après suppression
                        document.getElementById('files').files = dt.files;
                    });
                });
            $('form#profile_data').submit(function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);

                    let TotalFiles = $('#files')[0].files.length; //Total files
                    let files = $('#files')[0];
                    for (let i = 0; i < TotalFiles; i++) {
                        formData.append('files' + i, files.files[i]);
                    }
                    formData.append('TotalFiles', TotalFiles);
                    $.ajax({
                                url: "{{route('save.profile')}}",
                                data: formData,
                                cache: false,
                                contentType: false,
                                processData: false,
                                type: 'POST',
                                dataType:'json',
                                success: (data) => {
                                this.reset();
                                alert('User Profile Updated Succefully');
                                },
                                error: function(data){
                                alert(data.responseJSON.errors.files);
                                console.log(data.responseJSON.errors);
                                }
                            });
            });


            // $(document).on('click','#complete_profile_data',function(e) {
                    
            //         var formData = new FormData(document.getElementById("profile_data"));


            //         let TotalFiles = $('#files')[0].files.length; //Total files
            //         let files = $('#files')[0];
            //         for (let i = 0; i < TotalFiles; i++) {
            //             formData.append('files' + i, files.files[i]);
            //         }
            //         console.log(TotalFiles);
            //         formData.append('TotalFiles', TotalFiles);
            //         $.ajax({
            //                     url: "{{route('profile.image')}}",
            //                     data: formData,
            //                     cache: false,
            //                     contentType: false,
            //                     processData: false,
            //                     type: 'POST',
            //                     dataType:'json',
            //                     success: (data) => {
            //                       // formData.reset();
            //                       // $('#profile_data').reset()
            //                     alert('User Profile Images Added Succefully');
            //                     },
            //                     error: function(data){
            //                     alert(data.responseJSON.errors.files);
            //                     console.log(data.responseJSON.errors);
            //                     }
            //                 });
            // });
        });
    </script>
@endsection