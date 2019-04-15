@extends('component.master')

@section('content')

    @push('title')
        Project-View
    @endpush


    {{-- Sidebar include --}}
    @include('component/sidebar',['page' => 'p_view','item'=> $item])


    <div class="main-content">
        <div class="d-flex justify-content-center">
            <div class="form-group">
                <input type="text" class="form-control input-search" placeholder="Search..">
            </div>
        </div>

        <input type="hidden" value="{{csrf_token()}}" id="token" name="_token"/>

        <div class="update-menu">

            @foreach($project as $data)

                <div id="menu-accordion-{{ $data->id }}">
                    <div class="menu-box">
                        <div class="menu-box-header">
                            <span class="menu-box-name">{{ $data->project_name }}</span>
                            <a href="#menu-box-{{ $data->id }}" data-toggle="collapse" class="fas fa-plus-circle float-right  menu-box-link" ></a>
                            <span class="menu-box-date float-right">{{ date('d-m-Y', strtotime( $data->created_at)) }}</span>
                        </div>
                        <div class="collapse" data-parent="#menu-accordion-{{ $data->id }}" id="menu-box-{{ $data->id }}">
                            <div class="submenu-list">

                                @foreach( $data->urls as $url )

                                    <div id="submenu-accordion-{{ $url->id }}">
                                        <div class="submenu-box">
                                            <div class="submenu-box-header">
                                                <span class="submenu-box-header-name">{{ $url->project_url }}</span>
                                                    @php $c =  $url->testings->sum(function ($testing) { return $testing->t_bugs->count(); }) @endphp
                                                <a href="#submenu-box-{{ $url->id }}" data-toggle="collapse" class="fas fa-caret-up float-right submenu-box-link @if( $c == 0) blank_accordion @endif"></a>
                                                <i class="fas fa-flask float-right submenu-box-testing @if(isset( $_COOKIE['testing'] )) @if( $_COOKIE['testing'] == $url->id ) testing-active @endif  @endif " id="testing-{{ $url->id }}" onclick="sendtesting( {{ $url->id }} )" title="Send for Testing"></i>
                                                <span class="float-right view-bug-count"> {{ $c }} </span>
                                                <span class="float-right view-bug-date">{{ date('d-m-Y', strtotime( $url->created_at)) }} </span>
                                            </div>
                                            <div class="collapse" data-parent="#submenu-accordion-{{ $url->id }}" id="submenu-box-{{ $url->id }}">
                                                <div class="submenu-item-list">

                                                    @foreach($url->testings as $testing )
                                                        @foreach($testing->t_bugs as $t_bug)
                                                            <div class="submenu-item-list-bg">
                                                                <div class="row">
                                                                    <div class="col-md-5">
                                                                        <p class="view-bug-name">
                                                                            {{ $testing->bug->bug_name }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-4" style="margin-left:0px;">
                                                                        <p class="view-bug-name view-bug-url">
                                                                            {{ $t_bug->vulnerable_url }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <span class="view-bug-url-date">{{ date('d-m-Y', strtotime( $t_bug->created_at )) }}</span>
                                                                        <a href="{{ route('bug_report',['id'=>$t_bug->id ]) }}" target="_blank" class="fas fa-bullhorn view-bug-report @if( $t_bug->send == 1 ) view-bug-report-submited @endif"></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>

        <br/><br/><br/><br/><br/><br/><br/><br/>
    </div>

    <script>

    function sendtesting( urlid ){

        var token = $('#token').val();
        $.ajax({
            url: "{{ route('testingcookie') }}",
            type: 'post',
            data:{ urlid:urlid, _token:token },
            success:function(res){
                $('.submenu-box-testing').removeClass('testing-active');
                $('#testing-'+urlid).addClass('testing-active');
            }
        });
    }

    </script>

@endsection
