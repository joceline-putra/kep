<script type="text/javascript">
$(document).ready(function() {  
    let url = '{{ url('/') }}/sample';
    let csrf_token = $('meta[name="csrf-token"]').attr('content')
    
    let sampleSession = '';    
    
    // Datatable

    /* CRUD */
    $(document).on("click","#btn_new",function(e) {
        e.preventDefault();
        e.stopPropagation();
        $("#modal_sample").modal('show');
    });
    $(document).on("click","#btn_close",function(e) {
        e.preventDefault();
        e.stopPropagation();
        $("#modal_sample").modal('hide');
        formSampleReset();
    });
    $(document).on("click","#btn_save", function(e) { // Done
        e.preventDefault();
        e.stopPropagation();
        let next = true;
    });
    $(document).on("click",".btn_edit", function (e) { // Done
        e.preventDefault();
        e.stopPropagation();
        let next = true;
        sampleSession = $(this).attr('data-id');
    });
    $(document).on("click",".btn_delete",function(e) { // Done
        e.preventDefault();
        e.stopPropagation();
        let next = true;
        sampleSession = $(this).attr('data-id'); 

    });
    function formSampleReset(){
        sampleSession = 0;
        $("#form_sample input")
        .not("input[name='_token']").not("input[name='sample_gender']")
        .not("input[id='sample_birth']").val('')
        .not("input[name='_token']");
        $("#form_sample input[name=sample_gender]").prop('checked', false); 
        $("#form_sample select").val(0).trigger('change');        
    }
});
</script>