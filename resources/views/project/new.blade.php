
<div class="modal fade" id="p_newmodal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color:#666666">NEW PROJECT</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control" id="p_name" placeholder="Project Name">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="p_url" placeholder="Project URL">
                     <input type="hidden" value="{{csrf_token()}}" id="token_pro"/>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="p_contact" placeholder="Contact Detail">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info submit-btn" onclick="addproject()" data-dismiss="modal">Add Project</button>
            </div>
        </div>
    </div>
</div>

<script>

function addproject(){
    var p_name = $("#p_name").val();
    var p_url = $("#p_url").val();
    var p_contact = $("#p_contact").val();
    var token = $("#token_pro").val();

    $.ajax({
        url: "{{ route('addproject') }}",
        type: 'post',
        data: { p_name : p_name , p_url : p_url, p_contact : p_contact, _token : token },
        success: function( result ){
            $("#p_name").val('');
            $("#p_url").val('');
            $("#p_contact").val('');
            console.log(result);
        },
        error: function( result ){
            console.log(result);
        }
    });
}

</script>
