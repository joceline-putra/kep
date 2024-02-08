<script type="text/javascript">
$(document).ready(function() {  
    

    let url = '{{ url('/') }}/school';
    let url_api = '{{ url('/') }}/api/master/'; 
    let url_search = '{{ url('/') }}/search';    
    let csrf_token = $('meta[name="csrf-token"]').attr('content')
    
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

    $('#school_city').select2({
        dropdownParent:$("#modal_school"),
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
                    action: 'cities'
                };
                return query;
            },
            processResults: function (data){
                var datas = [];
                $.each(data, function(key, val){
                    var state_name = '-';
                    if(val.state_session !== undefined){
                        state_name = val.state_name;
                    }              
                    datas.push({
                        'id' : val.id,
                        'text' : val.text,
                        'state_session': val.state_session,
                        'state_name': state_name                              
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
            return datas.text;
        },
        templateSelection: function(datas) { //When Option on Click
            $(datas.element).attr('data-state-session', datas.state_session);     
            $(datas.element).attr('data-state-name', datas.state_name);        
            return datas.text;
        }
    });     
    $(document).on("change","#school_city",function(e) {
        var state_name = $(this).find(':selected').attr('data-state-name');
        // if((state_name.length > 1) && (state_name.length < 20)){ //Only NEW Form
            $("#school_state").val(state_name);
        // }
    });

    //Datatable
    let data_table = $("#table_school").DataTable({
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
            {"targets":0, "width":"30%", "title":"School", "searchable":true, "orderable":true},            
            {"targets":1, "width":"20%", "title":"Address", "searchable":true, "orderable":true, "className":"dt-body-left"},
            {"targets":2, "width":"20%", "title":"City", "searchable":true, "orderable":true},            
            {"targets":3, "width":"30%", "title":"Phone", "searchable":true, "orderable":true},          
            {"targets":4, "width":"30%", "title":"Email", "searchable":true, "orderable":true},
            {"targets":5, "width":"20%", "title":"Action", "searchable":true, "orderable":true},                      
        ],
        "order": [[0, 'ASC']],
        "columns": [{
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
                    dsp += data + ', ' +row.state_name;
                    return dsp;
                }
            },{
                'data': 'school_phone',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    dsp += data;
                    return dsp;
                }
            },{
                'data': 'school_email',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    dsp += data;
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
                                <a href="#" class="dropdown-item btn_edit" data-id="${data}" data-session="${row.school_session}" data-name="${row.school_name}">
                                    <i class="ri-eye-fill align-bottom me-2 text-muted"></i> View
                                </a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item remove-item-btn btn_delete" data-id="${data}" data-session="${row.school_session}" data-name="${row.school_name}" style="cursor:pointer">
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
    $("#table_school_filter").css('display','none');
    $("#table_school_length").css('display','none');
    $("#filter_length").on('change', function(e){
        var value = $(this).find(':selected').val(); 
        $('select[name="table_school_length"]').val(value).trigger('change');
        data_table.ajax.reload();
    });
    $("#filter_flag").on('change', function(e){ data_table.ajax.reload(); });
    $("#filter_search").on('input', function(e){ var ln = $(this).val().length; if(parseInt(ln) > 3){ data_table.ajax.reload(); }else if(parseInt(ln) < 1){ data_table.ajax.reload();} });

    $('input:radio[name="school_status"]').on('change', function(e){
        var v = $(this).val();
        $("input[name=school_status][value!='"+v+"']").removeAttr('checked');
        $("input[name=school_status][value='"+v+"'").attr('checked', 'checked');
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
        formSchoolReset();
        $("#modal_school").modal('show');
    });
    $(document).on("click","#btn_close",function(e) {
        e.preventDefault();
        e.stopPropagation();
        $("#modal_school").modal('hide');
        formSchoolReset();
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
            let form = new FormData($("#form_school")[0]);
            // form.append('_token','{{ csrf_token() }}');  
            // form.append('user_remember_token', '2');     
            form.append('action','create');
            // form.append('school_name',$("#school_name").val());
            // form.append('school_address',$("#school_address").val());
            // form.append('school_status',$("input[name=school_status]:checked").val());
            form.append('school_state',$("#school_city").find(":selected").attr('data-state-session'));            
            if(schoolSession == ''){
                var set_url = url_api + 'school-create';
            }else{              
                form.append('school_session',schoolSession);
                var set_url = url_api + schoolSession + '/school-update';
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
                        if(schoolSession == ''){
                            data_table.ajax.reload();
                        }else{              
                            data_table.ajax.reload(null,false);
                        }                        
                        schoolSession = r.school_session;
                        $("#modal_school").modal('hide');
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
        
        schoolSession = $(this).attr('data-session');
        
        if(next){
            if (schoolSession.length === 0) {
                next = false;
                notif(0,'Data tidak ada');
            }
        }

        if(next){
            let form = new FormData();
            form.append('action','read');
            form.append('school_session',schoolSession);
            $.ajax({
                type: "post",
                // url: url_api + schoolSession+ '/school-data',
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
                        // data_table.ajax.reload();
                        $("#modal_school").modal('show');
                        schoolSession = r.school_session;
                        $("#school_name").val(r.school_name);      
                        $("#school_address").val(r.school_address);

                        
                        $("select[id='school_city']").append(''+'<option value="'+r.school_city+'" data-state-session="'+r.state_session+'" data-state-name="'+r.state_name+'">'+r.city_name+', '+r.state_name+'</option>');
                        $("select[id='school_city']").val(r.school_city).trigger('change');
                        
                        // $("select[id='school_state']").append(''+'<option value="'+r.school_state+'">'+r.state_name+'</option>');
                        // $("select[id='school_state']").val(r.school_state).trigger('change');
                        $("#school_state").val(r.state_name);
                        $("#school_phone").val(r.school_phone);
                        $("#school_email").val(r.school_email);                        
                        $("#school_date_created").val(moment(r.school_date_created).format("DD/MMM/YYYY"));
                        $('input[name=school_status][value='+r.school_status+']').prop("checked", true).change();   
                    }else{
                        notif(s,m);
                        schoolSession = '';
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
        schoolSession = $(this).attr('data-session');
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
                        if(!schoolSession){
                            next = false;
                            notif(0,'Data tidak valid');
                        }
                    
                        if(next){
                            let form = new FormData(); 
                            form.append('action','delete');
                            form.append('school_session',schoolSession);
                            var set_url = url_api + schoolSession + '/school-delete';
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
    function formSchoolReset(){
        schoolSession = '';
        $("#form_school input")
        .not("input[name='school_status']").val('');
        $("input[name=school_status][value=1]").prop("checked", true).change();
        $("#form_school select").val(0).trigger('change');        
        // $("#menu_parent_id").html('<option value="0">Select</option>');      
    }

});
// $("#modal_school").modal('show');    
</script>