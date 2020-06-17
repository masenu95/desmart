@extends('layouts.admin')

@section('contents')
<section id="main-content" style="background: #f4f7f6">
    <section class="wrapper">
        <div class="block-header">
            <div class="col-12">
                <div class="list-display-box">
                    <table id="dt-page" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                        <thead>
                                <tr>
                                    <th class="th-sm">No:</th>
                                    <th class="th-sm">Subcategory</th>
                                    <th class="th-sm">Category</th>
                                    <th class="th-sm">Status</th>
                                    <th class="th-sm">Created by </th>
                                    <th class="th-sm">Created at </th>
                                    <th class="th-sm">Action</th>

                                </tr>
                        </thead>
                        <tbody>
                            @foreach ($subcategories as $subcategory)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{ $subcategory->name }}</td>
                                    <td>{{ $subcategory->category->name }}</td>
                                    <td id="status-{{$subcategory->id}}">
                                        @if($subcategory->confirmed==1)
                                            Visible
                                        @elseif($subcategory->confirmed==0)
                                            Hidden
                                        @endif
                                    </td>
                                    <td>{{ $subcategory->user->name }}</td>
                                    <td>{{ $subcategory->created_at }}</td>
                                    <td>
                                            @if($subcategory->confirmed==0)
                                                    <a  href="#" onclick="visibility({{ $subcategory->id }},'{{$subcategory->name}}')" id="{{ $subcategory->id }}" >
                                                        <i class="far fa-eye" title="show" ></i>
                                                    </a>

                                            @elseif($subcategory->confirmed==1)
                                                    <a  href="#" onclick="visibility({{ $subcategory->id }},'{{$subcategory->name}}')" id="{{ $subcategory->id }}"  >
                                                        <i class="far fa-eye-slash" title="hide" ></i>
                                                    </a>
                                            @endif
                                                        <a href="{{ url('Subcategory/'.$subcategory->id.'/edit') }}" title="Edit">
                                                            <i class="far fa-edit"></i>
                                                        </a>

                                                        <a class="remove" href="javascript:void(0)" title="Remove"
                                                        onclick="var result=confirm('Are you sure you wish to delete this Product subcategory');
                                                        if(result){
                                                            event.preventDefault();
                                                            document.getElementById('delete-form').submit();
                                                        }
                                                        ">
                                                            <i class="far fa-trash-alt"></i>

                                                            </a>
                                                <form id="delete-form" action="{{route('Subcategory.destroy',[$subcategory->id])}}" method="POST" style="display:none">
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
                var url = '{{ url('/Svisibility') }}';
    
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
</section>
@endsection
