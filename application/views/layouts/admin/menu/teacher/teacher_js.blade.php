<script type="text/javascript">
$(document).ready(function() {  
    $.alert('Create update solved, bug delete solved');
    let url = '{{ url('/') }}/teacher/list';
    let url_api = '{{ url('/') }}/api/master/'; 
    let url_search = '{{ url('/') }}/search';    
    // let url_image = '{{ URL::asset('/') }}storage/';  
    let url_image = '{{ url('/') }}/uploads/noimage.png';          
    let csrf_token = $('meta[name="csrf-token"]').attr('content')
    
    let userSession = '';  
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
    
    //Croppie
    let image_width = 400;
    let image_height = 400;      
    let upload_crop_img = null;
    upload_crop_img = $('#modal_croppie_canvas').croppie({
        enableExif: true,
        viewport: {width: image_width, height: image_height},
        boundary: {width: parseInt(image_width)+10, height: parseInt(image_height)+10},
        url: url_image,
    });

    //Datatable
    let data_table = $("#table_teacher").DataTable({
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
            {"targets":0, "width":"30%", "title":"Full Name", "searchable":true, "orderable":true},            
            {"targets":1, "width":"30%", "title":"Email", "searchable":true, "orderable":true},
            {"targets":2, "width":"20%", "title":"Phone", "searchable":true, "orderable":true, "className":"dt-body-left"},
            {"targets":3, "width":"20%", "title":"Gender", "searchable":true, "orderable":true},            
            {"targets":4, "width":"20%", "title":"Status", "searchable":true, "orderable":true},
            {"targets":5, "width":"20%", "title":"Action", "searchable":true, "orderable":true},                      
        ],
        "order": [[0, 'ASC']],
        "columns": [{
                'data': 'user_fullname',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    return data;
                }
            },{
                'data': 'user_email',
                className: 'text-right',
                render: function(data, meta, row) {
                    var dsp = '';
                    return data;
                }
            },{
                'data': 'user_phone',
                render: function(data, meta, row) {
                    var dsp = '-';
                    return data;
                }
            },{
                'data': 'user_gender',
                className: 'text-left',
                render: function(data, meta, row) {
                    return data;
                }
            },{
                'data': 'user_status',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    if(row.user_status == 0){
                        dsp += '<span class="badge bg-warning-subtle text-warning">Inactive</span>';
                    }else if(row.user_status == 1){
                        dsp += '<span class="badge bg-success-subtle text-success">Active</span>';
                    }else if(row.user_status == 4){
                        dsp += '<span class="badge bg-danger-subtle text-danger">Deleted</span>';
                    }
                    return dsp;
                }
            },{
                'data': 'user_id',
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
                                <a href="#" class="dropdown-item btn_edit" data-id="${data}" data-session="${row.user_session}" data-name="${row.user_fullname}">
                                    <i class="ri-eye-fill align-bottom me-2 text-muted"></i> View
                                </a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item remove-item-btn btn_delete" data-id="${data}" data-session="${row.user_session}" data-name="${row.user_fullname}" style="cursor:pointer">
                                    <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                </a>
                            </li>
                        </ul>
                    </div>`;
                    // <li>
                    //     <a href="#" class="dropdown-item edit-item-btn btn_edit" data-id="${data}" data-session="${row.user_session}" data-name="${row.menu_name}" style="cursor:pointer">
                    //         <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit
                    //     </a>
                    // </li>                    
                    return dsp;
                }
            }
        ]
    });
    $("#table_teacher_filter").css('display','none');
    $("#table_teacher_length").css('display','none');
    $("#filter_length").on('change', function(e){
        var value = $(this).find(':selected').val(); 
        $('select[name="table_teacher_length"]').val(value).trigger('change');
        data_table.ajax.reload();
    });
    $("#filter_flag").on('change', function(e){ data_table.ajax.reload(); });
    $("#filter_search").on('input', function(e){ var ln = $(this).val().length; if(parseInt(ln) > 3){ data_table.ajax.reload(); }else if(parseInt(ln) < 1){ data_table.ajax.reload();} });

    /** flatpicker */
    // $("#user_birth").flatpickr({
    //     dateFormat: 'd-m-Y',
    //     allowInput: true,
    //     static:true,
    //     onOpen: (selectedDates, dateStr, instance) => { // rewrite the picker date
    //         // $("#flatpickr-date").removeAttr('tabindex');
    //     },
    //     onClose: (selectedDates, dateStr, instance) => { // rewrite the picker date
    //         instance.setDate(selectedDates, instance, dateStr);
    //         // $("#flatpickr-date").attr('tabindex',-1);
    //     }
    // }); 
    let userBirthDate = $("#user_birth").flatpickr({
        dateFormat: 'd-m-Y',
        allowInput: true,
        static:true,
        onOpen: (selectedDates, dateStr, instance) => { // rewrite the picker date
            // $("#flatpickr-date").removeAttr('tabindex');
        },
        onClose: (selectedDates, dateStr, instance) => { // rewrite the picker date
            instance.setDate(selectedDates, instance, dateStr);
            // $("#flatpickr-date").attr('tabindex',-1);
        }       
    });      
    /* Select2 */
    // $('#user_school').select2({
    //     dropdownParent:$("#modal_teacher"), //If Select2 Inside Modal, $(".jconfirm-box-container") if jConfirm
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
    //         type: "get",
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

    $('input:radio[name="user_status"]').on('change', function(e){
        var v = $(this).val();
        $("input[name=user_status][value!='"+v+"']").removeAttr('checked');
        $("input[name=user_status][value='"+v+"'").attr('checked', 'checked');
        // if(v == 0){
        //     $("#group").val(0).trigger('change');
        //     $("#group").attr('disabled',true);                
        // }else{
        //     $("#group").removeAttr('disabled');                
        // }
    });    
    $('input:radio[name="user_gender"]').on('change', function(e){
        var v = $(this).val();
        $("input[name=user_gender][value!='"+v+"']").removeAttr('checked');
        $("input[name=user_gender][value='"+v+"'").attr('checked', 'checked');
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
        formUserReset();
        $("#modal_teacher").modal('show');
    });
    $(document).on("click","#btn_close",function(e) {
        e.preventDefault();
        e.stopPropagation();
        $("#modal_teacher").modal('hide');
        formUserReset();
    });
    $(document).on("click","#btn_save", function(e) { // Done
        e.preventDefault();
        e.stopPropagation();
        let next = true;
        
        // if(next){
        //     if ($("#user_fullname").val().length === 0) {
        //         next = false;
        //         notif(0,'Name required');
        //     }
        // }   

        // if(next){
        //     if ($("#user_email").val().length === 0) {
        //         next = false;
        //         notif(0,'Link required');
        //     }
        // }    

        if(next){
            let form = new FormData($("#form_teacher")[0]);
            // form.append('_token','{{ csrf_token() }}');  
            // form.append('user_remember_token', '2');     
            form.append('action','create');
            // form.append('user_level',$("#user_level").find(":selected").val());
            // form.append('user_school',$("#user_school").find(":selected").val());
            // form.append('user_fullname',$("#user_fullname").val());
            // form.append('user_email',$("#user_email").val());
            if(($("#user_password").val()) || $("#user_password").val() != '') {
                form.set('user_password',$("#user_password").val());
            }
            // form.append('user_phone',$("#user_phone").val());
            form.set('user_birth',moment(userBirthDate.selectedDates[0]).format("YYYY-MM-DD"));
            // form.append('user_birth_place',$("#user_birth_place").val());
            form.set('user_gender',$("input[name=user_gender]:checked").val());
            form.set('user_status',$("input[name=user_status]:checked").val());
            form.append('user_remember_token',8);
            // form.append('uploads_base64', $("#files_preview").attr('data-save-img')); 
            if(userSession == ''){
                var set_url = url_api + 'teacher-create';
            }else{              
                form.append('user_session',userSession);
                var set_url = url_api + 'teacher-update';
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
                        if(userSession == ''){
                            data_table.ajax.reload();
                        }else{              
                            data_table.ajax.reload(null,false);
                        }                        
                        userSession = r.user_session;
                        $("#modal_teacher").modal('hide');
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
        
        userSession = $(this).attr('data-session');
        
        if(next){
            if (userSession.length === 0) {
                next = false;
                notif(0,'Data tidak ada');
            }
        }

        if(next){
            let form = new FormData();
            form.append('action','read');
            form.append('user_session',userSession);
            $.ajax({
                type: "get",
                url: url_api + userSession+ '/teacher-data',
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
                        formUserReset();
                        $("#modal_teacher").modal('show');
                        userSession = r.user_session;
                        $("#user_fullname").val(r.user_fullname);      
                        $("#user_phone").val(r.user_phone);
                        $("#user_email").val(r.user_email);
                        $("#user_password").val(r.user_password);
                        $("#user_birth_place").val(r.user_birth_place);
                        if (r.user_birth) {
                            $("#user_birth")[0]._flatpickr.setDate(moment(r.user_birth).format('DD-MM-YYYY'));
                        }
                        $('input[name=user_gender][value='+r.user_gender+']').prop("checked", true).change();  
                        $('input[name=user_status][value='+r.user_status+']').prop("checked", true).change();   
                        $("select[id='user_level']").append(''+'<option value="'+r.rl_level.level_id+'">'+r.rl_level.level_name+'</option>');
                        $("#user_level").val(r.user_level).trigger('change'); 
                        // if((r.user_school) && r.user_school.length == 20){
                        //     schoolSession = r.user_school;
                        //     $("select[id='user_school']").append(''+'<option value="'+r.rl_school.school_session+'">'+r.rl_school.school_name+'</option>');
                        //     $("#user_school").val(r.user_school).trigger('change');
                        // }

                        if(!r.user_photos == undefined){
                            $("#files_preview").attr('src',url_image);
                        }else{
                            $("#files_preview").attr('src',r.user_photos_url);
                        }
                    }else{
                        notif(s,m);
                        userSession = '';
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
        userSession = $(this).attr('data-session');
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
                        if(!userSession){
                            next = false;
                            notif(0,'Data tidak valid');
                        }
                    
                        if(next){
                            let form = new FormData(); 
                            form.append('action','delete');
                            form.append('user_session',userSession);
                            var set_url = url_api + 'teacher-delete';
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
    function formUserReset(){
        userSession = '';
        schoolSession = '';
        $("#form_teacher input")
        .not("input[name='user_gender']")
        .not("input[name='user_status']").val('');
        $("input[name=user_gender][value=Laki-laki]").prop("checked", true).change();
        $("input[name=user_status][value=1]").prop("checked", true).change();
        $("#form_teacher select").val(0).trigger('change');    
        $("#files_preview").attr('src',url_image);    
        // $("#menu_parent_id").html('<option value="0">Select</option>');      
    }
    //Image Croppie
    // $(document).on('change', '#uploads', function(e) {
    //     if($("#uploads").val() == ''){
    //         $("#files_preview").attr('src', url_image);
    //         $("#files_link").attr('href', url_image);            
    //         $("#files_preview").attr('data-save-img', '');
    //         return;
    //     }
    //     var reader = new FileReader();
    //     reader.onload = function(e) {
    //         upload_crop_img.croppie('bind', {
    //             url: e.target.result
    //         }).then(function () {
    //             $("#modal_croppie").modal("show");
    //             setTimeout(function(){$('#modal_croppie_canvas').croppie('bind');}, 300);
    //         });
    //     };
    //     reader.readAsDataURL(this.files[0]);
    // });
    $(document).on('click', '#modal_croppie_cancel', function(e){
        e.preventDefault();
        e.stopPropagation();
        $("#uploads").val('');
        $("#files_preview").attr('data-save-img', '');
        $("#files_preview").attr('src', url_image);
        $("#files_link").attr('href', url_image);
    });
    $(document).on('click', '#modal_croppie_save', function(e){
        e.preventDefault();
        e.stopPropagation();
        upload_crop_img.croppie('result', {
            type: 'canvas',
            size: 'viewport',
        }).then(function (resp) {
            $("#files_preview").attr('src', resp);
            $("#files_link").attr('href', resp);
            $("#files_preview").attr('data-save-img', resp);
            $("#modal_croppie").modal("hide");
        });
    });
    
});   
</script>