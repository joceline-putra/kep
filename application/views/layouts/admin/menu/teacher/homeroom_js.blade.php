<script type="text/javascript">
$(document).ready(function() {
    let url = '{{ url('/') }}/teacher/homeroom';
    let url_api = '{{ url('/') }}/api/master/'; 
    let url_search = '{{ url('/') }}/search';     
    let csrf_token = $('meta[name="csrf-token"]').attr('content');

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
    let detailSession = '';

    /* Select2 */
    $('#detail_yearly_period').select2({
        dropdownParent:$("#modal_homeroom"), //If Select2 Inside Modal, $(".jconfirm-box-container") if jConfirm
        //placeholder: '<i class="fas fa-search"></i> Search',
        //width:'100%',
        // tags:true,
        // minimumInputLength: 0,
        placeholder: {
            id: '0',
            text: 'Select'
        },
        allowClear: true,
        // minimumResultsForSearch: Infinity,
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
            //if (!datas.id) { return datas.text; }
            // if($.isNumeric(datas.id) == true){
            //     // return '<i class="fas fa-user-check '+datas.id.toLowerCase()+'"></i> '+datas.text;
                return datas.text;
            // }
        },
        templateSelection: function(datas) { //When Option on Click
            //if (!datas.id) { return datas.text; }
            //Custom Data Attribute
            //$(datas.element).attr('data-column', datas.column);        
            //return '<i class="fas fa-user-check '+datas.id.toLowerCase()+'"></i> '+datas.text;
            // if($.isNumeric(datas.id) == true){
            //     // return '<i class="fas fa-user-check '+datas.id.toLowerCase()+'"></i> '+datas.text;
                return datas.text;
            // }
        }
    }); 
    $('#detail_teacher').select2({
        dropdownParent:$("#modal_homeroom"), //If Select2 Inside Modal, $(".jconfirm-box-container") if jConfirm
        //placeholder: '<i class="fas fa-search"></i> Search',
        //width:'100%',
        // tags:true,
        // minimumInputLength: 0,
        placeholder: {
            id: '0',
            text: 'Select'
        },
        allowClear: true,
        // minimumResultsForSearch: Infinity,
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
                    action: 'teacher'
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
            //if (!datas.id) { return datas.text; }
            // if($.isNumeric(datas.id) == true){
            //     // return '<i class="fas fa-user-check '+datas.id.toLowerCase()+'"></i> '+datas.text;
                return datas.text;
            // }
        },
        templateSelection: function(datas) { //When Option on Click
            //if (!datas.id) { return datas.text; }
            //Custom Data Attribute
            //$(datas.element).attr('data-column', datas.column);        
            //return '<i class="fas fa-user-check '+datas.id.toLowerCase()+'"></i> '+datas.text;
            // if($.isNumeric(datas.id) == true){
            //     // return '<i class="fas fa-user-check '+datas.id.toLowerCase()+'"></i> '+datas.text;
                return datas.text;
            // }
        }
    }); 
    $('#grade').select2({
        dropdownParent:$("#modal_homeroom"), //If Select2 Inside Modal, $(".jconfirm-box-container") if jConfirm
        //placeholder: '<i class="fas fa-search"></i> Search',
        //width:'100%',
        // tags:true,
        // minimumInputLength: 0,
        placeholder: {
            id: '0',
            text: 'Select'
        },
        allowClear: true,
        // minimumResultsForSearch: Infinity,
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
                    action: 'grade'
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
            //if (!datas.id) { return datas.text; }
            // if($.isNumeric(datas.id) == true){
            //     // return '<i class="fas fa-user-check '+datas.id.toLowerCase()+'"></i> '+datas.text;
                return datas.text;
            // }
        },
        templateSelection: function(datas) { //When Option on Click
            //if (!datas.id) { return datas.text; }
            //Custom Data Attribute
            //$(datas.element).attr('data-column', datas.column);        
            //return '<i class="fas fa-user-check '+datas.id.toLowerCase()+'"></i> '+datas.text;
            // if($.isNumeric(datas.id) == true){
            //     // return '<i class="fas fa-user-check '+datas.id.toLowerCase()+'"></i> '+datas.text;
                return datas.text;
            // }
        }
    });
    $('#grade_department').select2({
        dropdownParent:$("#modal_homeroom"), //If Select2 Inside Modal, $(".jconfirm-box-container") if jConfirm
        //placeholder: '<i class="fas fa-search"></i> Search',
        //width:'100%',
        // tags:true,
        // minimumInputLength: 0,
        placeholder: {
            id: '0',
            text: 'Select'
        },
        allowClear: true,
        // minimumResultsForSearch: Infinity,
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
                    grade: $("#grade").find(":selected").val(),
                    action: 'grade_department'
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
            //if (!datas.id) { return datas.text; }
            // if($.isNumeric(datas.id) == true){
            //     // return '<i class="fas fa-user-check '+datas.id.toLowerCase()+'"></i> '+datas.text;
                return datas.text;
            // }
        },
        templateSelection: function(datas) { //When Option on Click
            //if (!datas.id) { return datas.text; }
            //Custom Data Attribute
            //$(datas.element).attr('data-column', datas.column);        
            //return '<i class="fas fa-user-check '+datas.id.toLowerCase()+'"></i> '+datas.text;
            // if($.isNumeric(datas.id) == true){
            //     // return '<i class="fas fa-user-check '+datas.id.toLowerCase()+'"></i> '+datas.text;
                return datas.text;
            // }
        }
    });         
    $('#detail_grade_sub').select2({
        dropdownParent:$("#modal_homeroom"), //If Select2 Inside Modal, $(".jconfirm-box-container") if jConfirm
        //placeholder: '<i class="fas fa-search"></i> Search',
        //width:'100%',
        // tags:true,
        // minimumInputLength: 0,
        placeholder: {
            id: '0',
            text: 'Select'
        },
        allowClear: true,
        // minimumResultsForSearch: Infinity,
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
                    grade: $("#grade").find(":selected").val(),
                    grade_department: $("#grade_department").find(":selected").val(),
                    action: 'grade_sub'
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
            //if (!datas.id) { return datas.text; }
            // if($.isNumeric(datas.id) == true){
            //     // return '<i class="fas fa-user-check '+datas.id.toLowerCase()+'"></i> '+datas.text;
                return datas.text;
            // }
        },
        templateSelection: function(datas) { //When Option on Click
            //if (!datas.id) { return datas.text; }
            //Custom Data Attribute
            //$(datas.element).attr('data-column', datas.column);        
            //return '<i class="fas fa-user-check '+datas.id.toLowerCase()+'"></i> '+datas.text;
            // if($.isNumeric(datas.id) == true){
            //     // return '<i class="fas fa-user-check '+datas.id.toLowerCase()+'"></i> '+datas.text;
                return datas.text;
            // }
        }
    });           

    //Datatable
    let data_table = $("#table_homeroom").DataTable({
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
                // d.length = $("#filter_length").find(':selected').val();
                // d.date_start = $("#filter_start_date").val();
                // d.date_end = $("#filter_end_date").val();
                // d.search = {value:$("#filter_search").val()};
            },
            dataSrc: function(data) {
                return data.result;
            }
        },
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
        "columnDefs": [
            {"targets":0, "width":"30%", "title":"Grade", "searchable":true, "orderable":true},  
            {"targets":1, "width":"10%", "title":"Department", "searchable":true, "orderable":true},
            {"targets":2, "width":"10%", "title":"Sub", "searchable":true, "orderable":true},                                    
            {"targets":3, "width":"20%", "title":"Teacher", "searchable":true, "orderable":true},
            {"targets":4, "width":"20%", "title":"Period", "searchable":true, "orderable":true},            
            {"targets":5, "width":"20%", "title":"Status", "searchable":true, "orderable":true, "className":"dt-body-left"},            
            {"targets":6, "width":"30%", "title":"Action", "searchable":true, "orderable":true},                  
        ],
        "order": [[0, 'ASC']],
        "columns": [{
                'data': 'grade_name',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    return data;
                }
            },{
                'data': 'department_name',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    return data;
                }
            },{
                'data': 'sub_name',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    return data;
                }
            },{
                'data': 'user_fullname',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    dsp += data;
                    return dsp;
                }
            },{
                'data': 'detail_yearly_period',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    dsp += row.yearly_start + '/' + row.yearly_end;
                    return dsp;
                }
            },{
                'data': 'grade_status',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    if(row.grade_status == 0){
                        dsp += '<span class="badge bg-warning-subtle text-warning">Inactive</span>';
                    }else if(row.grade_status == 1){
                        dsp += '<span class="badge bg-success-subtle text-success">Active</span>';
                    }else if(row.grade_status == 4){
                        dsp += '<span class="badge bg-danger-subtle text-danger">Deleted</span>';
                    }
                    return dsp;
                }
            },{
                'data': 'grade_id',
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
                                <a href="#" class="dropdown-item btn_edit" data-id="${data}" data-session="${row.detail_session}" data-name="${row.grade_name}">
                                    <i class="ri-eye-fill align-bottom me-2 text-muted"></i> View
                                </a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item remove-item-btn btn_delete" data-id="${data}" data-session="${row.detail_session}" data-name="${row.grade_name}" style="cursor:pointer">
                                    <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                </a>
                            </li>
                        </ul>
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
    $("#table_homeroom_filter").css('display','none');
    $("#table_homeroom_length").css('display','none');
    $("#filter_length").on('change', function(e){
        var value = $(this).find(':selected').val(); 
        $('select[name="table_homeroom_length"]').val(value).trigger('change');
        data_table.ajax.reload();
    });
    $("#filter_flag").on('change', function(e){ data_table.ajax.reload(); });
    $("#filter_search").on('input', function(e){ var ln = $(this).val().length; if(parseInt(ln) > 3){ data_table.ajax.reload(); }else if(parseInt(ln) < 1){ data_table.ajax.reload();} });

    /* CRUD */
    $(document).on("click","#btn_new",function(e) {
        e.preventDefault();
        e.stopPropagation();
        formHomeReset();
        $("#modal_homeroom").modal('show');
    });
    $(document).on("click","#btn_close",function(e) {
        e.preventDefault();
        e.stopPropagation();
        formHomeReset();
        $("#modal_homeroom").modal('hide');
    });    
    $(document).on("click","#btn_save", function(e) { // Done
        e.preventDefault();
        e.stopPropagation();
        let next = true;
        
        if(next){
            if ($("#detail_yearly_period").find(":selected").val() == 0) {
                next = false;
                notif(0,'Period required');
            }
        }   

        if(next){
            if ($("#detail_grade_sub").find(":selected").val() == 0) {
                next = false;
                notif(0,'Sub required');
            }
        }    

        if(next){
            if ($("#detail_teacher").find(":selected").val() == 0) {
                next = false;
                notif(0,'Teacher required');
            }
        }            

        if(next){
            let form = new FormData($("#form_homeroom")[0]);
            // form.append('_token','{{ csrf_token() }}');  
            // form.append('user_remember_token', '2');     
            form.append('action','create');
            form.set('detail_status',$("input[name=detail_status]:checked").val());
            // form.append('user_remember_token',8);
            if(detailSession == ''){
                // var set_url = url_api + 'detail-create';
            }else{              
                form.append('detail_session',detailSession);
                // var set_url = url_api + 'detail-update';
            }
            $.ajax({
                type: "post",
                // url: set_url,
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
                        if(detailSession == ''){
                            data_table.ajax.reload();
                        }else{              
                            data_table.ajax.reload(null,false);
                        }                        
                        detailSession = r.detail_session;
                        $("#modal_homeroom").modal('hide');
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
        
        detailSession = $(this).attr('data-session');
        
        if(next){
            if (detailSession.length === 0) {
                next = false;
                notif(0,'Data tidak ada');
            }
        }

        if(next){
            let form = new FormData();
            form.append('action','read');
            form.append('detail_session',detailSession);
            $.ajax({
                type: "post",
                // url: url_api + detailSession+ '/user-data',
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
                        formHomeReset();
                        $("#modal_homeroom").modal('show');
                        detailSession = r.detail_session;

                        $("input[name='detail_status'][value='"+r.detail_status+"']").prop("checked", true).change();
                        if(r.detail_yearly_period){
                            $("select[id='detail_yearly_period']").append(''+'<option value="'+r.detail_yearly_period+'">'+r.yearly_start+'/'+r.yearly_end+'</option>');
                            $("#detail_yearly_period").val(r.detail_yearly_period).trigger('change');
                        }
                        if((r.detail_grade_sub) && r.detail_grade_sub.length > 10){
                            $("select[id='detail_grade_sub']").append(''+'<option value="'+r.detail_grade_sub+'">'+r.sub_name+'</option>');
                            $("#detail_grade_sub").val(r.detail_grade_sub).trigger('change');
                        }
                        if((r.detail_teacher) && r.detail_teacher.length > 10){
                            $("select[id='detail_teacher']").append(''+'<option value="'+r.detail_teacher+'">'+r.user_fullname+'</option>');
                            $("#detail_teacher").val(r.detail_teacher).trigger('change');
                        }

                        if((r.grade_session) && r.grade_session.length > 10){
                            $("select[id='detail_grade']").append(''+'<option value="'+r.grade_session+'">'+r.grade_name+'</option>');
                            $("#detail_grade").val(r.grade_session).trigger('change');
                        }  
                        if((r.department_session) && r.department_session.length > 10){
                            $("select[id='detail_grade_department']").append(''+'<option value="'+r.department_session+'">'+r.department_name+'</option>');
                            $("#detail_grade_department").val(r.department_session).trigger('change');
                        }                                                
                    }else{
                        notif(s,m);
                        detailSession = '';
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
        detailSession = $(this).attr('data-session');
        var detailName = $(this).attr('data-name');        

        let title   = 'Confirmation';
        let content = 'Are you sure to remove <b>'+detailName+'</b> ?';
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
                        if(!detailSession){
                            next = false;
                            notif(0,'Data tidak valid');
                        }
                    
                        if(next){
                            let form = new FormData(); 
                            form.append('action','delete');
                            form.append('detail_session',detailSession);
                            // var set_url = url_api + 'user-delete';
                            $.ajax({
                                type: "post",
                                // url: set_url,
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
    function formHomeReset(){
        detailSession = '';
        $("#form_homeroom input")
        .not("input[name='user_gender']")
        .not("input[name='user_status']").val('');
        $("input[name=detail_status][value=1]").prop("checked",true).change();
        $("#form_homeroom select").val(0).trigger('change');    
        // $("#files_preview").attr('src',url_image);    
        // $("#menu_parent_id").html('<option value="0">Select</option>');      
    }        
});
</script>