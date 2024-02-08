<script type="text/javascript">
$(document).ready(function() {  
    let url = '{{ url('/') }}/school/grades';
    let url_api = '{{ url('/') }}/api/master/';
    let url_search = '{{ url('/') }}/search';    
    let csrf_token = $('meta[name="csrf-token"]').attr('content')
    
    let gradeSession = '';    
    let schoolSession = ''; 

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
    let data_table = $("#table_grade").DataTable({
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
            {"targets":1, "width":"20%", "title":"School", "searchable":true, "orderable":true},
            {"targets":2, "width":"20%", "title":"Status", "searchable":true, "orderable":true, "className":"dt-body-left"},            
            {"targets":3, "width":"30%", "title":"Action", "searchable":true, "orderable":true},                  
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
                'data': 'shool_name',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    // if(row.menu_icon != undefined){
                    //     dsp += '<i class="'+row.menu_icon+' align-bottom me-2 text-muted"></i>';
                    // }
                    dsp += row.school_name;
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
                                <a href="#" class="dropdown-item btn_edit" data-id="${data}" data-session="${row.grade_session}" data-name="${row.grade_name}">
                                    <i class="ri-eye-fill align-bottom me-2 text-muted"></i> View
                                </a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item remove-item-btn btn_delete" data-id="${data}" data-session="${row.grade_session}" data-name="${row.grade_name}" style="cursor:pointer">
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
    $("#table_grade_filter").css('display','none');
    $("#table_grade_length").css('display','none');
    $("#filter_length").on('change', function(e){
        var value = $(this).find(':selected').val(); 
        $('select[name="table_grade_length"]').val(value).trigger('change');
        user_table.ajax.reload();
    });
    $("#filter_flag").on('change', function(e){ data_table.ajax.reload(); });
    $("#filter_search").on('input', function(e){ var ln = $(this).val().length; if(parseInt(ln) > 3){ data_table.ajax.reload(); }else if(parseInt(ln) < 1){ data_table.ajax.reload();} });

    /* Select2 */
    // $('#grade_school').select2({
    //     dropdownParent:$("#modal_grade"), //If Select2 Inside Modal, $(".jconfirm-box-container") if jConfirm
    //     //placeholder: '<i class="fas fa-search"></i> Search',
    //     //width:'100%',
    //     // tags:true,
    //     // minimumInputLength: 0,
    //     placeholder: {
    //         id: '0',
    //         text: 'Select'
    //     },
    //     allowClear: true,
    //     // minimumResultsForSearch: Infinity,
    //     ajax: {
    //         type: "post",
    //         url: url_search,
    //         dataType: 'json',
    //         delay: 250,
    //         beforeSend:function(x){
    //             x.setRequestHeader('Authorization',"Bearer " + bearer_token);
    //             x.setRequestHeader('X-CSRF-TOKEN',csrf_token);
    //         },
    //         data: function (params) {
    //             var query = {
    //                 search: params.term,
    //                 action: 'school'
    //             };
    //             return query;
    //         },
    //         processResults: function (data){
    //             console.log(data);
    //             var datas = [];
    //             $.each(data, function(key, val){
    //                 datas.push({
    //                     'id' : val.session,
    //                     'text' : val.text
    //                 });
    //             });
    //             console.log('datas', datas);
    //             return {
    //                 results: datas
    //             };
    //         },
    //         cache: true
    //     },
    //     escapeMarkup: function(markup){ 
    //         return markup; 
    //     },
    //     templateResult: function(datas){ //When Select on Click
    //         //if (!datas.id) { return datas.text; }
    //         // if($.isNumeric(datas.id) == true){
    //         //     // return '<i class="fas fa-user-check '+datas.id.toLowerCase()+'"></i> '+datas.text;
    //             return datas.text;
    //         // }
    //     },
    //     templateSelection: function(datas) { //When Option on Click
    //         //if (!datas.id) { return datas.text; }
    //         //Custom Data Attribute
    //         //$(datas.element).attr('data-column', datas.column);        
    //         //return '<i class="fas fa-user-check '+datas.id.toLowerCase()+'"></i> '+datas.text;
    //         // if($.isNumeric(datas.id) == true){
    //         //     // return '<i class="fas fa-user-check '+datas.id.toLowerCase()+'"></i> '+datas.text;
    //             return datas.text;
    //         // }
    //     }
    // }); 

    $('input:radio[name="grade_status"]').on('change', function(e){
        var v = $(this).val();
        $("input[name=grade_status][value!='"+v+"']").removeAttr('checked');
        $("input[name=grade_status][value='"+v+"'").attr('checked', 'checked');
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
        formReset();
        $("#modal_grade").modal('show');
    });
    $(document).on("click","#btn_close",function(e) {
        e.preventDefault();
        e.stopPropagation();
        $("#modal_grade").modal('hide');
        formReset();
    });
    $(document).on("click","#btn_save", function(e) { // Done
        e.preventDefault();
        e.stopPropagation();
        let next = true;
        
        if(next){
            if ($("#grade_name").val().length === 0) {
                next = false;
                notif(0,'Name required');
            }
        }   

        // if(next){
        //     if ($("#menu_link").val().length === 0) {
        //         next = false;
        //         notif(0,'Link required');
        //     }
        // }    

        if(next){
            let form = new FormData($("#form_grade")[0]);
            // form.append('_token','{{ csrf_token() }}');  
            // form.append('user_remember_token', '2');     
            form.append('action','create');
            // form.append('grade_school',$("#grade_school").find(":selected").val());
            form.append('grade_status',$("input[name=grade_status]:checked").val());
            // form.append('grade_user', userdata.user_session);
            form.append('grade_session',gradeSession);
            if(gradeSession == ''){
                var set_url = url_api + 'grade-create';
            }else{              
                var set_url = url_api + gradeSession + '/grade-update';
            }

            $.ajax({
                type: "post",
                url: set_url,
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
                        if(gradeSession == ''){
                            data_table.ajax.reload();
                        }else{              
                            data_table.ajax.reload(null,false);
                        }                        
                        gradeSession = r.menu_session;
                        $("#modal_grade").modal('hide');
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
        
        gradeSession = $(this).attr('data-session');
        
        if(next){
            if (gradeSession.length === 0) {
                next = false;
                notif(0,'Data tidak ada');
            }
        }

        if(next){
            let form = new FormData();
            form.append('action','read');
            form.append('grade_session',gradeSession);
            $.ajax({
                type: "get",
                url: url_api + gradeSession+ '/grade-data',
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
                        data_table.ajax.reload();
                        formReset();
                        $("#modal_grade").modal('show');
                        gradeSession = r.grade_session;
                        $("#grade_name").val(r.grade_name); 
                        if((r.grade_school) && r.grade_school.length == 20){
                            schoolSession = r.user_school;
                            $("select[id='grade_school']").append(''+'<option value="'+r.rl_school.school_session+'">'+r.rl_school.school_name+'</option>');
                            $("#grade_school").val(r.grade_school).trigger('change');
                        }
                        
                        $('input[name=grade_status][value='+r.grade_status+']').prop("checked", true).change();                     
                    }else{
                        notif(s,m);
                        gradeSession = '';
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
        gradeSession = $(this).attr('data-session');
        var userName = $(this).attr('data-name');        

        let title   = 'Confirmation';
        let content = 'Are you sure to remove <b>'+userName+'</b> ?';
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
                        if(!gradeSession){
                            next = false;
                            notif(0,'Data tidak valid');
                        }
                    
                        if(next){
                            let form = new FormData(); 
                            form.append('action','delete');
                            form.append('grade_session',gradeSession); 
                            
                            var set_url = url_api + gradeSession + '/grade-delete';        
                            $.ajax({
                                type: "post",
                                url: set_url,
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
    function formReset(){
        gradeSession = '';
        $("#form_grade input")
        .not("input[name='grade_status']").val('');
        $("input[name=grade_status][value=1]").prop("checked", true).change();
        $("#form_grade select").val(0).trigger('change');           
    }

});
// $("#modal_grade").modal('show');    
</script>