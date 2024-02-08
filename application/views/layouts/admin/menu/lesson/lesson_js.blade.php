<script type="text/javascript">
$(document).ready(function() {
    let url = '{{ url('/') }}/lesson';
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
    let lessonSession = '';

    /* Select2 */
    $('#lesson_yearly_period').select2({
        dropdownParent:$("#modal_lesson"), //If Select2 Inside Modal, $(".jconfirm-box-container") if jConfirm
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
    $('#lesson_grade').select2({
        dropdownParent:$("#modal_lesson"), //If Select2 Inside Modal, $(".jconfirm-box-container") if jConfirm
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
    $('#lesson_grade_department').select2({
        dropdownParent:$("#modal_lesson"), //If Select2 Inside Modal, $(".jconfirm-box-container") if jConfirm
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
                    grade: $("#lesson_grade").find(":selected").val(),
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

    //Datatable
    let data_table = $("#table_lesson").DataTable({
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
            {"targets":0, "width":"30%", "title":"Lesson", "searchable":true, "orderable":true},  
            {"targets":1, "width":"10%", "title":"Grade", "searchable":true, "orderable":true},         
            {"targets":2, "width":"20%", "title":"Status", "searchable":true, "orderable":true, "className":"dt-body-left"},            
            {"targets":3, "width":"30%", "title":"Action", "searchable":true, "orderable":true},                  
        ],
        "order": [[0, 'ASC']],
        "columns": [{
                'data': 'lesson_name',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    return data;
                }
            },{
                'data': 'grade_name',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    return data;
                }
            },{
                'data': 'lesson_status',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    if(row.lesson_status == 0){
                        dsp += '<span class="badge bg-warning-subtle text-warning">Inactive</span>';
                    }else if(row.lesson_status == 1){
                        dsp += '<span class="badge bg-success-subtle text-success">Active</span>';
                    }else if(row.lesson_status == 4){
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
                                <a href="#" class="dropdown-item btn_edit" data-id="${data}" data-session="${row.lesson_session}" data-name="${row.lesson_name}">
                                    <i class="ri-eye-fill align-bottom me-2 text-muted"></i> View
                                </a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item remove-item-btn btn_delete" data-id="${data}" data-session="${row.lesson_session}" data-name="${row.lesson_name}" style="cursor:pointer">
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
    // $("#table_lesson_filter").css('display','none');
    // $("#table_lesson_length").css('display','none');
    $("#filter_length").on('change', function(e){
        var value = $(this).find(':selected').val(); 
        $('select[name="table_lesson_length"]').val(value).trigger('change');
        data_table.ajax.reload();
    });
    $("#filter_flag").on('change', function(e){ data_table.ajax.reload(); });
    $("#filter_search").on('input', function(e){ var ln = $(this).val().length; if(parseInt(ln) > 3){ data_table.ajax.reload(); }else if(parseInt(ln) < 1){ data_table.ajax.reload();} });

    /* CRUD */
    $(document).on("click","#btn_new",function(e) {
        e.preventDefault();
        e.stopPropagation();
        formLessonReset();
        $("#modal_lesson").modal('show');
    });
    $(document).on("click","#btn_close",function(e) {
        e.preventDefault();
        e.stopPropagation();
        formLessonReset();
        $("#modal_lesson").modal('hide');
    });    
    $(document).on("click","#btn_save", function(e) { // Done
        e.preventDefault();
        e.stopPropagation();
        let next = true;
        

        if(next){
            if ($("#lesson_name").val().length == 0) {
                next = false;
                notif(0,'Lesson Name required');
            }
        }        

        if(next){
            if ($("#lesson_grade").find(":selected").val() == 0) {
                next = false;
                notif(0,'Grade required');
            }
        }  

        if(next){
            let form = new FormData($("#form_lesson")[0]);
            // form.append('_token','{{ csrf_token() }}');  
            // form.append('user_remember_token', '2');     
            form.append('action','create');
            form.set('lesson_status',$("input[name=lesson_status]:checked").val());
            // form.append('user_remember_token',8);
            if(lessonSession == ''){
                // var set_url = url_api + 'detail-create';
            }else{              
                form.append('lesson_session',lessonSession);
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
                        if(lessonSession == ''){
                            data_table.ajax.reload();
                        }else{              
                            data_table.ajax.reload(null,false);
                        }                        
                        lessonSession = r.lesson_session;
                        $("#modal_lesson").modal('hide');
                        formLessonReset();
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
        
        lessonSession = $(this).attr('data-session');
        
        if(next){
            if (lessonSession.length === 0) {
                next = false;
                notif(0,'Data tidak ada');
            }
        }

        if(next){
            let form = new FormData();
            form.append('action','read');
            form.append('lesson_session',lessonSession);
            $.ajax({
                type: "post",
                // url: url_api + lessonSession+ '/user-data',
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
                        formLessonReset();
                        $("#modal_lesson").modal('show');
                        lessonSession = r.lesson_session;
                        
                        $("input[name='lesson_name']").val(r.lesson_name);
                        $("input[name='lesson_status'][value='"+r.lesson_status+"']").prop("checked", true).change();
                        if(r.lesson_grade){
                            $("select[id='lesson_grade']").append(''+'<option value="'+r.lesson_grade+'">'+r.grade_name+'</option>');
                            $("#lesson_grade").val(r.lesson_grade).trigger('change');
                        }
                        if(r.lesson_department){
                            $("select[id='lesson_grade_department']").append(''+'<option value="'+r.lesson_grade_department+'">'+r.department_name+'</option>');
                            $("#lesson_grade_department").val(r.lesson_grade_department).trigger('change');
                        }                                                
                    }else{
                        notif(s,m);
                        lessonSession = '';
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
        lessonSession = $(this).attr('data-session');
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
                        if(!lessonSession){
                            next = false;
                            notif(0,'Data tidak valid');
                        }
                    
                        if(next){
                            let form = new FormData(); 
                            form.append('action','delete');
                            form.append('lesson_session',lessonSession);
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
    function formLessonReset(){
        lessonSession = '';
        $("#form_lesson input")
        .not("input[name='lesson_status']").val('');
        $("input[name=lesson_status][value=1]").prop("checked",true).change();
        $("#form_lesson select").val(0).trigger('change');    
        // $("#files_preview").attr('src',url_image);    
        // $("#menu_parent_id").html('<option value="0">Select</option>');      
    }        
});
</script>