<script type="text/javascript">
$(document).ready(function() {  
    

    let url = '{{ url('/') }}/school/contract';
    let url_school = '{{ url('/') }}/school';    
    let url_api = '{{ url('/') }}/api/master/'; 
    let url_search = '{{ url('/') }}/search';    
    let csrf_token = $('meta[name="csrf-token"]').attr('content')
    
    let contractSession = '';  

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

    /** Detail data */
    function getData() {
        contractSession = userdata['user_contract'];
        let form = new FormData();
            form.append('action','read');
            form.append('school_session',contractSession);
            $.ajax({
                type: "get",
                url: url_api + contractSession+ '/school-data',
                // url:url,
                // data: form, 
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
                        // data_table.ajax.reload();
                        // $("#modal_contract").modal('show');
                        contractSession = r.school_session;
                        $("#school_session").val(r.school_session);      
                        $("#school_name").val(r.school_name);      
                        $("#school_address").val(r.school_address);
                        $('input[name=school_status][value='+r.school_status+']').prop("checked", true).change();   
                    }else{
                        notif(s,m);
                        contractSession = '';
                    }
                },
                error:function(xhr,status,err){
                    notif(0,err);
                }
            });
    }
    // getData();
    /** End of Detail data */
    //Select2
    $('#filter_period').select2({
        placeholder: {
            id: 'ALL',
            text: 'All'
        },
        allowClear: true,
        ajax: {
            type: "post",
            url: url_search,
            dataType: 'json',
            delay: 250,
             beforeSend:function(x){
                x.setRequestHeader('Authorization',"Bearer " + bearer_token);
                x.setRequestHeader('X-CSRF-TOKEN',csrf_token);
            },
            data: function (params) {
                var query = {
                    search: params.term,
                    action: 'yearly_period'
                };
                return query;
            },
            processResults: function (data){
                var datas = [];
                $.each(data, function(key, val){
                    datas.push({
                        'id' : val.session,
                        'text' : val.text
                    });
                });
                return {
                    results: datas
                };
            },
            cache: true
        },
        escapeMarkup: function(markup){ 
            return markup; 
        },
        templateResult: function(datas){ //When Select on Click
            if (datas.id) { return datas.text; }
        },
        templateSelection: function(datas) { //When Option on Click
            if (datas.id) { return datas.text; }
        }
    }); 
    $('#filter_city').select2({
        placeholder: {
            id: 'ALL',
            text: 'All'
        },
        allowClear: true,
        ajax: {
            type: "post",
            url: url_search,
            dataType: 'json',
            delay: 250,
             beforeSend:function(x){
                x.setRequestHeader('Authorization',"Bearer " + bearer_token);
                x.setRequestHeader('X-CSRF-TOKEN',csrf_token);
            },
            data: function (params) {
                var query = {
                    search: params.term,
                    action: 'cities'
                };
                return query;
            },
            processResults: function (data){
                var datas = [];
                $.each(data, function(key, val){
                    datas.push({
                        'id' : val.session,
                        'text' : val.text
                    });
                });
                return {
                    results: datas
                };
            },
            cache: true
        },
        escapeMarkup: function(markup){ 
            return markup; 
        },
        templateResult: function(datas){ //When Select on Click
            if (datas.id) { return datas.text; }
        },
        templateSelection: function(datas) { //When Option on Click
            if (datas.id) { return datas.text; }
        }
    });     
    $('#contract_yearly_period').select2({
        dropdownParent:$("#modal_contract"), //If Select2 Inside Modal, $(".jconfirm-box-container") if jConfirm
        //placeholder: '<i class="fas fa-search"></i> Search',
        //width:'100%',
        placeholder: {
            id: '0',
            text: '-- Select --'
        },
        allowClear: true,
        ajax: {
            type: "post",
            url: url_search,
            dataType: 'json',
            delay: 250,
             beforeSend:function(x){
                x.setRequestHeader('Authorization',"Bearer " + bearer_token);
                x.setRequestHeader('X-CSRF-TOKEN',csrf_token);
            },
            data: function (params) {
                var query = {
                    search: params.term,
                    action: 'yearly_period'
                };
                return query;
            },
            processResults: function (data){
                var datas = [];
                $.each(data, function(key, val){
                    datas.push({
                        'id' : val.session,
                        'text' : val.text,
                        'period_start':val.period_start,
                        'period_end':val.period_end
                    });
                });
                return {
                    results: datas
                };
            },
            cache: true
        },
        escapeMarkup: function(markup){ 
            return markup; 
        },
        templateResult: function(datas){ //When Select on Click
            if (datas.id) { return datas.text; }
        },
        templateSelection: function(datas) { //When Option on Click
            if (datas.id) {
                //$(datas.element).attr('data-column', datas.column);      
                $("#contract_start_date").val(moment(datas.period_start).format("MMM YYYY"));     
                $("#contract_end_date").val(moment(datas.period_end).format("MMM YYYY"));                                         
                return datas.text; 
            }

        }
    }); 
    $('#contract_school').select2({
        dropdownParent:$("#modal_contract"), //If Select2 Inside Modal, $(".jconfirm-box-container") if jConfirm
        //placeholder: '<i class="fas fa-search"></i> Search',
        //width:'100%',
        // tags:true,
        minimumInputLength: 0,
        placeholder: {
            id: '0',
            text: '-- Select --'
        },
        allowClear: true,
        ajax: {
            type: "post",
            url: url_search,
            dataType: 'json',
            delay: 250,
             beforeSend:function(x){
                x.setRequestHeader('Authorization',"Bearer " + bearer_token);
                x.setRequestHeader('X-CSRF-TOKEN',csrf_token);
            },
            data: function (params) {
                var query = {
                    search: params.term,
                    action: 'school'
                };
                return query;
            },
            processResults: function (data){
                var datas = [];
                $.each(data, function(key, val){
                    datas.push({
                        'id' : val.session,
                        'text' : val.text
                    });
                });
                return {
                    results: datas
                };
            },
            cache: true
        },
        escapeMarkup: function(markup){ 
            return markup; 
        },
        templateResult: function(datas){ //When Select on Click
            if (datas.id) { return datas.text; }
        },
        templateSelection: function(datas) { //When Option on Click
            if (datas.id) { return datas.text; }
        }
    });     
    $(document).on("change","#contract_school",function(e) {
        var school_session = $(this).find(':selected').val();
        console.log('school_session => '+school_session.length);        
        if((school_session.length > 1) && (contractSession.length < 20)){ //Only NEW Form
            getSchoolInfo(school_session);
            // console.log('contractSession => '+contractSession.length);
        }
    });
    
    //Datatable
    let data_table = $("#table_contract").DataTable({
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
                d.filter_period = $("#filter_period").find(':selected').val();                                
                d.filter_city = $("#filter_city").find(':selected').val();                                                
            },
            dataSrc: function(data) {
                return data.result;
            }
        },
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
        "columnDefs": [
            {"targets":0, "width":"30%", "title":"Contract", "searchable":true, "orderable":true},      
            {"targets":1, "width":"30%", "title":"Period", "searchable":true, "orderable":true},   
            {"targets":2, "width":"30%", "title":"School", "searchable":true, "orderable":true},            
            {"targets":3, "width":"20%", "title":"Address", "searchable":true, "orderable":true, "className":"dt-body-left"},
            {"targets":4, "width":"20%", "title":"City", "searchable":true, "orderable":true},            
            {"targets":5, "width":"30%", "title":"State", "searchable":true, "orderable":true},
            {"targets":6, "width":"30%", "title":"Contract Status", "searchable":true, "orderable":true},            
            {"targets":7, "width":"20%", "title":"Action", "searchable":true, "orderable":true},                      
        ],
        "order": [[0, 'ASC']],
        "columns": [{
                'data': 'contract_number',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    return data;
                }
            },{
                'data': 'contract_yearly_period',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    return row.yearly_start+'/'+row.yearly_end;
                }
            },{
                'data': 'school_name',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    return data;
                }
            },{
                'data': 'school_address',
                className: 'text-right',
                render: function(data, meta, row) {
                    var dsp = '';
                    return data;
                }
            },{
                'data': 'city_name',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    dsp += data;
                    return dsp;
                }
            },{
                'data': 'state_name',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    dsp += data;
                    return dsp;
                }
            },{
                'data': 'contract_status',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    if(row.contract_status == 0){
                        dsp += '<span class="badge bg-warning-subtle text-warning">Inactive</span>';
                    }else if(row.contract_status == 1){
                        dsp += '<span class="badge bg-success-subtle text-success">Active</span>';
                    }else if(row.contract_status == 2){
                        dsp += '<span class="badge bg-info-subtle text-info">Ended</span>';
                    }else if(row.contract_status == 4){
                        dsp += '<span class="badge bg-danger-subtle text-danger">Archieve</span>';
                    }
                    return dsp;
                }
            },{
                'data': 'school_id',
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
                                <a href="#" class="dropdown-item btn_edit" data-id="${data}" data-session="${row.contract_session}" data-name="${row.contract_number}">
                                    <i class="ri-eye-fill align-bottom me-2 text-muted"></i> View
                                </a>
                            </li>`;
                        if(data < 4){
                        dsp +=  `<li>
                                    <a href="#" class="dropdown-item remove-item-btn btn_delete" data-id="${data}" data-session="${row.contract_session}" data-name="${row.contract_number}" style="cursor:pointer">
                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                    </a>
                                </li>`;
                        }
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
    $("#table_contract_filter").css('display','none');
    $("#table_contract_length").css('display','none');
    $("#filter_length").on('change', function(e){
        var value = $(this).find(':selected').val(); 
        $('select[name="table_contract_length"]').val(value).trigger('change');
        data_table.ajax.reload();
    });
    $("#filter_city, #filter_status, #filter_period").on('change', function(e){ data_table.ajax.reload(); });
    $("#filter_search").on('input', function(e){ var ln = $(this).val().length; if(parseInt(ln) > 3){ data_table.ajax.reload(); }else if(parseInt(ln) < 1){ data_table.ajax.reload();} });

    $('input:radio[name="contract_status"]').on('change', function(e){
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
        formContractReset();
        $("#modal_contract").modal('show');
    });
    $(document).on("click","#btn_close",function(e) {
        e.preventDefault();
        e.stopPropagation();
        $("#modal_contract").modal('hide');
        formContractReset();
    });
    $(document).on("click","#btn_save", function(e) { // Done
        e.preventDefault();
        e.stopPropagation();
        let next = true;
        
        // if(next){
        //     if ($("#school_name").val().length === 0) {
        //         next = false;
        //         notif(0,'Name required');
        //     }
        // }   

        // if(next){
        //     if ($("#school_address").val().length === 0) {
        //         next = false;
        //         notif(0,'Link required');
        //     }
        // }    

        if(next){
            let form = new FormData($("#form_contract")[0]);
            // form.append('_token','{{ csrf_token() }}');  
            // form.append('user_remember_token', '2');     
            form.append('action','create');
            // form.append('school_name',$("#school_name").val());
            // form.append('school_address',$("#school_address").val());
            // form.append('school_status',$("input[name=school_status]:checked").val());

            // form.append('action', 'create');
            // form.append('contract_school', $('#contract_school').val());
            // form.append('contract_yearly_period', $('#contract_yearly_period').val());
            // form.append('contract_type', $('#contract_type').val());
            // form.append('contract_number', $('#contract_number').val());
            // form.append('contract_start_date', $('#contract_start_date').val());
            // form.append('contract_end_date', $('#contract_end_date').val());
            // form.append('contract_status', $('#contract_status').val());
            // form.append('contract_date_created', $('#contract_date_created').val());            
            form.set('contract_status',$("input[name=contract_status]:checked").val());
            if(contractSession == ''){
                // var set_url = url_api + 'school-create';
            }else{              
                form.append('school_session',contractSession);
                // var set_url = url_api + contractSession + '/school-update';
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
                        if(contractSession == ''){
                            data_table.ajax.reload();
                        }else{              
                            data_table.ajax.reload(null,false);
                        }                        
                        contractSession = r.school_session;
                        $("#modal_contract").modal('hide');
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
        
        contractSession = $(this).attr('data-session');
        
        if(next){
            if (contractSession.length === 0) {
                next = false;
                notif(0,'Data tidak ada');
            }
        }

        if(next){
            let form = new FormData();
            form.append('action','read');
            form.append('contract_session',contractSession);
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
                        $("#modal_contract").modal('show');
                        contractSession = r.contract_session;
                        
                        //Contract
                        $("#contract_school").append(''+'<option value="'+r.school_session+'">'+r.school_name+'</option>');
                        $("#contract_school").val(r.school_session).trigger('change');
                        
                        $("#contract_yearly_period").append(''+'<option value="'+r.contract_yearly_period+'">'+r.yearly_start+'/'+r.yearly_end+'</option>');
                        $("#contract_yearly_period").val(r.contract_yearly_period).trigger('change');

                        $("#contract_type").val(r.contract_type).trigger('change');
                        $("#contract_number").val(r.contract_number);
                        $("#contract_start_date").val(moment(r.contract_start_date).format("MMM YYYY"));
                        $("#contract_end_date").val(moment(r.contract_end_date).format("MMM YYYY"));
                        // $("#contract_status").val(r.contract_status);
                        $('input[name=contract_status][value='+r.contract_status+']').prop("checked", true).change();   
                        $("#contract_date_created").val(moment(r.contract_date_created).format("DD-MMM-YYYY, HH:mm")); 

                        //School Info Readonly
                        $("#school_name").val(r.school_name);
                        $("#school_address").val(r.school_address);
                        $("#school_state").val(r.state_name);
                        $("#school_city").val(r.city_name);
                        if(r.school_status == 1){
                            var school_status_name = 'Active';
                        }else{
                            var school_status_name = 'Inactive';
                        }
                        $("#school_status").val(school_status_name);
                        // $('input[name=school_status][value='+r.school_status+']').prop("checked", true).change();   
                        // getSchoolInfo(r.school_session);
                    }else{
                        notif(s,m);
                        contractSession = '';
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
        contractSession = $(this).attr('data-session');
        var schoolName = $(this).attr('data-name');        

        let title   = 'Confirmation';
        let content = 'Are you sure to remove <b>'+schoolName+'</b> ?';
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
                        if(!contractSession){
                            next = false;
                            notif(0,'Data tidak valid');
                        }
                    
                        if(next){
                            let form = new FormData(); 
                            form.append('action','delete');
                            form.append('contract_session',contractSession);
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
    function formContractReset(){
        contractSession = '';
        $("#form_contract input")
        .not("input[name='contract_status']").val('');
        $("input[name=contract_status][value=1]").prop("checked", true).change();
        $("#form_contract select").val(0).trigger('change');        
        // $("#menu_parent_id").html('<option value="0">Select</option>');      
    }
    function getSchoolInfo(school){
        let form = new FormData();
        form.append('action', 'read');
        form.append('school_session',school);
        $.ajax({
            type: "post",
            url: url_school,
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
                    /* hint zz_for or zz_each */
                    $("#school_name").val(r.school_name);
                    $("#school_address").val(r.school_address);
                    $("#school_state").val(r.state_name);
                    $("#school_city").val(r.city_name);
                    if(r.school_status == 1){
                        var school_status_name = 'Active';
                    }else{
                        var school_status_name = 'Inactive';
                    }
                    $("#school_status").val(school_status_name);
                }else{
                    notif(s,m);
                }
            },
            error:function(xhr,status,err){
                notif(0,err);
            }
        });
    }
    // getSchoolInfo("ZYLRR0QMN4AV997Z22RE");
});
// $("#modal_contract").modal('show');    
</script>