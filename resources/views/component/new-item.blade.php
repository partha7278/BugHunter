
<div class="modal fade" id="new-item">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="item-name" style="color:#666666"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control" id="item_name" placeholder="Site Name">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="item_url" placeholder="Site URL">
                    <input type="hidden" value="{{csrf_token()}}" id="token_pro"/>
                    <input type="hidden" value="" id="item_type"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info submit-btn" onclick="additemsubmit()" id="item-submit" data-dismiss="modal">Add Project</button>
            </div>
        </div>
    </div>
</div>

<script>

function additem(itemtype){
    if(itemtype == 0){
        $('#item-name').html('Add Site');
        $('#item-submit').html('Add Site');
        $('#item_type').val('0');
    }
    else if(itemtype == 1){
        $('#item-name').html('Add Program Site');
        $('#item-submit').html('Add Program');
        $('#item_type').val('1');
    }
    else if(itemtype == 2){
        $('#item-name').html('Add Tool Site');
        $('#item-submit').html('Add Tool');
        $('#item_type').val('2');
    }
}

function additemsubmit(){

    var token = $("#token_pro").val();
    var item_name = $("#item_name").val();
    var item_url = $("#item_url").val();
    var itemty = $('#item_type').val();

    $.ajax({
        url: "{{ route('additem') }}",
        type: 'post',
        data: { itemtype:itemty , item_name:item_name , item_url:item_url , _token : token },
        success:function(res){
            if(res == 0){ $('.item-0').before('<a href="'+item_url+'" target="_blank"><button class="sidebar-btn no-logo">'+item_name+'</button></a>'); }
            else if(res == 1){ $('.item-1').before('<a href="'+item_url+'" target="_blank"><button class="sidebar-btn no-logo">'+item_name+'</button></a>'); }
            else if(res == 2){ $('.item-2').before('<a href="'+item_url+'" target="_blank"><button class="sidebar-btn no-logo">'+item_name+'</button></a>'); }
            $("#item_name").val('');
            $("#item_url").val('');
        }
    });
}

</script>
