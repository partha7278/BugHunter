@extends('component.master')

@section('content')

    @push('title')
        DashBoard-Testing
    @endpush


    {{-- Sidebar include --}}
    @include('component/sidebar',['page' => 'testing','item'=> $item])

    <div class="modal fade" id="bugmodal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="color:#666666">BUG Found</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="vul_url" placeholder="BUG URL">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn"  data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info submit-btn" id="newbug"  data-dismiss="modal">Submit</button>
                </div>
            </div>
        </div>
    </div>


    <div class="main-content">
        <div class="test-namebar-bg">
            <span class="test-namebar-bug-cat">{{ $url->project->project_name or ''}}</span>
            <i class="fas fa-arrow-right test-namebar-bug-arrow"></i>
            <span class="test-namebar-bug-cat test-namebar-bug-link">{{ $url->project_url or ''}}</span>
            <span class="test-namebar-bug-cat test-namebar-bug-test"><span id="tcount">{{ $tcount }}</span>/{{ $bcount }}</span>
        </div>

        <input type="hidden" value="{{ $url->id }}" id="urlid" name="urlid"/>
        <input type="hidden" value="{{csrf_token()}}" id="token" name="_token"/>
        <div class="test-bug-cat-menu">

            @foreach($category as $cat)

                <div id="menu-accordion-{{ $cat->id }}">
                    <div class="menu-box">
                        <div class="menu-box-header" id="menu-header-{{ $cat->id }}" >
                            <span class="menu-box-name"> {{ $cat->b_cat_name }}  </span>
                            <a href="#menu-box-{{ $cat->id }}" data-toggle="collapse" class="fas fa-plus-circle float-right  menu-box-link" ></a>
                        </div>
                        <div class="collapse" data-parent="#menu-accordion-{{ $cat->id }}" id="menu-box-{{ $cat->id }}">

                            @foreach($cat->bugs as $bug)

                                <div class="test-item-list">
                                    <div class="test-item-list-bg">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="test-item-list-name">
                                                    {{ $bug->bug_name }}
                                                </div>
                                            </div>
                                            <div class="col-md-4"  style="display:inline-flex;">
                                                @php $p_bug=0; @endphp
                                                @foreach($url->testings as $testing) @if($testing->bug_id == $bug->id) @php $p_bug = $p_bug + $testing->t_bugs->count(); @endphp  @endif @endforeach
                                                <div id="bugcount-{{ $bug->id }}" class="test-item-list-name test-item-list-bug">{{ $p_bug }}</div>
                                                <i class="fas fa-bug test-item-list-bug-add" title="Add New Bug" onclick="foundbug( {{ $bug->id }} )" data-target="#bugmodal" data-toggle="modal"></i>
                                                <a class="test-item-list-bug-info-link" href="{{ route('b_info',['id'=>$bug->id]) }}" target="_blank"><i class="fas fa-info-circle test-item-list-bug-add test-item-list-bug-info"  title="How to Produce"></i></a>
                                                <div class="test-item-list-com">
                                                    <label class="switch">
        									             <input type="checkbox" @foreach($url->testings as $testing) @if($testing->bug_id == $bug->id) @if($testing->complete == 'true') checked @endif @endif @endforeach  name="complete" id="com-{{ $bug->id }}" onclick="complete( {{ $bug->id }} )"><span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <br/><br/><br/><br/><br/><br/><br/><br/>
    </div>

    <script>

        function complete(bug_id){
            var com_id = document.getElementById('com-'+bug_id).checked;
            var token = $('#token').val();
            var url = $('#urlid').val();
            var tcount = parseInt( $('#tcount').html() );
            if(com_id == true){ tcount = tcount + 1;}
            if(com_id == false){ tcount = tcount - 1;}

            $.ajax({
                url: "{{ route('updatetesting') }}",
                type: 'post',
                data:{ bugid:bug_id, urlid:url, com:com_id, _token:token },
                success:function(){
                    $('#tcount').html(tcount);
                    catsprogress();
                }
            });
        }

        function foundbug( bug_id ){
            var com_id = document.getElementById('com-'+bug_id).checked;
            var token = $('#token').val();
            var urlid = $('#urlid').val();
            var bugcount = parseInt( $('#bugcount-'+bug_id).html() );

            $('#newbug').click(function(){
                var url = $('#vul_url').val();
                $.ajax({
                    url: "{{ route('addnewbug') }}",
                    type: 'post',
                    data:{ bugid:bug_id, urlid:urlid, com:com_id, url:url, _token:token },
                    success:function(){
                        bugcount = bugcount +1;
                        $('#bugcount-'+bug_id).html(bugcount);
                    }
                });
            });
        }

    catsprogress();
    function catsprogress(){
        var token = $('#token').val();
        var url = $('#urlid').val();

        $.ajax({
            url: "{{ route('catsprogress') }}",
            type: 'post',
            data:{ urlid:url  ,_token:token },
            success:function(cats){
                for(i in  cats){
                    var st = (cats[i].comp / cats[i].tobug * 100).toFixed(0);
                    $('#menu-header-'+cats[i].catid).css("background-image", "linear-gradient(to right,#476b6b "+st+"%,#55446D 0% )");
                    // alert(cats[i].tobug);
                }

            }
        });
    }


    </script>

@endsection
