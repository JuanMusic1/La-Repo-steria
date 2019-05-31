@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-8">
            
            <div class="card uper">
            
                <div class="card-header">
                    Subir ejercicio
                </div>
            
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                    @endif

                    
                    <form method="post" action="{{ route('exercises.update', $exercise->id) }}">
                    @method('PATCH')
                    @csrf
                    
                        <div class="form-group">
                            <label for="title">Titulo:</label>
                            <input type="text" class="form-control" name="title" value={{ $exercise->title }} />
                         </div>

                        <div class="form-group">
                          <label for="description">Descripcion:</label>
                          <textarea class="form-control" name="description" rows="5">{{ $exercise->description }}</textarea>
                        </div>

                        <div class="form-group">
                                <label for="tag">Categoría:</label>
                                <select class="form-control" name="tag">
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}" @if($tag->id == $exercise->tag_id) {{ "seleced" }} @endif >{{ $tag->title }}</option>
                                    @endforeach
                                </select>
                        </div>

                    
                        <div class="form-group">
                                <label for="users">IDs de los usuarios:</label><br>
                                <input value="@foreach($users as $user) {{ $user->id . "," }} @endforeach" data-role="tagsinput" name="users"/>
                            </div>
    
                          <div class="form-group control-group increment">
                                <label for="files">Archivos:</label>
                                
                                <div class="file-loading">
                                    <input id="input-file" type="file" class="file" name="attachment[]" data-preview-file-type="text" multiple>
                                </div>
    
                                <script>
                                    $(document).ready(function(){
                                        // initialize with defaults
                                        $("#input-file").fileinput({
                                            uploadUrl: "/exercises/store",
                                            theme: 'fa',
                                            language: 'es',
                                            showUpload: false,
                                            showUploadStats: false,
                                            uploadAsync: false
                                        });
                                    });
                                </script>
    
                            </div>  
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection