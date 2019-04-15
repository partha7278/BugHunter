@extends('component.master')

@section('content')

    @push('title')
        Bug - New
    @endpush

    @push('style')
        body{background:#f4f4f4;}
    @endpush


    {{-- Sidebar include --}}
    @include('component/sidebar',['page' => 'b_new','item'=> $item])



    <div class="main-content">
        <div class="row" style="margin:0px;">
            <div class="offset-md-3 col-md-6">
                <div class="bug-new-form1-bg d-flex justify-content-center">
                    <p class="bug-new-form1-label">Category</p>
                    <div class="form-group">
                        <input type="text" id="category_add" class="form-control bug-view-input-form1">
                    </div>
                    <button type="submit" id="btn-addcategory" class="update-btn bug-view-form1-btn">Save</button>
                </div>
            </div>
        </div>


        <div class="row" style="margin:0px;margin-top:40px;">
            <div class="offset-md-1 col-md-10">
                @if($error == 1)
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Warning! </strong> Unable to Insert Data.
                </div>
                @endif
                <div class="bug-new-form2-bg">
                    <form method="post" enctype="multipart/form-data" action="{{ route('addbug') }}">
                        <input type="hidden" value="{{csrf_token()}}" id="token" name="_token"/>
                        <div class="d-flex justify-content-center">
                            <div class="form-group">
                                <select class="form-control bug-view-input bug-view-input1" style="height:28px;padding:2px 10px;" id="category_sel" name="cat_id"  required>
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
                        <div class="d-flex justify-content-center">
                            <div class="form-group">
                                <input type="text" id="bug_name_or" name="bug_nor" class="form-control bug-view-input bug-view-input3" placeholder="Bug Name on Report">
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
                        <input type="submit"  value="Submit" class="update-btn bug-view-form2-btn2">
                        <input type="reset"  value="Reset" class="update-btn delete-btn bug-view-form2-btn1">
                    </form>
                </div>
            </div>
        </div>
        <br/><br/><br/><br/>
    </div>

<script>

    $('#btn-addcategory').click(function(){
        var category = $("#category_add").val();
        var token = $("#token").val();

        $.ajax({
            url: "{{ route('addcategory') }}",
            type: 'post',
            data: { category : category , _token : token },
            success: function( cat ){
                $("#category_add").val('');
                $('#category_sel').append("<option value='"+ cat.id +"'>"+ cat.b_cat_name +"</option>");

            }
        });
    });

</script>

@endsection
