<script type="text/javascript">
$(document).ready(function() {  
    

    let url = '{{ url('/') }}/yearly_period'; 
    let url_search = '{{ url('/') }}/search';    
    let csrf_token = $('meta[name="csrf-token"]').attr('content')
    
    let periodSession = '';  

    /** handle token */
    let login = '{{ url('/') }}';
    const userdata = JSON.parse(localStorage.getItem('lms-userdata'));   
    if(userdata == null) {
        window.location.href = login;
    }
    const bearer_token = userdata['token'];
    const token_expired_date = userdata['token_expired_date'];
    const now = new Date();
    // compare expired date with date now
    const isTokenExpired = now > new Date(token_expired_date);
    // if expired then to login page
    if (isTokenExpired) {
        window.location.href = login;
        localStorage.removeItem('lms-userdata');
    }
    /** end handle token */

    //Datatable
    let data_table = $("#table_period").DataTable({
        "responsive": true,
        "serverSide": true,            
        "ajax": {
            url: url,
            type: 'post',
            dataType: 'json',
            cache: 'false',
            data: function(d) {
                d._token = '{{ csrf_token() }}';                
                d.action = 'load';
                
                d.search = {value:$("#filter_search").val()};
                d.length = $("#filter_length").find(':selected').val();
                d.filter_status = $("#filter_status").find(':selected').val();                                                
            },
            dataSrc: function(data) {
                return data.result;
            }
        },
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
        "columnDefs": [
            {"targets":0, "width":"30%", "title":"Session", "searchable":true, "orderable":true},      
            {"targets":1, "width":"30%", "title":"Start", "searchable":true, "orderable":true},   
            {"targets":2, "width":"30%", "title":"End", "searchable":true, "orderable":true}, 
            {"targets":3, "width":"30%", "title":"Status", "searchable":true, "orderable":true},                        
            {"targets":4, "width":"20%", "title":"Action", "searchable":true, "orderable":true},                      
        ],
        "order": [[0, 'ASC']],
        "columns": [{
                'data': 'yearly_session',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    return data;
                }
            },{
                'data': 'yearly_start',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    return row.yearly_start+'/'+row.yearly_month_start;
                }
            },{
                'data': 'yearly_end',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    return row.yearly_end+'/'+row.yearly_month_start;
                }
            },{
                'data': 'yearly_status',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    if(row.yearly_status == 0){
                        dsp += '<span class="badge bg-warning-subtle text-warning">Inactive</span>';
                    }else if(row.yearly_status == 1){
                        dsp += '<span class="badge bg-success-subtle text-success">Running</span>';
                    }else if(row.yearly_status == 2){
                        dsp += '<span class="badge bg-info-subtle text-info">Ended</span>';
                    }else if(row.yearly_status == 4){
                        dsp += '<span class="badge bg-danger-subtle text-danger">Archieve</span>';
                    }
                    return dsp;
                }
            },{
                'data': 'yearly_session',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    dsp += `
                    <div class="dropdown d-inline-block">
                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ri-more-fill align-middle"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a href="#" class="dropdown-item btn_edit" data-id="${data}" data-session="${row.yearly_session}" data-name="${row.yearly_start}/${row.yearly_end}">
                                    <i class="ri-eye-fill align-bottom me-2 text-muted"></i> View
                                </a>
                            </li>`;
                        // if(data < 4){
                            dsp +=  `<li>
                                    <a href="#" class="dropdown-item remove-item-btn btn_delete" data-id="${data}" data-session="${row.yearly_session}" data-name="${row.yearly_start}/${row.yearly_end}" style="cursor:pointer">
                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                    </a>
                                </li>`;
                        // }
                    dsp += `</ul>
                    </div>`;
                    // <li>
                    //     <a href="#" class="dropdown-item edit-item-btn btn_edit" data-id="${data}" data-session="${row.menu_session}" data-name="${row.menu_name}" style="cursor:pointer">
                    //         <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit
                    //     </a>
                    // </li>                    
                    return dsp;
                }
            }
        ]
    });
    $("#table_period_filter").css('display','none');
    $("#table_period_length").css('display','none');
    $("#filter_length").on('change', function(e){
        var value = $(this).find(':selected').val(); 
        $('select[name="table_period_length"]').val(value).trigger('change');
        data_table.ajax.reload();
    });
    $("#filter_status").on('change', function(e){ data_table.ajax.reload(); });
    $("#filter_search").on('input', function(e){ var ln = $(this).val().length; if(parseInt(ln) > 3){ data_table.ajax.reload(); }else if(parseInt(ln) < 1){ data_table.ajax.reload();} });

    $('input:radio[name="yearly_status"]').on('change', function(e){
        var v = $(this).val();
        $("input[name=contract_status][value!='"+v+"']").removeAttr('checked');
        $("input[name=contract_status][value='"+v+"'").attr('checked', 'checked');
        // if(v == 0){
        //     $("#group").val(0).trigger('change');
        //     $("#group").attr('disabled',true);                
        // }else{
        //     $("#group").removeAttr('disabled');                
        // }
    });    
    
    /* CRUD */
    $(document).on("click","#btn_new",function(e) {
        e.preventDefault();
        e.stopPropagation();
        formPeriodReset();
        $("#modal_period").modal('show');
    });
    $(document).on("click","#btn_close",function(e) {
        e.preventDefault();
        e.stopPropagation();
        $("#modal_period").modal('hide');
        formPeriodReset();
    });
    $(document).on("click","#btn_save", function(e) { // Done
        e.preventDefault();
        e.stopPropagation();
        let next = true;
        
        // if(next){
        //     if ($("#yearly_name").val().length === 0) {
        //         next = false;
        //         notif(0,'Name required');
        //     }
        // }   

        // if(next){
        //     if ($("#yearly_name").val().length === 0) {
        //         next = false;
        //         notif(0,'Name required');
        //     }
        // }    

        if(next){
            let form = new FormData($("#form_period")[0]);
            // form.append('_token','{{ csrf_token() }}');  
            // form.append('user_remember_token', '2');     
            form.append('action','create');            
            form.set('yearly_status',$("input[name=yearly_status]:checked").val());
            if(periodSession == ''){
            }else{              
                form.append('yearly_session',periodSession);
            }
            $.ajax({
                type: "post",
                url: url,
                data: form, 
                dataType: 'json', cache: 'false', 
                contentType: false, processData: false,   
                beforeSend:function(x){
                    x.setRequestHeader('Authorization',"Bearer " + bearer_token);
                    x.setRequestHeader('X-CSRF-TOKEN',csrf_token);
                },
                success:function(d){
                    let s = d.status;
                    let m = d.message;
                    let r = d.data;
                    if(parseInt(s) == 1){
                        notif(s,m);
                        if(periodSession == ''){
                            data_table.ajax.reload();
                        }else{              
                            data_table.ajax.reload(null,false);
                        }                        
                        periodSession = r.yearly_session;
                        $("#modal_period").modal('hide');
                    }else{
                        notif(s,m);
                    }
                },
                error:function(xhr,status,err){
                    notif(0,err);
                }
            });
        }   
    });
    $(document).on("click",".btn_edit", function (e) { // Done
        e.preventDefault();
        e.stopPropagation();
        let next = true;
        
        periodSession = $(this).attr('data-session');
        
        if(next){
            if (periodSession.length === 0) {
                next = false;
                notif(0,'Data tidak ada');
            }
        }

        if(next){
            let form = new FormData();
            form.append('action','read');
            form.append('yearly_session',periodSession);
            $.ajax({
                type: "post",
                url:url,
                data: form, 
                dataType: 'json', cache: 'false', 
                contentType: false, processData: false,   
                beforeSend:function(x){
                    x.setRequestHeader('Authorization',"Bearer " + bearer_token);
                    x.setRequestHeader('X-CSRF-TOKEN',csrf_token);
                },
                success:function(d){
                    let s = d.status;
                    let m = d.message;
                    let r = d.data;
                    if(parseInt(s) == 1){
                        notif(s,m);
                        $("#modal_period").modal('show');
                        periodSession = r.contract_session;
                        
                        //Contract
                        // $("#contract_school").append(''+'<option value="'+r.yearly_session+'">'+r.yearly_name+'</option>');
                        // $("#contract_school").val(r.yearly_session).trigger('change');
                        
                        // $("#contract_yearly_period").append(''+'<option value="'+r.contract_yearly_period+'">'+r.yearly_start+'/'+r.yearly_end+'</option>');
                        // $("#contract_yearly_period").val(r.contract_yearly_period).trigger('change');

                        // $("#contract_type").val(r.contract_type).trigger('change');
                        // $("#contract_number").val(r.contract_number);
                        // $("#contract_start_date").val(moment(r.contract_start_date).format("MMM YYYY"));
                        // $("#contract_end_date").val(moment(r.contract_end_date).format("MMM YYYY"));
                        // // $("#contract_status").val(r.contract_status);
                        // $('input[name=contract_status][value='+r.contract_status+']').prop("checked", true).change();   
                        // $("#contract_date_created").val(moment(r.contract_date_created).format("DD-MMM-YYYY, HH:mm")); 

                        // //School Info Readonly
                        // $("#yearly_name").val(r.yearly_name);
                        // $("#yearly_address").val(r.yearly_address);
                        // $("#yearly_state").val(r.state_name);
                        // $("#yearly_city").val(r.city_name);
                        // if(r.yearly_status == 1){
                        //     var yearly_status_name = 'Active';
                        // }else{
                        //     var yearly_status_name = 'Inactive';
                        // }
                        // $("#yearly_status").val(yearly_status_name);
                        // $('input[name=yearly_status][value='+r.yearly_status+']').prop("checked", true).change();   
                        // getSchoolInfo(r.yearly_session);
                    }else{
                        notif(s,m);
                        periodSession = '';
                    }
                },
                error:function(xhr,status,err){
                    notif(0,err);
                }
            });
        }   
    });
    $(document).on("click",".btn_delete",function(e) { // Done
        e.preventDefault();
        e.stopPropagation();
        let next = true;
        periodSession = $(this).attr('data-session');
        var periodName = $(this).attr('data-name');        

        let title   = 'Confirmation';
        let content = 'Are you sure to remove <b>'+periodName+'</b> ?';
        $.confirm({
            title: title,
            content: content,
            columnClass: 'col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1',
            // closeIcon: true, closeIconClass: 'fas fa-times',
            animation:'zoom', closeAnimation:'bottom', animateFromElement:false, useBootstrap:true,
            buttons: {
                button_1: {
                    text:'<i class="fas fa-trash"></i> Delete',
                    btnClass: 'btn-danger',
                    keys: ['enter'],
                    action: function(){
                        if(!periodSession){
                            next = false;
                            notif(0,'Data tidak valid');
                        }
                    
                        if(next){
                            let form = new FormData(); 
                            form.append('action','delete');
                            form.append('yearly_session',periodSession);
                            $.ajax({
                                type: "post",
                                url: url,
                                data: form, 
                                dataType: 'json', cache: 'false', 
                                contentType: false, processData: false,   
                                beforeSend:function(x){
                                    x.setRequestHeader('Authorization',"Bearer " + bearer_token);
                                    x.setRequestHeader('X-CSRF-TOKEN',csrf_token);
                                },
                                success:function(d){
                                    let s = d.status;
                                    let m = d.message;
                                    let r = d.result;
                                    if(parseInt(s) == 1){
                                        notif(s,m);
                                        data_table.ajax.reload(null,false);
                                    }else{
                                        notif(s,m);
                                    }
                                },
                                error:function(xhr,status,err){
                                    notif(0,err);
                                }
                            });
                        } 
                    }
                },
                button_2: {
                    text: '<i class="fas fa-times"></i> Close',
                    btnClass: 'btn-default',
                    keys: ['Escape'],
                    action: function(){
                        //Close
                    }
                }
            }
        });  
    });   
    function formPeriodReset(){
        periodSession = '';
        $("#form_period input")
        .not("input[name='yearly_status']").val('');
        $("input[name=yearly_status][value=1]").prop("checked", true).change();
        $("#form_period select").val(0).trigger('change');        
        // $("#menu_parent_id").html('<option value="0">Select</option>');      
    }
});
// $("#modal_period").modal('show');    
</script>