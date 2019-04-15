@extends('component.master')

@section('content')

    @push('title')
        Project-Update
    @endpush


    {{-- Sidebar include --}}
    @include('component/sidebar',['page' => 'p_update','item'=> $item])

    <div class="modal fade" id="url_deletemodal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="url_deletemodal-text1">Are you sure?</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body delete-modal-bg">
                    <h6 class="url_deletemodal-text2" id="dialog1"></h6>
                    <p style="opacity:0.8;" id="dialog2"></p>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-no" id="delete-no-btn" data-dismiss="modal">No,</button>
                        <button type="button" class="btn btn-danger" id="delete-yes-btn" data-dismiss="modal">Yes,</button>
                </div>
            </div>
        </div>
    </div>


    <div class="main-content">
        <div class="d-flex justify-content-center">
            <div class="form-group">
                <input type="text" class="form-control input-search" placeholder="Search..">
            </div>
        </div>

        <div class="update-menu">

            <input type="hidden" value="{{csrf_token()}}" id="token"/>

            @foreach($project as $data)

                <div id="menu-accordion-{{ $data->id }}">
                    <div class="menu-box">
                        <div class="menu-box-header">
                            <span class="menu-box-name" id="pro_name-{{ $data->id }}">{{ $data->project_name }}</span>
                            <a href="#menu-box-{{ $data->id }}" data-toggle="collapse" class="fas fa-plus-circle float-right  menu-box-link" ></a>
                            <span class="menu-box-date float-right">@if(count($data->urls) > 0) {{ date('d-m-Y', strtotime( $data->urls->Last()->created_at)) }} @else {{ date('d-m-Y', strtotime( $data->created_at)) }}  @endif  </span>
                        </div>
                        <div class="collapse" data-parent="#menu-accordion-{{ $data->id }}" id="menu-box-{{ $data->id }}">
                            <div class="update-menu-item-list">
                                <div class="row">
                                    <div class="col-md-10">
                                        <form id="update-data-{{ $data->id }}">
                                        <div class="row">
                                            <div class="col-md-4" >
                                                <div class="form-group">
                                                    <input type="text" value="{{ $data->project_name }}" name="p_name{{ $data->id }}" id="p_name{{ $data->id }}" class="form-control input-url" placeholder="Project Name">
                                                </div>
                                            </div>
                                            <div class="col-md-4" >
                                                <div class="form-group">
                                                    <input type="text" value="{{ $data->contact }}" name="p_contact{{ $data->id }}" id="p_contact{{ $data->id }}" class="form-control input-url" placeholder="Contact Detail">
                                                </div>
                                            </div>

                                            @foreach( $data->urls as $url )
                                                <div class="col-md-4" id="url-{{ $url->id }}">
                                                    <div class="form-group d-flex justify-content-center">
                                                        <input type="text" value="{{ $url->project_url }}" class="form-control input-url with-icon" name="p_url-{{ $url->id }}" id="p_url-{{ $url->id }}" placeholder="Project URL">
                                                        <span class="far fa-trash-alt input-url-delete" onclick="deleteurl( {{ $url->id }},'{{ $url->project_url }}' ,0 )" data-toggle="modal" data-target="#url_deletemodal"></span>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <div class="col-md-4" id="new-col-{{ $data->id }}">
                                                <div class="form-group">
                                                    <input type="text" class="form-control input-url" placeholder="New URL" id="new-url-{{ $data->id }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="check">
                                        <button type="button" class="update-btn delete-btn menu-list-btn-mar" onclick="deleteurl( {{ $data->id }},'{{ $data->project_name }}' ,1 )" data-toggle="modal" data-target="#url_deletemodal">Delete</button>
                                        <button type="button" class="update-btn menu-list-btn-mar" onclick="updateproject( {{ $data->id }} )">Update</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>

        <br/><br/><br/><br/><br/><br/><br/><br/>
    </div>
    <script>
        function deleteurl(id,product,del){
            if(del == 0){
                $('#dialog1').html('Are you sure you want to Delete URL');
                $('#dialog2').html(product);
                $('#delete-no-btn').html('No, Keep URL');
                $('#delete-yes-btn').html('Yes, Delete URL');

                $('#delete-yes-btn').click(function(){
                    var token = $('#token').val();

                    $.ajax({
                        url: "{{ route('deleteurl') }}",
                        type: 'post',
                        data: { uid : id , _token : token },
                        success: function( result ){
                            $('#url-'+id).remove();
                        }
                    });
                });
            }else if(del == 1){
                $('#dialog1').html('You want to Delete Project');
                $('#dialog2').html('<b style="opacity:0.8;">'+product+'</b>');
                $('#delete-no-btn').html('No, Keep Project');
                $('#delete-yes-btn').html('Yes, Delete Project');

                $('#delete-yes-btn').click(function(){
                    var token = $('#token').val();

                    $.ajax({
                        url: "{{ route('deleteproject') }}",
                        type: 'post',
                        data: { pid : id , _token : token },
                        success: function( result ){
                            $('#menu-accordion-'+id).remove();
                        }
                    });
                });
            }
        }

        function updateproject(id){
            var url = $('#new-url-'+id).val();
            url = url.trim();
            var token = $('#token').val();

            if (url.length > 5) {
                $.ajax({
                    url: "{{ route('addurl') }}",
                    type: 'post',
                    data: { pid:id , url:url , _token:token },
                    success: function( url ){
                        $('#new-url-'+id).val('');
                        $('#new-col-'+id).before("<div class='col-md-4' id='url-"+ url.id +"'><div class='form-group d-flex justify-content-center'><input type='text' value='"+ url.project_url +"' class='form-control input-url with-icon' id='page_url-"+ url.id +"' name='page_url-"+ url.id +"' placeholder='Project URL'><span class='far fa-trash-alt input-url-delete' onclick=\"deleteurl( "+ url.id +",'"+ url.project_url +"' ,0 )\" data-toggle='modal' data-target='#url_deletemodal'></span></div></div>");
                    }
                });
            }

            var pb = $("#update-data-"+id).serialize();

            $.ajax({
                url: "{{ route('updateproject') }}",
                type: 'post',
                data: { pid:id , data : pb , _token:token },
                success: function( result ){
                    var p_name = $('#p_name'+id).val();
                    $('#pro_name-'+id).html(p_name);
                }
            });

        }
    </script>

@endsection
