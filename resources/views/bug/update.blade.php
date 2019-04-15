@extends('component.master')

@section('content')

    @push('title')
        Bug -Update
    @endpush

    @push('style')
        body{background:#f4f4f4;}
    @endpush


    {{-- Sidebar include --}}
    @include('component/sidebar',['page' => 'b_update','item'=> $item])


    <div class="modal fade rem" >
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
        <div class="row" style="margin:0px;">
            <div class="offset-md-1 col-md-10">
                <div class="bug-update-form1-bg d-flex justify-content-center">
                    <div class="form-group">
                        <select class="form-control bug-view-input bug-update-input1" style="height:28px;padding:2px 10px;" id="update_category">
                            <option value="" disabled selected>Select Category</option>
                            @foreach($category as $option)
                                <option value="{{ $option->id }}">{{ $option->b_cat_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control bug-view-input bug-update-input2" style="height:28px;padding:2px 10px;" id="update_bug">
                            <option value="" disabled selected>Select Bug</option>
                        </select>
                    </div>
                    <button type="submit" id="delete_bug" class="update-btn bug-update-form1-btn" data-toggle="modal" data-target="#bug_deletemodal">Delete</button>
                </div>
            </div>
        </div>



        <div class="row" style="margin:0px;margin-top:40px;">
            <div class="offset-md-1 col-md-10">
                @if($error == 1)
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Warning! </strong> Unable to Update Data.
                </div>
                @endif
                <div class="bug-new-form2-bg">
                    <form method="post" enctype="multipart/form-data" action="{{ route('updatebug') }}">
                        <div class="d-flex justify-content-center" >
                            <div class="form-group">
                                <select class="form-control bug-view-input bug-view-input1" style="height:28px;padding:2px 10px;" id="category_sel" name="cat_id" required>
                                    <option value="" disabled selected>Select Category</option>
                                    @foreach($category as $option)
                                        <option value="{{ $option->id }}">{{ $option->b_cat_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" id="bug_name" name="bug_name" class="form-control bug-view-input bug-view-input2" placeholder="Bug Name"  required>
                            </div>
                        </div>

                        <input type="hidden" value="{{csrf_token()}}" id="token" name="_token"/>
                        <div class="d-flex justify-content-center">
                            <div class="form-group">
                                <input type="text" id="bug_name_or" name="bug_nor" class="form-control bug-view-input bug-view-input3" placeholder="Bug Name on Report" >
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="form-group">
                                <input type="text" id="bug_report" name="bug_report" class="form-control bug-view-input bug-view-input3" placeholder="Similar Bug Report Link">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center form-inline">
                            <div class="form-group">
                                <label for="bug_poc_ex" style="padding-top:5px;color:#595959;padding:10px 20px 10px 0px;">Similar Bug Video</label>
                                <input type="file" name="bug_poc_ex" style="padding:0px;font-size:13px;width:530px;" accept="video/*" id="bug_poc_ex" class="form-control bug-view-input bug-view-input7" placeholder="Bug POC Example">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="form-group">
                                <textarea id="bug_about" name="bug_about" class="form-control bug-view-input bug-view-input4" placeholder="About Vulnerability" ></textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="form-group">
                                <textarea id="bug_impact" name="bug_impact" class="form-control bug-view-input bug-view-input5" placeholder="Vulnerability Impact"></textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="form-group">
                                <textarea id="bug_poc" name="bug_produce" class="form-control bug-view-input bug-view-input6" placeholder="Vulnerability POC"  required></textarea>
                            </div>
                        </div>
                        <input type="hidden" value="" id="bug_id" name="bug_id"/>
                        <input type="submit"  value="Update" class="update-btn bug-view-form2-btn2">
                        <input type="reset"  value="Reset" class="update-btn delete-btn bug-view-form2-btn1">
                    </form>
                </div>
            </div>
        </div>
        <br/><br/><br/><br/>
    </div>


    <script>

        $('#update_category').change(function(){
            var category = $("#update_category").val();
            var token = $("#token").val();

            $.ajax({
                url: "{{ route('getbug') }}",
                type: 'post',
                data: { category : category , _token : token },
                success: function( bugs ){
                    $('#update_bug').empty().append('<option value="" disabled selected>Select Bug</option>');
                    $.each(bugs, function(i, bug) {
                        $('#update_bug').append("<option value='"+ bug.id +"'>"+ bug.bug_name +"</option>");
                    });
                }
            });
        });




        $('#update_bug').change(function(){

            var bug = $("#update_bug").val();
            var token = $("#token").val();
            $("#bug_id").val(bug);
            $('.rem').attr('id', 'bug_deletemodal');

            $.ajax({
                url: "{{ route('getbugall') }}",
                type: 'post',
                data: { bug : bug , _token : token },
                success: function( bug ){
                    $("#bug_name").val(bug.bug_name);
                    $("#bug_name_or").val(bug.bug_nor);
                    $("#bug_report").val(bug.report);
                    $("#bug_about").val(bug.bug_about);
                    $("#bug_impact").val(bug.bug_impact);
                    $("#bug_poc").val(bug.bug_produce);
                    $("#category_sel").val(bug.b_cat_id);
                }
            });
        });




        $('#delete_bug').click(function(){

            var bug = $("#update_bug").val();
            var token = $("#token").val();
            var bug_name = $("#bug_name").val();

            $('#dialog1').html('Are you sure you want to Delete BUG');
            $('#dialog2').html(bug_name);
            $('#delete-no-btn').html('No, Keep BUG');
            $('#delete-yes-btn').html('Yes, Delete BUG');

            $('#delete-yes-btn').click(function(){

                $.ajax({
                    url: "{{ route('deletebug') }}",
                    type: 'post',
                    data: { bug : bug , _token : token },
                    success: function( ){
                        $("#bug_name").val('');
                        $("#bug_name_or").val('');
                        $("#bug_about").val('');
                        $("#bug_impact").val('');
                        $("#bug_poc").val('');
                        $("#category_sel").val('');
                        $("#update_bug option[value="+bug+"]").remove();
                        $("#update_bug").val('');
                    }
                });
            });
        });

    </script>


@endsection
