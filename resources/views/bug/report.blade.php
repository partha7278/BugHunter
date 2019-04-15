@extends('component.master')

@section('content')

    @push('title')
        Bug - Report
    @endpush

    @push('style')
        body{background:#f4f4f4;}
    @endpush

        <input type="hidden" value="{{csrf_token()}}" id="token" name="_token"/>
        <input type="hidden" value="{{ $t_bug->id }}" id="t_bug" name="t_bug"/>
        <div class="row" style="margin:0px;margin-top:40px;">
            <div class="offset-md-2 col-md-8">
                <div class="bug-new-form2-bg">
                    <div class="d-flex justify-content-center" style="">
                        <div class="form-group">
                            <select class="form-control bug-view-input bug-view-input1" style="height:28px;padding:2px 10px;" id="category_sel" >
                                @foreach( $b_cat as $cat )
                                    <option @if( $t_bug->testing->bug->b_cat_id == $cat->id ) selected @endif >{{ $cat->b_cat_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" id="bug_name" value="{{ $t_bug->testing->bug->bug_name }}" class="form-control bug-view-input bug-view-input2" placeholder="Bug Name">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="form-group">
                            <input type="text" id="bug_name_or" value="{{ $t_bug->testing->bug->bug_nor }}" class="form-control bug-view-input bug-view-input3" placeholder="Bug Name on Report">
                        </div>
                    </div>
                    <div class="report-input-align">
                        <div class="d-flex justify-content-left">
                            <span class="report-input-text">Report Submit ( <span class="report-contact">{{ $t_bug->testing->url->project->contact }}</span> )</span>
                            <label class="switch">
                                 <input type="checkbox" @if($t_bug->send == 1 ) checked @endif name="complete" id="report-done"><span class="slider round"></span>
                            </label>
                            @if( $t_bug->testing->bug->report )
                                <p class="report-similar"><a target="_blank" href="{{ $t_bug->testing->bug->report }}">Similar Report link</a></p>
                            @endif
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="form-group">
                            <textarea id="bug_about"  class="form-control bug-view-input bug-view-input4" placeholder="About Vulnerability">{{ $t_bug->testing->bug->bug_about }}</textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="form-group">
                            <textarea id="bug_impact" class="form-control bug-view-input bug-view-input5" placeholder="Vulnerability Impact">{{ $t_bug->testing->bug->bug_impact }}</textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="form-group">
                            <textarea id="bug_poc"  class="form-control bug-view-input bug-view-input6" placeholder="Vulnerability POC">{{ $t_bug->testing->bug->bug_produce }}</textarea>
                        </div>
                    </div><br/>
                </div>
            </div>
        </div>
        <br/><br/><br/><br/>

        <script>
        $('#report-done').click(function(){
            var send = document.getElementById('report-done').checked;
            var t_bug = $('#t_bug').val();
            var token = $('#token').val();

            $.ajax({
                url: "{{ route('reportsubmit') }}",
                type: 'post',
                data: { sendid:send, t_bugid:t_bug, _token:token },
                success:function(){
                }
            });

        });

        </script>

@endsection
