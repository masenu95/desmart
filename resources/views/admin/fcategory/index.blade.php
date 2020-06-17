@extends('layouts.admin')

@section('contents')
<section id="main-content" style="background: #f4f7f6">
    <section class="wrapper">
        <div class="block-header">
            <div class="col-12">
                <div class="list-display-box">
                    @if(session()->has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session()->get('success')}}
                            </div>
                    @elseif(session()->has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session()->get('error')}}
                            </div>
                    @endif
                                    <table id="dt-page" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="th-sm">No:</th>
                                                <th class="th-sm">Forum category</th>
                                                <th class="th-sm">Caption</th>
                                                <th class="th-sm">Status</th>
                                                <th class="th-sm">Created by </th>
                                                <th class="th-sm">Created at </th>
                                                <th class="th-sm">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($fcategories as $fcategory)
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>{{ $fcategory->name }}</td>
                                                    <td>{{ $fcategory->caption }}</td>
                                                    <td id="status-{{$fcategory->id}}">
                                                        @if($fcategory->confirmed==1)
                                                            Visible
                                                        @elseif($fcategory->confirmed==0)
                                                            Hidden
                                                        @endif
                                                    </td>
                                                    <td>{{ $fcategory->user->name }}</td>
                                                    <td>{{ $fcategory->created_at}}</td>
                                                    <td>
                                                        @if($fcategory->confirmed==0)
                                                        <a  href="#" onclick="visibility({{ $fcategory->id }},'{{$fcategory->name}}')" id="{{ $fcategory->id }}" >
                                                            <i class="far fa-eye" title="show" ></i>
                                                        </a>
    
                                                @elseif($fcategory->confirmed==1)
                                                        <a  href="#" onclick="visibility({{ $fcategory->id }},'{{$fcategory->name}}')" id="{{ $fcategory->id }}"  >
                                                            <i class="far fa-eye-slash" title="hide" ></i>
                                                        </a>
                                                @endif
                                                            <a href="{{ url('Fcategory/'.$fcategory->id.'/edit') }}" title="Edit">
                                                                <i class="far fa-edit"></i>
                                                            </a>
    
                                                            <a class="remove" href="javascript:void(0)" title="Remove"
                                                            onclick="var result=confirm('Are you sure you wish to delete this Forum category');
                                                            if(result){
                                                                event.preventDefault();
                                                                document.getElementById('delete-form').submit();
                                                            }
                                                            ">
                                                                <i class="far fa-trash-alt"></i>
    
                                                                </a>
                                                    <form id="delete-form" action="{{route('Fcategory.destroy',[$fcategory->id])}}" method="POST" style="display:none">
                                                        <input type="hidden" name="_method" value="delete">
                                                        {{ csrf_field() }}
                                                    </form>
    
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
            var url = '{{ url('/fvisibility') }}';

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
