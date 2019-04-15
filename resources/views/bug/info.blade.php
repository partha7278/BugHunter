@extends('component.master')

@section('content')

    @push('title')
        Bug - info
    @endpush

    @push('style')
        body{background:#f4f4f4;}
    @endpush

        <div class="row" style="margin:0px;margin-top:40px;">
            <div class="offset-md-2 col-md-8">
                <div class="bug-new-form2-bg">
                    <h4 class="info-bug">{{ $data->bug_name }}</h4>
                    <h5 class="info-poc-name">Bug POC</h5>
                    <pre class="info-poc">{{ $data->bug_produce }}</pre>
					@if( $data->report )
                        <p class="report-similar"><a target="_blank" href="{{ $data->report }}">Similar Report link</a></p>
                    @endif
					@if( $data->bug_poc )
						<h5 class="info-poc-name">Bug Video POC</h5>
						<video  width="760" height="490" controls preload="auto">
							<source src="{{URL::asset( 'public/uploads/'.$data->bug_poc )}}" type="video/{{ $data->bug_poc_exten }}">
						</video>
					@endif
                </div>
            </div>
        </div>
        <br/><br/><br/><br/>

@endsection
