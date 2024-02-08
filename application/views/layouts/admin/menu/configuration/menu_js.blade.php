<script type="text/javascript">
$(document).ready(function() {  
    

    let url = '{{ url('/') }}/config/menu';
    let url_search = '{{ url('/') }}/search';    
    
    let csrf_token = $('meta[name="csrf-token"]').attr('content');
    // let bearer_token = "{{ $data['session']['token'] }}";

    let menuSession = '';    

    /** handle token */
    let login = '{{ url('/') }}';
    const userdata = JSON.parse(localStorage.getItem('lms-userdata'));
    // if userdata null then login page
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
    let menu_table = $("#table_menu").DataTable({
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
                d.filter_parent = 0;
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
            {"targets":0, "width":"30%", "title":"Menu", "searchable":true, "orderable":true},            
            {"targets":1, "width":"20%", "title":"Link", "searchable":true, "orderable":true},
            {"targets":2, "width":"20%", "title":"Child Count", "searchable":true, "orderable":true, "className":"dt-body-right"},            
            {"targets":3, "width":"30%", "title":"Sort Number", "searchable":true, "orderable":true},
            {"targets":4, "width":"20%", "title":"Status", "searchable":true, "orderable":true},
            {"targets":5, "width":"20%", "title":"Action", "searchable":true, "orderable":true},                      
        ],
        "order": [[0, 'ASC']],
        "columns": [{
                'data': 'menu_name',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    if(row.menu_icon != undefined){
                        dsp += '<i class="'+row.menu_icon+' align-bottom me-2 text-muted"></i>';
                    }
                    dsp += row.menu_name;
                    return dsp;
                }
            },{
                'data': 'menu_link',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    return data;
                }
            },{
                'data': 'menu_child_count',
                render: function(data, meta, row) {
                    var dsp = '-';
                    return data;
                }
            },{
                'data': 'menu_parent_id',
                className: 'text-left',
                render: function(data, meta, row) {
                    return data;
                }
            },{
                'data': 'menu_status',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    if(row.menu_status == 0){
                        dsp += '<span class="badge bg-warning-subtle text-warning">Inactive</span>';
                    }else if(row.menu_status == 1){
                        dsp += '<span class="badge bg-success-subtle text-success">Active</span>';
                    }else if(row.menu_status == 4){
                        dsp += '<span class="badge bg-danger-subtle text-danger">Deleted</span>';
                    }
                    return dsp;
                }
            },{
                'data': 'menu_id',
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
                                <a href="#" class="dropdown-item btn_new_child" data-id="${data}" data-session="${row.menu_session}" data-name="${row.menu_name}">
                                    <i class="ri-play-list-add-line align-bottom me-2 text-muted"></i> Add Child
                                </a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item btn_edit" data-id="${data}" data-session="${row.menu_session}" data-name="${row.menu_name}">
                                    <i class="ri-eye-fill align-bottom me-2 text-muted"></i> View
                                </a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item remove-item-btn btn_delete" data-id="${data}" data-session="${row.menu_session}" data-name="${row.menu_name}" style="cursor:pointer">
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
    $("#table_menu_filter").css('display','none');
    $("#table_menu_length").css('display','none');
    $("#filter_length").on('change', function(e){
        var value = $(this).find(':selected').val(); 
        $('select[name="table_user_length"]').val(value).trigger('change');
        user_table.ajax.reload();
    });
    $("#filter_flag").on('change', function(e){ menu_table.ajax.reload(); });
    $("#filter_search").on('input', function(e){ var ln = $(this).val().length; if(parseInt(ln) > 3){ menu_table.ajax.reload(); }else if(parseInt(ln) < 1){ menu_table.ajax.reload();} });

    /* Select2 */
    $('#menu_parents').select2({
        dropdownParent:$("#modal_menu"), //If Select2 Inside Modal, $(".jconfirm-box-container") if jConfirm
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
            type: "get",
            url: url_search,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                var query = {
                    search: params.term,
                    action: 'menu'
                };
                return query;
            },
            processResults: function (data){
                console.log(data);
                var datas = [];
                $.each(data, function(key, val){
                    datas.push({
                        'id' : val.id,
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
            if($.isNumeric(datas.id) == true){
                // return '<i class="fas fa-user-check '+datas.id.toLowerCase()+'"></i> '+datas.text;
                return datas.text;
            }
        },
        templateSelection: function(datas) { //When Option on Click
            //if (!datas.id) { return datas.text; }
            //Custom Data Attribute
            //$(datas.element).attr('data-column', datas.column);        
            //return '<i class="fas fa-user-check '+datas.id.toLowerCase()+'"></i> '+datas.text;
            if($.isNumeric(datas.id) == true){
                // return '<i class="fas fa-user-check '+datas.id.toLowerCase()+'"></i> '+datas.text;
                return datas.text;
            }
        }
    }); 

    $('input:radio[name="menu_status"]').on('change', function(e){
        var v = $(this).val();
        $("input[name=menu_status][value!='"+v+"']").removeAttr('checked');
        $("input[name=menu_status][value='"+v+"'").attr('checked', 'checked');
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
        formMenuReset();
        $("#modal_menu").modal('show');
    });
    $(document).on("click","#btn_close",function(e) {
        e.preventDefault();
        e.stopPropagation();
        $("#modal_menu").modal('hide');
        formmenuReset();
    });
    $(document).on("click","#btn_save", function(e) { // Done
        e.preventDefault();
        e.stopPropagation();
        let next = true;
        
        // if(next){
        //     if ($("#menu_name").val().length === 0) {
        //         next = false;
        //         notif(0,'Name required');
        //     }
        // }   

        // if(next){
        //     if ($("#menu_link").val().length === 0) {
        //         next = false;
        //         notif(0,'Link required');
        //     }
        // }    

        if(next){
            let form = new FormData($("#form_menu")[0]);
            // form.append('_token','{{ csrf_token() }}');  
            // form.append('user_remember_token', '2');     
            form.append('action','create');
            form.append('menu_parent',$("#menu_parent_id").find(":selected").val());
            form.append('menu_status',$("input[name=menu_status]:checked").val());
            form.append('menu_session',menuSession);
            if(menuSession == ''){
                //     var set_url = url_api + 'menu-create';
            }else{              
            //     var set_url = url_api + menuSession + '/menu-update';
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
                        if(menuSession == ''){
                            menu_table.ajax.reload();
                        }else{              
                            menu_table.ajax.reload(null,false);
                        }                        
                        menuSession = r.menu_session;
                        $("#modal_menu").modal('hide');
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
        
        menuSession = $(this).attr('data-session');
        
        if(next){
            if (menuSession.length === 0) {
                next = false;
                notif(0,'Data tidak ada');
            }
        }

        if(next){
            let form = new FormData();
            form.append('action','read');
            form.append('menu_session',menuSession);
            $.ajax({
                type: "post",
                // url: url_api + menuSession+ '/user-data',
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
                        menu_table.ajax.reload();
                        $("#modal_menu").modal('show');
                        menuSession = r.menu_session;
                        $("#menu_name").val(r.menu_name);      
                        $("#menu_link").val(r.menu_link);
                        $("#menu_icon").val(r.menu_icon);
                        
                        $('input[name=menu_status][value='+r.menu_status+']').prop("checked", true).change();                     
                    }else{
                        notif(s,m);
                        menuSession = '';
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
        menuSession = $(this).attr('data-session');
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
                        if(!menuSession){
                            next = false;
                            notif(0,'Data tidak valid');
                        }
                    
                        if(next){
                            let form = new FormData(); 
                            form.append('action','delete');
                            form.append('menu_session',menuSession);         
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
                                        menu_table.ajax.reload(null,false);
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
    $(document).on("click",".btn_new_child",function(e) {
        e.preventDefault();
        e.stopPropagation();
        formMenuReset();
        $("#menu_parent_id").html('');
        $("#menu_parent_id").append('<option value="'+$(this).attr('data-id')+'">'+$(this).attr('data-name')+'</option>');
        $("#menu_parent_id").val($(this).attr('data-id')).trigger('change');        
        $("#modal_menu").modal('show');
    });    
    function formMenuReset(){
        menuSession = '';
        $("#form_menu input")
        .not("input[name='menu_status']").val('');
        $("input[name=menu_status][value=1]").prop("checked", true).change();
        $("#form_menu select").val(0).trigger('change');        
        $("#menu_parent_id").html('<option value="0">Select</option>');      
    }

});
// $("#modal_menu").modal('show');    
</script>