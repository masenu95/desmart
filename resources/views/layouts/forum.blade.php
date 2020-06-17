<!DOCTYPE html>
<html>

<head>
    <title>Smart investor</title>
    <link rel="stylesheet" href="{{asset('css/forum.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
    </script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>

    <style>
        .logo{
            width: 150px;
            height: 50px;
            float: left;

        }
    </style>
</head>

<body>
    <!-- NAVIGATION -->
    <nav id="forum-nav">
        <div class="container">
            <div class="nav-items">
                <ol id="nav-left">
                   <a href="{{ url('/') }}"><img src="{{asset('images/logo.png')}}" alt="" class="logo"></a>
                    <li><a href="{{ url('Investment') }}">HOME</a></li>
                </ol>
            <div class="row" style="padding-bottom: 20px">
                <div class="col-lg-3 col-md-3">
                    <form action="{{ url('search')}}" method="GET" class="search-form">
                        <div class="form-group has-feedback">
                            <label for="search" class="sr-only">Search</label>
                            <input type="text" class="form-control" name="search" id="search" placeholder="search">
                              <i class="fas fa-search form-control-feedback"></i>
                        </div>
                    </form>

                </div>
                <div class="col-lg-4 col-md-4 ">
                    <ul id="nav-right">
                        <li><a href="{{ url('/') }}"><i class="fas fa-brifcase"></i>market</a></li>
                        <li><a href=""><i class="fas fa-question"></i>faq</a></li>
                        @if(Auth::check())
                        <li><a href="">{{ Auth::user()->name }}</a></li>
                        @else
                        <li><a href="{{url('login')}}"><i class="fas fa-key"></i>Login</a></li>
                        @endif
                    </ul>
                </div>

            </div>

            </div>

        </div>
    </nav>
    @auth
    <button style="float:right"  class="post-c" data-toggle="modal" data-target="#exampleModalCenter" title="create new post">
        <i class="fas fa-edit"></i>
      </button>
    @endauth

    @yield('content')
    <footer id="forum-footer">
    <ul class="social-icon">
        <li><a href=""><i class="fab fa-twitter"></i></a></li>
        <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
        <li><a href=""><i class="fab fa-instagram"></i></a></li>
        <li><a href=""><i class="fab fa-pinterest-p"></i></a></li>
        <li><a href=""><i class="fab fa-linkedin-in"></i></a></li>
        <li><a href=""><i class="fab fa-whatsapp"></i></a></li>
        </ul>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/c9n8lv64qx7dbzb28o6htk17kvlraoym4dofl8tzwes867j0/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script src="{{asset('js/forum.js')}}"></script>

    <script>
      tinymce.init({
          selector:'textarea.description',
          height: 300
      });

      tinymce.init({
          selector:'textarea.comment',
          height:200
      })

      function preview_image() {
      var total_file=document.getElementById("file").files.length;
        for(var i=0;i<total_file;i++)
        {
        $('#output').append("<img class='img-preview' src='"+URL.createObjectURL(event.target.files[i])+"'>");
        }
        }

  </script>



      <!-- Modal -->
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-head">
              <button type="button" class="post-create" data-dismiss="modal"><i class="fas fa-times"></i></button>
              <h5 class="modal-title" id="exampleModalLongTitle">CREATE POST</h5>

            </div>
            <div class="modal-body">
              <form action="{{ route('Investment.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                        <select class="form-control" name="category">
                                <option>select post category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control"  placeholder="Enter Post title" name="title">
                    </div>
                    <div class="form-group">
                      <textarea class="description" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="file"  accept="image/*" name="upload_file[]" id="file"  onchange="preview_image();" style="display: none;" multiple>
                        <label for="file" class="file-upload" style="cursor: pointer;"><i class="fas fa-images"></i>Upload Image</label>
                        <div id="output"></div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" style="">Create post</button>
                    </div>
              </form>
            </div>
          </div>
        </div>
      </div>
</body>
</html>
