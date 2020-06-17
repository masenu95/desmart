@extends('layouts.app')

@section('content')
	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="#">Home</a></li>
				<li><a href="#">Products</a></li>
				<li><a href="#">Create</a></li>

			</ul>
		</div>
	</div>
	<!-- /BREADCRUMB -->
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h1 style="margin-top:20px;margin-bottom:40px">
                Please enter product detail to start sell with us
            </h1>
            <form method="POST" action="{{ route('Product.store') }}" enctype="multipart/form-data">
               @csrf
                <div class="form-group">
                    <select name="category" id="category"  class="form-control" >
                        <option>Choose Product category..</option>
                        @foreach ($categories as $category )
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <select name="subcategory" id="subcategory"  class="form-control" >
                        <option value="subcategory_id">Choose Product subcategory..</option>
                    </select>
                        @if($errors->has('subcategory'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('subcategory') }}</strong>
                            </span>
                        @endif
                </div>
                <div class="form-group">
                    <input type="text" name="title" class="form-control"  aria-describedby="titleHelp" placeholder="Enter Product title">
                        @if($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                </div>
                <div class="form-group">
                    <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
                        @if($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-4 col-md-4 col-sm-4">
                        <input type="text" name="price" class="form-control"  aria-describedby="titleHelp" placeholder="Price">
                            @if($errors->has('price'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </span>
                            @endif
                    </div>

                    <div class="form-group col-lg-6 col-md-4 col-sm-6">
                        <select name="location" id="region"  class="form-control" >
                            <option>Choose location..</option>
                            <option value="Dar-es-salaam">Dar-es-salaam</option>
                        </select>
                        @if($errors->has('price'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('price') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">

                        <input type="file"  accept="image/*" name="upload_file[]" id="file"  onchange="preview_image();" style="display: none;" multiple>
                        <label for="file" class="file-upload" style="cursor: pointer;"><i class="fas fa-images"></i>Upload Image</label>
                        <div id="output"></div>



                </div>
                <button type="submit">Post Ad</button>


            </form>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            didiaadhjavaohlk
        </div>
    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>

$(document).ready(function ()
        {
                $('select[name="category"]').on('change',function(){
                var categoryID = $(this).val();
                if(categoryID)
                {
                    $.ajax({
                        url : '/subcategory/' +categoryID,
                        type : "GET",
                        dataType : "json",
                        success:function(data)
                        {
                            console.log(data);
                            $('select[name="subcategory"]').empty();
                            $.each(data, function(key,value){
                            $('select[name="subcategory"]').append('<option value="'+ key +'">'+ value +'</option>');
                            });
                        }
                    });
                }
                else
                {
                    $('select[name="subcategory"]').append('<option>Select product category first</option');
                }
                });
        });
   function preview_image() {
    var total_file=document.getElementById("file").files.length;
 for(var i=0;i<total_file;i++)
 {
  $('#output').append("<img class='img-preview' src='"+URL.createObjectURL(event.target.files[i])+"'>");
 }
}


    </script>

@endsection
