@extends('layouts.admin')

@section('contents')
<section id="main-content" style="background: #f4f7f6">
    <section class="wrapper">
        <div class="block-header">
            <h3>Product categories</h3>
                <div class="col-12">
                    <div class="list-display-box">
                                        <table id="dt-page" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class="th-sm">No:</th>
                                                    <th class="th-sm">Category </th>
                                                    <th class="th-sm">Status </th>
                                                    <th class="th-sm">Created by </th>
                                                    <th class="th-sm">Created at </th>
                                                    <th class="th-sm">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($categories as $category)
                                                <tr>
                                                        <td>{{++$i}}</td>
                                                        <td>{{ $category->name }}</td>
                                                    
                                                    <td id="status-{{$category->id}}">
                                                        @if($category->confirmed==1)
                                                            Visible
                                                        @elseif($category->confirmed==0)
                                                            Hidden
                                                        @endif
                                                    </td>
                                                    <td>{{ $category->user->name }}</td>
                                                    <td>{{ $category->created_at }}</td>
                                                    

                                                <td>
                                                @if($category->confirmed==0)
                                                    <a  href="#" id="{{ $category->id }}" title="unhide" onclick="visibility({{ $category->id }},'{{$category->name}}')" >
                                                        <i class="far fa-eye visible" title="show" ></i>
                                                    </a>


                                                @elseif($category->confirmed==1)
                                                    <a id="{{ $category->id }}"  href="#" onclick="visibility({{ $category->id }},'{{$category->name}}')" >
                                                        <i class="far fa-eye-slash" title="hide" ></i>
                                                    </a>
                                                @endif
                                                <a href="{{ url('Category/'.$category->id.'/edit') }}">
                                                        <i class="far fa-edit" title="Edit"></i>
                                                    </a>

                                                    <a class="remove" href="javascript:void(0)" title="Remove"
                                                    onclick="var result=confirm('Are you sure you wish to delete this Product Category');
                                                    if(result){
                                                        event.preventDefault();
                                                        document.getElementById('delete-form').submit();
                                                    }
                                                    ">
                                                        <i class="far fa-trash-alt"></i>
                                                        <form id="delete-form" action="{{route('Category.destroy',[$category->id])}}" method="POST" style="display:none">
                                                            <input type="hidden" name="_method" value="delete">
                                                            {{ csrf_field() }}
                                                        </form>

                                            </a>

                                                    </td>
                                                </tr>

                                                    @endforeach
                                            </tbody>

                                        </table>
                    </div>
                </div>
        </div>
    </section>
</section>

<script>
    function visibility(ids,name){
        event.preventDefault();
       
        id='#'+ids;
        if($(id).children().hasClass('fa-eye')){
           var action = 'visible';
        }else {
            var action = 'hidden';
        }
        var status ='#status-'+ids;
       

        var result=confirm('Are you sure you want to ' + name+' '+ action );
        if(result){
            var token = '{{ Session::token() }}';
            var url = '{{ url('/visibility') }}';

            $.ajax({
                    method:'POST',
                    url:url,
                    data:{category:ids,_token: token,action:action},
                    success:
                    function(result){
                        $(status).empty();
                        var actions =$(id).children();
                        if(result['success']=='hide'){
                           actions.removeClass('fa-eye-slash');
                           actions.addClass('fa-eye');
                           $(status).text('hidden');
                        }else if(result['success']=='visible'){
                           actions.removeClass('fa-eye');
                           actions.addClass('fa-eye-slash');
                           $(status).text('visible');
                        }                     
                    }
            });

        }
    }

</script>

          
@endsection
